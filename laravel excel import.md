install 套件

```bash
composer install maatwebsite/excel:3.1.33
```

create import file

```bash
php artisan make:import <fileName>
ex : 
php artisan make:import LineLapImport
```

引用檔案

```php
use Maatwebsite\Excel\Facades\Excel;

Excel::import(new LineLapImport(建構子參數), 
	$reques->file);

```

主要 import file function

```php

class LineLapImport implements
    ImportInterface,
    ToCollection,
    WithStartRow,
    WithCustomCsvSettings,
    WithHeadingRow,
    WithValidation
{

		/**
     * collection 資料處理邏輯
     *
     * @param  mixed $collection
     * @return void
     */
		// class 需 implements ToCollection
		// ex  : file = ['a' => '123', 'b'=>'456']
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
           // do somthing
        }
			// save to model
		}

    /**
     * getCsvSettings csv 額外設定
     *
     * @return array
     */
		 // class 需 implements WithCustomCsvSettings
    public function getCsvSettings(): array
		{
        return [
						// csv 斷行符號
            'delimiter' => ($this->encoding == 'UTF-8' || $this->encoding == 'BIG-5') ? "," : "\t",
						// csv 編碼
            'input_encoding' => $this->encoding
        ];
    }

    /**
     * startRow 資料起始行
     *
     * @return int
     */
		// class 需 implements WithStartRow
    public function startRow(): int
		{
        return 2;
    }

		/**
     * headingRow 抬頭資料起始行
     * 依照抬頭當作 collect key 值
     * @return int
     */
    // class 需 implements WithHeadingRow
    public function headingRow(): int
    {
        return 1;
    }
}
```

資料認證 在資料處理前

```php
    /**
     * rules
     * 在 collect 前會需要先經過 rules 認證
     * @return array
     */     
    // class 需 implements WithValidation
    public function rules(): array {
				return [
            'Impressions' => [
                'required',
            ],
            'Clicks' => [
                'required',
            ],

        ];
		}

    /**
    * prepareForValidation
    *  rules 認證 前 可以先轉換資料
    * @return array
    */     
    // class 需 implements WithValidation
		public function prepareForValidation($data, $index){
		    // ... do somthing
        return $data;
    }
	

    /**
    * customValidationMessages
    *  rules 認證 前 可以先轉換資料
    * @return array
    */     
    // class 需 implements WithValidation
		public function customValidationMessages($data, $index){
		    return [
            'required' => '[google DV360] :attribute 為必填',
        ];
    }
```
