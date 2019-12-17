Laravel筆記
====================================


啟動伺服器
------------
```
php artisan serve
```

php artisan make介紹
------------
https://quickadminpanel.com/blog/list-of-21-artisan-make-commands-with-parameters/


建立middleware
```
php artisan make:middleware name
```

建立controller， all methods: index(), create(), store(), show(), edit(), update(), destroy().
```
php artisan make:controller name --resource
```

建立controller， only 5 methods: index(), store(), show(), update(), destroy()
```
php artisan make:controller name --api
```

Route List
```
php artisan route:list
```

修改Auth的User.php目錄
------------
https://www.jianshu.com/p/c2498678a6ca


從 controller 傳送資料到 view 並且使用的方法
------------
http://ray247k.blogspot.com/2018/03/laravel-view-blade.html
