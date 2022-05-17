<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arParams["POPUP_POSITION"] = (isset($arParams["POPUP_POSITION"]) && in_array($arParams["POPUP_POSITION"], array("left", "right"))) ? $arParams["POPUP_POSITION"] : "left";

/* remove empty sections */

foreach ($arResult['SECTIONS']  as $key => $value){
   if(0 == $arResult['SECTIONS'][$key]['ELEMENT_CNT'])
   {
      unset($arResult['SECTIONS'][$key]);
   }
}

foreach($arResult["ITEMS"] as $key => $arItem)
{
	/*unset empty values*/
	if (
		(
		 ($arItem["DISPLAY_TYPE"] == "A" || isset($arItem["PRICE"]))
		 && ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
		)
		|| !$arItem["VALUES"]
	)
		unset($arResult["ITEMS"][$key]);
	/**/
	
	if($arItem["CODE"]=="IN_STOCK"){
		if(is_array($arResult["ITEMS"][$key]["VALUES"]))
			sort($arResult["ITEMS"][$key]["VALUES"]);
		
		if($arResult["ITEMS"][$key]["VALUES"])
			$arResult["ITEMS"][$key]["VALUES"][0]["VALUE"]=$arItem["NAME"];
	}
}

// sort CEFR
foreach($arResult["ITEMS"] as $k => &$prop){
    $values = [];
    foreach ($prop["VALUES"] as $key => $sortkey) {
        $values[$key]  = $sortkey['VALUE'];
    }
    $values = array_diff($values, ["A1"]);
    array_multisort($values, SORT_ASC, $prop['VALUES']);
    unset($values);
}

\Bitrix\Main\Localization\Loc::loadLanguageFile(__FILE__);

if (!$arResult['ITEMS']) {
	$arResult['EMPTY_ITEMS'] = true;
}

// sort
if ($arParams['SHOW_SORT']) {
	include 'sort.php';
}

global $sotbitFilterResult;
$sotbitFilterResult = $arResult;