<?php
//Подключили header.php и ядро битрикса
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
use Bitrix\Main\Loader;

//Подключаем модуль инфоблоков
Loader::includeModule('iblock');


$arFilter = array(
    'IBLOCK_ID' => 11,
    'ACTIVE' => 'Y',
);
//Создал переменную , которая является массивом, которая выступает фильтром для значений, а именно
// оторабаражет тольк те данные которые входят в 11 инфоблок.И имеют флаг активности 'Y'.

$arSort = array(
    'ID' => 'ASC',
);

// Создал переменную, которой присвается знаение массива. Выполняет функцию сортировки, которая идет
// По ID по возростанию.
$arSelect = array(
    'ID',
    'NAME',
    'CODE',
    'IBLOCK_SECTION_ID'
);

// Делаю селект, т.е выборку необходимых значений, т.е значений которые будут выводиться

$obElements = CIBlockElement::GetList($arSort, $arFilter,
    false, false, $arSelect);

echo '<pre>';
print_r($obElements);
echo '</pre>';
//Пользуюсь GitList для получения Свойств элементов в инфоблоке. Соответственно, вставляю сюда параметры
// которые ранее присвоил переменным.

$arElements = array();
// Присвоил переменной значение пустого массива, что бы в дальнейшем с ней работать.

while ($arElement = $obElements->Fetch())
// Присваиваю переменной $arElement значения выполнения метода Fetch() объекта $obElements.
// Цикл работает до тех под пока метод Fetch() не вернет false, поскольку он раждый раз возвращает массив полей записи из базы данных если в объекте еще остались записи.
// ссылка на документацию по Fetch() https://dev.1c-bitrix.ru/api_help/main/reference/cdbresult/fetch.php
{
    echo '<pre>';
    print_r($arElement);
    echo '</pre>';
    $arElements[$arElement['ID']] = $arElement;
    //
}

$arSort = array(
    'ID' => 'ASC',
);
$arFilter = array(
    'IBLOCK_ID' => 11,
    'ACTIVE' => 'Y',
);
$arSelect = array(
    'ID',
    'NAME',
    'CODE',
);

$rsSections = CIBlockSection::GetList($arSort, $arFilter,
    false,$arSelect,false);

$arSections = array();
while ($arSection = $rsSections->Fetch()) {
    $arSections[$arSection['ID']] = $arSection;
}

foreach ($arElements as $key => $arElement) {
    $elementID = $arElement['ID'];
    $propCode = "ID_SECTION";
    $propValue = $arSections[$arElement['IBLOCK_SECTION_ID']]['NAME'];

    CIBlockElement::SetPropertyValuesEx($elementID, false,
        array($propCode => $propValue));
}
