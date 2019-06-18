輸入縣市能查詢出是電話開頭。
```
class phone
{
    public function findPrefix($county)
    {
        if ($county === '台北市') {
            return '02';
        } else if ($county === '桃園縣') {
            return '03';
        } else if ($county === '苗栗縣') {
            return '037';
        } else if ($county === '台中市') {
            return '04';
        } else {
            return '查無資訊';
        }
    }
}
```
要避免以上的問題，就是將邏輯跟資料分離開來。
```
<?php
class phone
{
    public function findPrefix($county)
    {
 
        $countPhone = array(
            '台北市' => '02',
            '基隆市' => '02',
            '桃園縣' => '03',
            '苗栗縣' => '037',
            '台中市' => '04',
            '彰化縣' => '04',
        );
        return $this->handle($countPhone, $county);
    }
 
    private function handle($countPhone, $county)
    {
        if (array_key_exists($county, $countPhone)) {
            return $countPhone[$county];
        }
        return "查無資料";
    }
}
```
這種寫法的好處在

邏輯與資料區分一目了然。
資料表可以替放，如機率換成視訊，單元測試可以注入其他資料內容，這代表資料來源的靈活性，可以隨時轉換資料。
在單元測試中邏輯必須測試，資料則無需測試。
結論
修改邏輯成本大，修改資料成本小。
修改邏輯風險大，修改資料風險小。
資料來源更靈活，資料改變更靈活。
重構的原理與物件導向的開放封閉相似。
