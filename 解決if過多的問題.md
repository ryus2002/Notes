輸入縣市能查詢出是電話開頭。

<?php
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
