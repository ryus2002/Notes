Jenkins
====================================
官方使用者手冊 <a target="_blank" href="https://jenkins.io/doc/book/">英文版</a> <a target="_blank" href="https://jenkins.io/zh/doc/">簡體中文版</a>



DB Table命名規則
------------
前面需加上專案名稱，中間的底線加或不加都可以

execute:
```
chatconfig

chat_config
```
這是為了盡量說明是哪個應用或者系統在使用的


Function命名規則
------------
1. 動詞 + 名詞為佳 或 單一名詞/形容詞

2. 避免無意義的參數名稱(book1,book2,book3)

execute:
```
(O) print_page()

(O) get_memberid()

(X) get_memberid(x) 參數名x無意義

(O) get_memberid(NOTE_NO)
```

Class命名規則
------------
Class Name類別名稱為名詞/形容詞

Class Method 類別方法為動詞

execute:
```
public class String{ 

    public int CompareTo(...){...}; 

    public string[] Spilt(...){...}; 
}
```

優秀程式設計師需具備技能 (由簡到易排列) 
------------
- 善用工具快速開發能力(優秀的IDE/除錯工具/Composer)
- 善用版本控制工具及提交正確有意義的提交紀錄(Commit Log)
- 有效避免網頁攻擊手法(SQL Injection/Command Injection/XSS/CSRF/SSRF)
- 瞭解並善用Session/Cookie/Web Tokens等常見認證機制
- 瞭解並善用Communication Message(JSON/MessagePack/Protocols Buffers/etc.)
- 瞭解並善用RDBMS資料庫Schema設計及最佳化技巧
- 撰寫可維護的程式碼(可讀性/模組化/易構性)
- 規格、說明及測試文件編寫經驗及能力
- 自我驗證程式/程序正確的習慣與技能(TDD/BDD/E2E Testing/etc.)
- 瞭解並善用設計模式Design Patterns(Singleton/Dependency Injection/Factory/etc.)
- 重構既有軟體架構/程式能力(Refactoring)
- 瞭解並善用資料結構Data Strucures(Array/Linked List/Hash/etc.)
- 瞭解並善用排序演算法Efficient Sorting Algorithms(Quicksort/Heapsort/Mergesort)

建議同仁先提出目前有哪些問題，再一起思考如何解決問題



DB連線方式請統一使用同一個Class，須避免直接寫在程式碼中
------------
(X)

![Image text](http://10.10.1.132/twhg-rd/programming-code-rules/blob/master/pic/a5.png)

避免複製一份重複的檔案
------------
![Image text](http://10.10.1.132/twhg-rd/programming-code-rules/blob/master/pic/a7.png)



URL API若有隱密性的資料，比如客戶姓名、客戶電話等，需使用Web token驗證
------------
JWT教學，之後會補程式碼上傳

https://medium.com/mr-efacani-teatime/%E6%B7%BA%E8%AB%87jwt%E7%9A%84%E5%AE%89%E5%85%A8%E6%80%A7%E8%88%87%E9%81%A9%E7%94%A8%E6%83%85%E5%A2%83-301b5491b60e


Google關鍵字查詢 PHP框架比較
------------
![Image text](http://10.10.1.132/twhg-rd/programming-code-rules/blob/master/pic/a8.png)


API 安全性 ***很重要***
------------
1. Web Token
2. API KEY (OATH2)
3. SSL
4. 防火牆白名單 請注意ajax和curl的差別，看情境使用ajax是只client端ip和server之間的連線，curl是只兩台主機之間的連線
5. PHP簡易阻擋IP的方式 https://www.opencli.com/php/php-get-real-ip
6. API Manager
7. 若會產生比如csv的檔案，請注意放到對外主機上也有可能被爬蟲抓到或是被直接下載

Demo1 

JWT簡易版本

http://house.nhg.tw/admin/ryan/jwt_client1.php

Demo2 

JWT雙Token

access_token 30天有效，無效時則需重新登入

refresh_token 2小時有效，無效時若access_token仍有效時，將重新派發一個refresh_token給Client

http://house.nhg.tw/admin/ryan/jwt_client4.php




正式環境安裝laravel
------------
composer install 要加 --no-dev，以及 APP_ENV 要設定為 production，debug 要關掉，.env也要改，想辦法用log或使用local環境


