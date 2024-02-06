<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
use Bitrix\Main\Loader;

Loader::includeModule('iblock');

//$el = new CIBlockElement();
//$arLoadProductArray = [
//	'NAME'=>'ХАХ, Лови',
//	'IBLOCK_ID'=>10,
//	'ACTIVE_FROM'=>date( '13.06.2000'),
//];
//
//if($productID = $el->Add($arLoadProductArray)){
//	echo 'Новый ID:'.$productID;
//}

$el = new CIBlockElement();
$arUpdateProductArray = [
	'NAME'=>'Конь'
];
$elementID = 31;
$res = $el->Update($elementID,$arUpdateProductArray);
	echo 'lol';
?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>