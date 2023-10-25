install 套件

```bash
composer install maatwebsite/excel:3.1.33
```

create export file

```bash
php artisan make:export <fileName>
ex : 
php artisan make:import ContractsExport
```

引用檔案

```php
use Maatwebsite\Excel\Facades\Excel;

// array $rows 陣列 導出成檔案  return respond(file)
return Excel::download(new ContractsExport($rows), fileName);

```

主要 import file function

```php

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ContractsExport implements 
  FromArray, 
  WithHeadings, 
  WithMapping, 
  ShouldAutoSize  // 自動擴產寬度
{
    public function __construct(array $contracts)
    {
	      $this->map = array_values(config('excel.contract'));
        $this->contracts = $contracts;
        $this->headings = array_keys(config('excel.contract'));
    }

		/**
     * array excel 資料內容
     *
     * @param  mixed $collection
     * @return void
     */
		// class 需 implements FromArray
    public function array(): array
    {
        return $this->contracts;
    }

		/**
     * headings excel 資料抬頭
     *
     * @return void
     */
		// class 需 implements WithHeadings
    public function headings(): array
    {
        return [
		'編號',
		'姓名',
		...
	];
    }

    /**
     * WithMapping 重新映射資料
     * @param array invoice  ex : [ 'id' = 1, 'name' = 'denny', 'password' = '123' ]
     * @return array  ex : [ 'id' = 1, 'name' = 'denny' ]
     */ 
		// WithMapping
    public function map($invoice): array
    {
				//$this->map = ['id' , 'name']
        $row = [];
        foreach ($this->map as $name) {
            $row[$name] = $invoice[$name];
        }
        return $row;
    }
}
```
