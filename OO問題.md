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

// 構建對象
User user = new UserBuilder()
    .setFirstName("Tony")
    .setLastName("Stark")
    .setAge(new Age(53))
    .build();

// 存取數據
System.out.println(user.getAge().isAdult()); // 輸出 true

重構重點解析
單一職責原則 (SRP)
User 類只負責數據封裝與基礎驗證
Age 類專門處理年齡相關邏輯
UserBuilder 負責處理對象構建過程

開放封閉原則 (OCP)
新增年齡行為時（如 isSenior()），只需修改 Age 類，無需動 User
未來若需支持不同名稱格式，可透過繼承 User 實現，而非修改原始類

里氏替換原則 (LSP)
所有子類（如 InternationalUser）可無縫替換 User 父類
值對象 Age 保證行為一致性

介面隔離原則 (ISP)
客戶端僅需存取明確的 getter（如 getAge()），而非整個陣列
Builder 提供彈性設置方法，避免強制性多參數設置

依賴反轉原則 (DIP)
高層模組（如業務邏輯）依賴抽象的 User，而非具體實現
值對象 Age 封裝底層細節
```
參考答案︰
```
// ==============================
// 核心改進點：拆分職責 + 強化封裝
// ==============================

// 職責 1：數據封裝 (SRP)
class User {
    private final String firstName;  // 改為 final 強化不可變性
    private final String lastName;
    private final Age age;          // 用值對象取代基本類型 (Primitive Obsession 反模式修正)

    public User(String firstName, String lastName, Age age) {
        this.firstName = validateName(firstName);
        this.lastName = validateName(lastName);
        this.age = age;
    }

    // 獨立驗證邏輯 (SRP)
    private String validateName(String name) {
        if (name == null || name.trim().isEmpty()) {
            throw new IllegalArgumentException("Invalid name");
        }
        return name;
    }

    // 明確的 getter 而非返回陣列 (ISP)
    public String getFirstName() { return firstName; }
    public String getLastName() { return lastName; }
    public Age getAge() { return age; }
}

// 職責 2：年齡專用值對象 (SRP + OCP)
class Age {
    private final int value;

    public Age(int value) {
        if (value < 0) throw new IllegalArgumentException("Age cannot be negative");
        this.value = value;
    }

    public int getValue() { return value; }

    // 未來可擴展年齡相關行為 (OCP)
    public boolean isAdult() { return value >= 18; }
}

// 職責 3：User 構建器 (用於處理可變需求)
class UserBuilder {
    private String firstName;
    private String lastName;
    private Age age;

    public UserBuilder setFirstName(String firstName) {
        this.firstName = firstName;
        return this;
    }

    public UserBuilder setLastName(String lastName) {
        this.lastName = lastName;
        return this;
    }

    public UserBuilder setAge(Age age) {
        this.age = age;
        return this;
    }

    public User build() {
        return new User(firstName, lastName, age);
    }
}
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
