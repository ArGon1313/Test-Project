<?

use Bitrix\Iblock\Elements\ElementBlogsortTable;
use Bitrix\Main\Loader;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>
<?php
Loader::includeModule('iblock');

//бекенд получения данных
$obElements = ElementBlogsortTable::getList(array(
    'select' => array('NAME', 'ID', 'SORT')
));
$arElements = $obElements->fetchAll();
echo '<pre>';
print_r($arElements);
echo '</pre>';

foreach ($arElements as $key => $arElement) {
    if ($arElement['SORT'] > 0) {
        $arElements[$key]['SORT'] = $arElement['SORT'] * 100;
    } elseif ($arElement['SORT'] == 0) {
        $arElements[$key]['SORT'] = $arElement['SORT'] + 50;
    }

//
//    echo '<pre>';
//    print_r($arElements);
//    echo '</pre>';
//    echo $arElement['ID'];
//    echo '<br />';
//    echo $arElements[$key]['ID'];
//    foreach ($arElement as $key2 => $strVal){
//        // key2 = 'SORT'
//        // strval = 100
//        if($key2 == 'SORT'){
//            if($strVal == 0){
//
//                $arElements[$key][$key2] = $strVal + 50;
//
//            }
//            if($strVal > 0){
//                $arElements[$key][$key2] = $strVal * 100;
//            }
//        }
//    }
}
//echo '<br />';
//echo $arElements[4]['ID'];
echo '<pre>';
print_r($arElements);
echo '</pre>';
?>

