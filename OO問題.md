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
小弟答案（我覺得我寫錯了...）︰
```
interface tool_action
{
    public function pay(string CompanyName,string t, int a);
}

class PaymentCompany implements tool_action
{
  public function pay(string CompanyName,string t, int a);
  {
    return CompanyName + ":$" + a + "to" + t
  }
}

class PaymentCompanyA {
  public function pay(string CompanyName,string t, int a) {
    PaymentCompany = new PaymentCompany()
    PaymentCompany.pay(CompanyName,t,a)
  }
}

class PaymentCompanyB {
  public function pay(string CompanyName,string t, int a) {
    PaymentCompany = new PaymentCompany()
    PaymentCompany.pay(CompanyName,t,a)
  }
}

String t = "Ant"
if Request COMPANY is "CompanyA" then {
  payment = new PaymentCompanyA() 
}
else {
  payment = new PaymentCompanyB()
}

print payment.pay(COMPANY,t,100)
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
小弟答案︰看不太懂 我覺得把User去掉也能動...?
```
class User {
  private string _firstName
  private string _lastName
  private int _age

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
小弟答案︰
```
function checkInitialize(object obj) {
  string msg
  if obj is not null then {
    throw new Exception("object is not null");
  }

  if obj is not initialized then {
    throw new Exception("object is not initialized");
  }

  msg = "object is valid"
  return msg
}
```
