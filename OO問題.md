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
