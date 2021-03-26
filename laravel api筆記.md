# 參考網址

https://ithelp.ithome.com.tw/articles/10215878

https://angela52799.medium.com/php-%E5%9F%BA%E6%9C%AC%E9%85%8D%E7%BD%AE%E8%88%87-restful-api-%E5%85%A5%E9%96%80-17a4284b0100

https://iter01.com/507705.html

# 產生Model
## 後方 -rmc 的意思是在建立Model 同時建立 Migration Controller ( r 的意思是載入預設CRUD方法)
```
php artisan make:model Animal -rmc
```
總共產生三個檔案

database/migrations/2019_08_22_201730_create_animals_table.php (Migration)

app/Http/Controllers/AnimalController.php (Controller)

app/Animal.php (Model)


## 生成 index() show() store() update() destory() create() edit()
```
php artisan make:controller api/UserInfoController --resource
```

## 生成 index() show() store() update() destory()
```
php artisan make:controller api/UserInfoController --api
```

## 接下來打開 api.php 設定路由。
```
Route::apiResource('animal', 'AnimalController');

Route::apiResource('animal', 'AnimalController')->only([
    'index', 'show'
]);

Route::apiResource('animal', 'AnimalController')->except([
    'create', 'store', 'update', 'destroy'
]);
```
## 查詢目前的路由
```
php artisan route:list
```

## ENV若有修改時，使用 (要先中斷php artisan serve)
```
php artisan config:clear
```

## 建置資料表
```
php artisan migrate
```
## 建立animals資料表
```
php artisan make:migration create_animals_table --create=animals
```
## 在animals新增species欄位
```
php artisan make:migration add_species_column_to_table --table=animals
```
## 在animals修改sex欄位
```
php artisan make:migration alter_sex_column_of_table --table=animals
```

# 資料表建置
## 可以參考官網的說明 https://laravel.com/docs/5.8/migrations#columns

```
public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('type_id')->comment('動物分類');
            $table->string('name')->comment('動物的暱稱');
            $table->date('birthday')->nullable()->comment('生日');
            $table->string('area')->nullable()->comment('所在地區');
            $table->boolean('fix')->default(false)->comment('結紮情形');
            $table->text('description')->nullable()->comment('簡單敘述');
            $table->text('personality')->nullable()->comment('動物個性');
            $table->timestamps();
        });
    }
```
```
    public function up()
    {
        Schema::create('double_coupon_serial', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->string('name', 50)->comment('');
            $table->bigInteger('coupon_id')->unsigned()->comment('獎品編號 (事先填寫)');
            $table->bigInteger('number')->comment('順序(事先填寫)');
            $table->string('serial')->comment('序號');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();

            $table->unique('coupon_id');
            $table->unique('serial');
            //外鍵
            $table->foreign('coupon_id')->references('id')->on('double_coupon')->onDelete('cascade')->onUpdate('cascade');

        });
    }
```

# 資料表的 create (建立)以及 rollback (回滾)
## 程式碼 function 裡面 up 代表的是執行 Migrate 時的動作。程式寫好後便可執行以下指令建立資料表囉！
```
php artisan migrate
```

## 而在 down 內則代表資料表的 rollback (回滾)時會執行的程式，執行 rollback 指令如下。
```
php artisan migrate:rollback
```
    
