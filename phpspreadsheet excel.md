簡述 : 最全面艱深的 php excel 套件

laravel-excel 也是以此套件做開發

install 套件

```bash
composer install phpoffice/phpspreadsheet:1.18
```

載入檔案

```php
// init 
// $spreadsheet 重要 所有功能呼叫都離不開這變數
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(storage_path('app/public/' . static::$exportFile));
```

存檔

```php

// 當所有東西修改完後 最後寫入下列代碼
// 呼叫 write class 準備寫入檔案
$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
// 省略計算公式 , 以提高存檔效率
$writer->setPreCalculateFormulas(false);
// 是否存入圖表 
$writer->setIncludeCharts(true);
// 寫入指定檔案
$writer->save(storage_path('app/public/' . static::$exportFile));
```

excel 分頁

```php
// 獲取分頁 , 以方便後續修改此分頁資料
$sheet0 = $spreadsheet->getSheet(0);
// 獲取分頁 by sheetName
$sheet0 = $spreadsheet->getSheetByName('總表');

// 獲取當前分頁 
$sheet0 = $spreadsheet->getActiveSheet();

// 新建分頁 插入到第一
$myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'My Data');
$spreadsheet->addSheet($myWorkSheet, 0);

// 新建分頁 插入到最後
$spreadsheet->createSheet();

// 分頁數量
$spreadsheet->getSheetCount()
```

cell  props

```php
/***** value *****/
//set  分頁0  A1欄位 寫入 1
$sheet0->setCellValue('A1' , 1);

//get 獲取 A1 值
$sheet0->getCell('A1')getValue();

/***** value type *****/
//get 
$sheet0->getCell('A1')
        ->getStyle()
        ->getNumberFormat(); // 0.00%

$PERSENT =  \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE ;
// set
$sheet0->getCell('A1')
        ->getStyle()
        ->setFormatCode($PERSENT); // 0%

------------------------------------------------------

// getStyle only for set css
$sheet0->getCell('A1') // 單欄
$sheet0->getStyle('A1' or 'A1:D1') // 單欄 or 多欄

/***** font color *****/
//get 
$sheet0->getCell('A1')
        ->getStyle()
        ->getFont();
	->getColor(); // #000000

// set
$sheet0->getCell('A1')
        ->getStyle()
        ->getFont();
	->setRGB($color); 

/***** fill color *****/
//get 
$sheet0->getStyle('A1' or 'A1:D1')
        ->getFill()
        ->getStartColor()

// set
$sheet0->getStyle('A1' or 'A1:D1')
        ->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
	->getStartColor()
        ->setARGB($color);

/*****  css   *****/
$styles = array(
        'borders' => array(
            'top' => array(
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => array('argb' => '00000000'),
            ),
            'bottom' => array(
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => array('argb' => '00000000'),
            ),
            'left' => array(
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => array('argb' => '00000000'),
            ),
            'right' => array(
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => array('argb' => '00000000'),
            ),
            'inside' => array(
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => array('argb' => '00000000'),
            ),
        ),
        'alignment' => [
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        'font'  => [
            'name'  => '微軟正黑體'
        ],
    );

// set
$sheet0->getCell('A1')
       ->applyFromArray($styles);

```

merge cell

```php
// 合併
$sheet->mergeCells('A1:D1');

// 解除合併
$sheet->unmergeCells('A1:D1');
```

row

```php
// 隱藏行
$sheet0->getRowDimension(1)->setCollapsed(true);
$sheet0->getRowDimension(1)->setVisible(false);

// 凍結欄位 like css postion = fixed
$sheet0->freezePane('D1');
```

 計算 index 

```php
//string to int 
$startIndex = Coordinate::columnIndexFromString('A'); // 1

//int to string 
$colums[$val] = Coordinate::stringFromColumnIndex('27'); //AA
```
