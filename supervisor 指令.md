## Intro
服務的 Nginx、Queue worker、排程(scheduler)都是用 supervisor 起的，出問題可以用以操作 debug

## Usage

### supervisor.conf

```python
#supervisord 基本設置
[supervisord]
#報錯等級
loglevel=warn  

#log檔存放入路徑
# proc / pid / fd / 程式標準輸出     
logfile=/proc/1/fd/1

#每個log檔案 最大容量 0= 無限 
logfile_maxbytes=0

#pid 程式pid 號碼
pidfile=/var/run/supervisord.pid

#supervisorctl supervisorctl指令 需要寫入空section 代表啟用 
[supervisorctl]

#啟用 php laravel-queue 需引用下面的section 第三方接口
[rpcinterface:supervisor]
supervisor.rpcinterface_factory=supervisor.rpcinterface:make_main_rpcinterface

#supervisor web 管理器 內網(inet) 勿對外 
[inet_http_server]
port=0.0.0.0:9001

#larvel 啟用3個 列隊處理 
[program:laravel-queue-worker]

# 程序名稱 inet_http_server web 顯示
process_name=%(program_name)s_%(process_num)02d

#運行指令
command=php /usr/share/nginx/html/artisan queue:work --sleep=3 --tries=3

#supervisor啟用時啟動
auto_start=false

#自動重啟
auto_restart=true

#啟動數量
numprocs=2

#stderr的日志会被写入stdout日志文件中
redrict_stderr=true

#如果進程還有子進程 當主進程收到stop信號時 , 是否要一併stop子進程 預設false
stopasgroup=false

#如果進程還有子進程 當主進程收到kill信號時 , 是否要一併kill子進程 預設false
killasgroup=false
```

### supervisor 啟動

```python
#啟動並指定參數文件  -c 參數檔位子
supervisord -c ./supervisord.conf

#進程檢查
ps aux | grep supervisord
```

### supervisorctl 指令

```python
# 啟動
supervisorctl start all
supervisorctl start laravel-queue-worker:* #對照 config section name

# 查看狀態
supervisorctl status

# 重啟
supervisorctl restart laravel-queue-worker:*

# 關閉
supervisorctl stop all
supervisorctl stop laravel-queue-worker #對照 config section name
supervisorctl stop groupworker #某個群組 ?

#载入最新的配置文件，停止原有进程并按新的配置启动、管理所有进程。
supervisorctl reload 

#根据最新的配置文件，启动新配置或有改动的进程，配置没有改动的进程不会受影响而重启。
supervisorctl update 

supervisorctl tail -f websockets stdout
```
