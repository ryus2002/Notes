範例程式為虛擬碼，請試著重構以下程式, 提示:SOLID
```
class PaymentCompanyA {
  public function pay(string t, int a) {
    return "CompanyA:$" + a + "to" + t
  }
}

class PaymentCompanyB {
  public function pay(string t, int a) {
    return "CompanyB:$" + a + "to" + t
  }
}

String t = "Ant"
if Request COMPANY is "CompanyA" then {
  payment = new PaymentCompanyA() 
}
else {
  payment = new PaymentCompanyB()
}

print payment.pay(t,100)
```
參考答案︰
```
// 抽象層 (DIP)
interface PaymentProvider {
    String pay(String recipient, int amount);
}

// 具體實現 (OCP)
class CompanyA implements PaymentProvider {
    public String pay(String t, int a) {
        return "CompanyA:$" + a + "to" + t;
    }
}

class CompanyB implements PaymentProvider {
    public String pay(String t, int a) {
        return "CompanyB:$" + a + "to" + t;
    }
}

// 工廠模式封裝對象創建 (SRP)
class PaymentFactory {
    public static PaymentProvider create(String company) {
        switch(company) {
            case "CompanyA": return new CompanyA();
            case "CompanyB": return new CompanyB();
            default: throw new IllegalArgumentException();
        }
    }
}

// 客戶端使用 (LSP/ISP)
String recipient = "Ant";
PaymentProvider payment = PaymentFactory.create(Request.COMPANY);
System.out.println(payment.pay(recipient, 100));

主要改進點：
依賴反轉原則 (DIP)：透過介面抽象支付行為
開放封閉原則 (OCP)：新增支付公司只需擴展新類別
單一職責原則 (SRP)：工廠類專注對象創建，支付類專注支付邏輯
里氏替換原則 (LSP)：所有實現類可無縫替換介面
介面隔離原則 (ISP)：保持介面最小化且聚焦單一功能
當需要新增支付公司時，只需：
新增實作 PaymentProvider 的 CompanyC 類
在工廠新增對應 case
無需修改任何既有客戶端程式碼
```

範例程式為虛擬碼，請試著重構以下程式, 提示:SOLID
```
class User {
  private string _firstName
  private string _lastName
  private int _age

  User(string firstName,string lastName, int age) {
    _firstName = firstName
    _lastName = lastName
    _age = age
  }
  
  public getUser() {
    return array(_firstName, _lastName, _age)
  }

  public setUser(string firstName, string lastName, int age) {
    _firstName = firstName
    _lastName = lastName
    _age = age
  }
}
```
參考答案︰
```
// ==============================
// 核心改進：強化封裝性 + 職責分離
// ==============================

// 職責 1：不可變用戶核心數據容器 (SRP + Immutable Object)
final class User {
    private final String firstName;
    private final String lastName;
    private final Age age;

    // 封裝構造過程 (DIP)
    private User(String firstName, String lastName, Age age) {
        this.firstName = NameValidator.validate(firstName);
        this.lastName = NameValidator.validate(lastName);
        this.age = age;
    }

    // 明確的單一職責 getters (ISP)
    public String getFirstName() { return firstName; }
    public String getLastName() { return lastName; }
    public Age getAge() { return age; }

    // 模式 2：建造者模式 (OCP)
    public static class Builder {
        private String firstName;
        private String lastName;
        private Age age;

        public Builder firstName(String firstName) {
            this.firstName = firstName;
            return this;
        }

        public Builder lastName(String lastName) {
            this.lastName = lastName;
            return this;
        }

        public Builder age(Age age) {
            this.age = age;
            return this;
        }

        public User build() {
            return new User(firstName, lastName, age);
        }
    }
}

// 職責 2：年齡值對象封裝 (SRP + OCP)
final class Age {
    private final int value;

    public Age(int value) {
        if (value < 0) throw new IllegalArgumentException("Invalid age: " + value);
        this.value = value;
    }

    public int value() { return value; }

    // 可擴展業務方法 (OCP)
    public boolean isAdult() { return value >= 18; }
    public boolean isSenior() { return value >= 65; }
}

// 職責 3：獨立驗證邏輯 (SRP)
class NameValidator {
    static String validate(String name) {
        if (name == null || name.trim().isEmpty()) {
            throw new IllegalArgumentException("Name cannot be empty");
        }
        if (name.length() > 100) {
            throw new IllegalArgumentException("Name exceeds maximum length");
        }
        return name;
    }
}

重構策略解析
單一職責原則 (SRP)
User：純數據容器，僅封裝狀態
Age：封裝年齡相關邏輯與驗證
NameValidator：獨立的名稱驗證規則
Builder：專注對象構建過程

開放封閉原則 (OCP)
新增年齡邏輯（如退休年齡判斷）只需修改 Age 類
擴展名稱驗證規則時可繼承 NameValidator
新增用戶屬性時只需修改建造者，不影響現有構造邏輯

里氏替換原則 (LSP)
所有 final class 設計確保繼承體系的安全性
值對象保證行為一致性

介面隔離原則 (ISP)
精準提供 getFirstName() 而非返回整體陣列
建造者提供流式接口隔離設置方法

依賴反轉原則 (DIP)
高層模組依賴抽象的 Age 值對象
驗證邏輯通過靜態方法注入

使用範例
// 流式構建不可變對象
User user = new User.Builder()
    .firstName("Bruce")
    .lastName("Wayne")
    .age(new Age(42))
    .build();

// 安全存取數據
System.out.println(user.getAge().isAdult());  // true
System.out.println(user.getFirstName());     // Bruce

// 驗證機制自動生效
try {
    new User.Builder().firstName("").build(); // 拋出 IllegalArgumentException
} catch (IllegalArgumentException e) {
    System.out.println(e.getMessage());
}

架構優勢
線程安全性
不可變對象設計天然線程安全

防禦式編程
在構造階段完成所有有效性檢查

領域驅動設計
通過值對象強化業務語意

可測試性
每個組件可獨立測試

當需要新增「電子郵件」屬性時：
在 User 類添加 private final Email email
新增 Email 值對象封裝驗證邏輯
擴展建造者模式
無需修改任何現有客戶端程式碼
```


範例程式為虛擬碼，請試著重構以下程式, 提示:Guard Clauses
```
function checkInitialize(object obj) {
  string msg
  if obj is not null then {
    msg = "object is not null"
    if obj is not initialized then {
      msg = "object is not initialized"
      return msg
    }
    return msg
  }
  msg = "object is valid"
  return msg
}
```
參考答案︰
```
function checkInitialize(object obj) {
  string msg
  if obj is not null then {
    msg = "object is not null"
    return msg
  }

  if obj is not initialized then {
    msg = "object is not initialized"
    return msg
  }

  msg = "object is valid"
  return msg
}
```
