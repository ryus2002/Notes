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
class User {
  private string _firstName
  private string _lastName
  private int _age

  User(string firstName,string lastName, int age) { //這行應該是建構子, 類似__construct
    setUser(firstName, lastName, age)
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
