//啟動伺服器
php artisan serve


//php artisan make介紹
https://quickadminpanel.com/blog/list-of-21-artisan-make-commands-with-parameters/

//建立middleware
php artisan make:middleware name

//建立controller
//index(), create(), store(), show(), edit(), update(), destroy().
php artisan make:controller name --resource

//only 5 methods: index(), store(), show(), update(), destroy()
php artisan make:controller name --api

php artisan make:controller name --resource
