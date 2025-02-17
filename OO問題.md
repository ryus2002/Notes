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
// Factory class for creating payment services
class PaymentServiceFactory {
    public function createPaymentService(string $company): PaymentService {
        switch ($company) {
            case "CompanyA":
                return new PaymentCompanyA();
            case "CompanyB":
                return new PaymentCompanyB();
            default:
                throw new InvalidArgumentException("Unknown payment company: " . $company);
        }
    }
}

// Usage example
class PaymentProcessor {
    private PaymentService $paymentService;

    public function __construct(PaymentService $paymentService) {
        $this->paymentService = $paymentService;
    }

    public function processPayment(string $to, int $amount): string {
        return $this->paymentService->pay($to, $amount);
    }
}

// Client code
$factory = new PaymentServiceFactory();
$paymentService = $factory->createPaymentService($_REQUEST['COMPANY']);
$processor = new PaymentProcessor($paymentService);
echo $processor->processPayment("Ant", 100);
```
其他答案（延伸出工廠方法）︰
```
// 定義支付方式的介面
interface IPaymentFormatter {
    public function formatPayment(string $to, int $amount): string;
}

// 基本的支付格式實作
class StandardPaymentFormatter implements IPaymentFormatter {
    private string $company;

    public function __construct(string $company) {
        $this->company = $company;
    }

    public function formatPayment(string $to, int $amount): string {
        return $this->company . ":$" . $amount . "to" . $to;
    }
}

// 支付處理類別
class PaymentProcessor {
    private IPaymentFormatter $formatter;

    public function __construct(IPaymentFormatter $formatter) {
        $this->formatter = $formatter;
    }

    public function pay(string $to, int $amount): string {
        return $this->formatter->formatPayment($to, $amount);
    }
}

// 工廠類別負責創建合適的支付格式器
class PaymentFormatterFactory {
    public function createFormatter(string $company): IPaymentFormatter {
        return new StandardPaymentFormatter($company);
    }
}

// 使用範例
$formatterFactory = new PaymentFormatterFactory();
$formatter = $formatterFactory->createFormatter($REQUEST['COMPANY']);
$payment = new PaymentProcessor($formatter);
print $payment->pay("Ant", 100);
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
