Jenkins
====================================
<a target="_blank" href="https://dotblogs.com.tw/kinanson/2017/08/17/135639">安裝方式</a>

官方使用者手冊 <a target="_blank" href="https://jenkins.io/doc/book/">英文版</a> <a target="_blank" href="https://jenkins.io/zh/doc/">簡體中文版</a>

<a target="_blank" href="https://plugins.jenkins.io/">Plugs插件介紹</a>

名詞解釋
------------
我們把專案 push 上去後
接下來就是要進行本地測試
測試完成後，把專案推上去，把 PR 發給相關人員通過後
需要把大家的 branch 都合併
然後我們就要把這個程式放到正式環境
這一整個行為被稱為 CI/CD

CI 就是上述提到的版控、程式碼分析、建置、自動化測試

CD 就是把要 Release 的程式放到正式環境去，讓真正的使用者使用

![GitHub Logo](/images/2017-08-06-22-13-21.png)


Jenkins優點
------------
可免費且合法商業使用

可使用的插件豐富

可完全控制系统

Jenkins缺點
------------
Groovy程式 & command line 要自己寫

不支援YAML語法

無快速構建功能

比如CircleCI只要編輯yaml檔案即完成部署，ex:
https://circleci.com/docs/2.0/sample-config/


Jenkins與Github連動方法
------------

1. 取得GitHub Access Token

為了讓 Jenkins 有權限能夠接收 GitHub 的 PullRequest 通知，需要產生一個 GitHub access token 給他使用。

登入一個有寫入權限的帳號 Settings -> Developer settings -> Personal access tokens -> Generate new token，增加一個 Token 並且勾選以下權限：

admin:repo_hook — for managing hooks (read, write and delete old ones)

repo — to see private repos

repo:status — to manipulate commit statuses

2. 設定 GitHub Webhooks

切到 GitHub 儲存庫的頁面

Setting -> Webhooks -> Add webhook

在 Payload URL 輸入 jenkins 的網址，如：

http://<your-jenkins-url>/github-webhook/

3. 完成設定後Git每次push就會觸發該Jenkins的Job

設定每日排程
------------
分 - 可輸入0-59，代表幾分的時候執行
小時 - 可輸入0-23，代表幾點的時候執行
日 - 可輸入1-31，代表每月幾日的時候執行
月 - 可輸入1-12，代表執行的月份
星期 - 可輸入0-7，代表星期幾，0和7都代表星期天

pipeline指令文件
------------
https://jenkins.io/zh/doc/book/pipeline/syntax/





git clone

composer install 




1.
建立 Gitlab-ci.yml 設定檔
```
image: lorisleiva/laravel-docker:latest

unit_test:
  script:
    - composer install --prefer-dist --no-ansi --no-interaction --no-progress --no-scripts
    - ./vendor/bin/phpunit --testsuit Unit --coverage-text --colors=never
```
Image 關鍵字
因執行 CI/CD 需要先有如 php、composer、npm的等工具，有這些管理套件工具其實就可以動態再去延伸安裝各種套件了，但如果一開始沒有這些套裝工具，就麻煩了，一個作法是連線到 Runner 環境中逐項安裝，但為了實作方便可以使用 image 這個關鍵字，可以讓 Runner 中切換另個環境去執行工作 (Job)，這裡使用 lorisleiva 的 laravel-docker image，其中就已經安裝好上述的工具了。
Job 定義
除了像 image 等等等這些 gitlab-ci.yml 上的關鍵字，其他寫在首行的名字都會被視為是一個 Job 的名字，如範例中的 unit_test 這個就會被視為一個 Job。
Job 內容 - scripts 關鍵字
腳本 (scripts) 就是 Job 的實際內容，執行的指令以 - 符號分行撰寫並且依序的執行，這邊範例是要執行 phpunit 這個單元測試，就如同在本機上要先使用 composer 安裝所有可能所需的套件，再執行 phpunit 。


































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


