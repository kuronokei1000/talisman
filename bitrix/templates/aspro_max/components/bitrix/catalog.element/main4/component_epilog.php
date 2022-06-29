<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	__IncludeLang($_SERVER["DOCUMENT_ROOT"].$templateFolder."/lang/".LANGUAGE_ID."/template.php");

use Bitrix\Main\Loader,
	Bitrix\Main\ModuleManager,
	Bitrix\Main\Localization\Loc;

global $arTheme, $arRegion;

$arBlockOrder = explode(",", $arParams["DETAIL_BLOCKS_ORDER"]);
$arTabOrder = explode(",", $arParams["DETAIL_BLOCKS_TAB_ORDER"]);

//add new blocks in update
if( !in_array('buy_services', $arTabOrder) ){
	$arTabOrder[] = 'buy_services';
}

$bCombineStoresMode = ($arTheme['STORE_AMOUNT_VIEW']['VALUE'] == "COMBINE_AMOUNT");

$bServicesRegionality = $arTheme['SERVICES_REGIONALITY']['VALUE'] === 'Y' && $arTheme['USE_REGIONALITY']['VALUE'] === 'Y' && $arTheme['USE_REGIONALITY']['DEPENDENT_PARAMS']['REGIONALITY_FILTER_ITEM']['VALUE'] === 'Y';

if($arTheme['USE_DETAIL_TABS']['VALUE'] != 'Y'){
	$arBlockOrder = explode(",", $arParams["DETAIL_BLOCKS_ALL_ORDER"]);
	
	//add new blocks in update
	if( !in_array('buy_services', $arBlockOrder) ){
		$arBlockOrder[] = 'buy_services';
	}
}

//add new blocks in update
if( !in_array('modules', $arBlockOrder) ){
	$arBlockOrder[] = 'modules';
}

$currentProductId = $templateData['OFFERS_INFO']["CURRENT_OFFER"] ?? $arResult['ID'] ;

?><?if($arResult["ID"]):?>
	<?//tizers?>
	<?if($templateData['LINK_TIZERS'] && $arParams['IBLOCK_TIZERS_ID']):?>
		<?$GLOBALS['arrTizersFilter'] = array('ID' => $templateData['LINK_TIZERS']);?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"front_tizers",
			array(
				"IBLOCK_TYPE" => "aspro_max_content",
				"IBLOCK_ID" => $arParams['IBLOCK_TIZERS_ID'],
				"NEWS_COUNT" => "4",
				"SORT_BY1" => "SORT",
				"SORT_ORDER1" => "ASC",
				"SORT_BY2" => "ID",
				"SORT_ORDER2" => "DESC",
				"SMALL_BLOCK" => "Y",
				"FILTER_NAME" => "arrTizersFilter",
				"FIELD_CODE" => array(
					0 => "PREVIEW_PICTURE",
					1 => "PREVIEW_TEXT",
					2 => "DETAIL_PICTURE",
					3 => "",
				),
				"PROPERTY_CODE" => array(
					0 => "ICON",
					1 => "URL",
				),
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"CACHE_TYPE" => $arParams['CACHE_TYPE'],
				"CACHE_TIME" => "36000000",
				"CACHE_FILTER" => "Y",
				"CACHE_GROUPS" => "N",
				"PREVIEW_TRUNCATE_LEN" => "250",
				"ACTIVE_DATE_FORMAT" => "d F Y",
				"SET_TITLE" => "N",
				"SHOW_DETAIL_LINK" => "N",
				"SET_STATUS_404" => "N",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"ADD_SECTIONS_CHAIN" => "N",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"PAGER_TITLE" => "",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => "ajax",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600",
				"PAGER_SHOW_ALL" => "N",
				"DISPLAY_DATE" => "Y",
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => "N",
				"DISPLAY_PREVIEW_TEXT" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"COMPONENT_TEMPLATE" => "front_tizers",
				"SET_BROWSER_TITLE" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_LAST_MODIFIED" => "N",
				"INCLUDE_SUBSECTIONS" => "Y",
				"STRICT_SECTION_CHECK" => "N",
				"TYPE_IMG" => "left",
				"CENTERED" => "Y",
				"SIZE_IN_ROW" => "4",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"SHOW_404" => "N",
				"MESSAGE_404" => ""
			),
			false, array("HIDE_ICONS" => "Y")
		);?>
	<?endif;?>

	<?//sales?>
	<?if($templateData['LINK_SALES'] && $arParams['IBLOCK_LINK_SALE_ID']):?>
		<?ob_start()?>
			<?$GLOBALS['arrSalesFilter'] = array('ID' => $templateData['LINK_SALES']);?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"linked_sales",
				array(
					"IBLOCK_TYPE" => "aspro_max_content",
					"IBLOCK_ID" => $arParams['IBLOCK_LINK_SALE_ID'],
					"NEWS_COUNT" => "20",
					"SORT_BY1" => "SORT",
					"SORT_ORDER1" => "ASC",
					"SORT_BY2" => "ID",
					"SORT_ORDER2" => "DESC",
					"FILTER_NAME" => "arrSalesFilter",
					"FIELD_CODE" => array(
						0 => "NAME",
						1 => "DETAIL_PAGE_URL",
						3 => "DETAIL_TEXT",
					),
					"PROPERTY_CODE" => array(
						0 => "REDIRECT",
					),
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"AJAX_OPTION_HISTORY" => "N",
					"CACHE_TYPE" => $arParams['CACHE_TYPE'],
					"CACHE_TIME" => "36000000",
					"CACHE_FILTER" => "Y",
					"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
					"CACHE_GROUPS" => "N",
					"PREVIEW_TRUNCATE_LEN" => "",
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"SET_TITLE" => "N",
					"SET_STATUS_404" => "N",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"ADD_SECTIONS_CHAIN" => "N",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"INCLUDE_SUBSECTIONS" => "Y",
					"PAGER_TEMPLATE" => ".default",
					"DISPLAY_TOP_PAGER" => "N",
					"DISPLAY_BOTTOM_PAGER" => "Y",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"VIEW_TYPE" => "list",
					"IMAGE_POSITION" => "left",
					"COUNT_IN_LINE" => "3",
					"SHOW_TITLE" => "Y",
					"AJAX_OPTION_ADDITIONAL" => ""
				),
				false, array("HIDE_ICONS" => "Y")
			);?>
		<?$html=ob_get_clean();?>
		<?$APPLICATION->AddViewContent('PRODUCT_SIDE_INFO', $html, 100);?>
	<?endif;?>

	<?$bShowAllServicesInAnounce = $templateData["OFFERS_INFO"]["OFFERS_MORE"] || (isset($arParams["SHOW_ALL_SERVICES_IN_SLIDE"]) && $arParams["SHOW_ALL_SERVICES_IN_SLIDE"] === 'Y');?>
	<?if($templateData['LINK_SERVICES']):?>
		<?//buy_services in anounce	
		ob_start();		
			$GLOBALS['arBuyServicesFilter']['ID'] = $templateData['LINK_SERVICES'];
			$GLOBALS['arBuyServicesFilter']['PROPERTY_ALLOW_BUY_VALUE'] = 'Y';
			if( $bServicesRegionality && isset($arRegion['ID']) ){
				$GLOBALS['arBuyServicesFilter'][] = array( "PROPERTY_LINK_REGION" => $arRegion['ID'] );
			}
			?>										
			<?$APPLICATION->IncludeComponent(
				"bitrix:catalog.section",
				"services_list",
				[
					'IBLOCK_ID' => $arParams['IBLOCK_SERVICES_ID'],
					'PRICE_CODE' => $arParams['PRICE_CODE'],
					'FILTER_NAME' => 'arBuyServicesFilter',
					'PROPERTIES' => [],
					"SHOW_OLD_PRICE" => $arParams["SHOW_OLD_PRICE"],
					'CACHE_TYPE' => $arParams['CACHE_TYPE'],
					'CACHE_TIME' => $arParams['CACHE_TIME'],
					'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
					'SHOW_ALL_WO_SECTION' => 'Y',
					"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
					"CURRENCY_ID" => $arParams["CURRENCY_ID"],
					"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"] ? 'Y' : 'N',
					"PAGE_ELEMENT_COUNT" => $bShowAllServicesInAnounce ? '999' : $arParams["COUNT_SERVICES_IN_ANNOUNCE"],
					"SHOW_BUTTON_ALL" => 'Y',
					"SHOW_ALL_IN_SLIDE" => $bShowAllServicesInAnounce ? 'Y' : 'N' ,
					"COUNT_SERVICES_IN_ANNOUNCE" => $bShowAllServicesInAnounce ? $arParams["COUNT_SERVICES_IN_ANNOUNCE"] : 0,
					//"SHOW_PLACE" => 'announce',
					"COMPACT_MODE" => 'Y',
				],
				false, array("HIDE_ICONS"=>"Y")
			);?>
		<?$htmlBuyServicesAnounce=ob_get_clean();
		if($htmlBuyServicesAnounce && trim($htmlBuyServicesAnounce) && strpos($htmlBuyServicesAnounce, 'error') === false){?>
			<?
			$htmlBuyServicesAnounceBefore = '<div class=" buy_services_wrap in_announce js-services-hide" data-parent_product='.$currentProductId.'>';
			$htmlBuyServicesAnounce = $htmlBuyServicesAnounceBefore.$htmlBuyServicesAnounce.'</div>';			
			$APPLICATION->AddViewContent('PRODUCT_SIDE_INFO', $htmlBuyServicesAnounce, 550);			
			?>
		<?}?>
	<?endif;?>

	<?
	$buyServices = false;
	if(!$bShowAllServicesInAnounce):
		ob_start();		
			$GLOBALS['arBuyServicesFilter']['ID'] = $templateData['LINK_SERVICES'];
			$GLOBALS['arBuyServicesFilter']['PROPERTY_ALLOW_BUY_VALUE'] = 'Y';
			if( $bServicesRegionality && isset($arRegion['ID']) ){
				$GLOBALS['arBuyServicesFilter'][] = array( "PROPERTY_LINK_REGION" => $arRegion['ID'] );
			}
			?>										
			<?$APPLICATION->IncludeComponent(
				"bitrix:catalog.section",
				"services_list",
				[
					'IBLOCK_ID' => $arParams['IBLOCK_SERVICES_ID'],
					'PRICE_CODE' => $arParams['PRICE_CODE'],
					'FILTER_NAME' => 'arBuyServicesFilter',
					'PROPERTIES' => [],
					"SHOW_OLD_PRICE" => $arParams["SHOW_OLD_PRICE"],
					'CACHE_TYPE' => $arParams['CACHE_TYPE'],
					'CACHE_TIME' => $arParams['CACHE_TIME'],
					'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
					'SHOW_ALL_WO_SECTION' => 'Y',
					"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
					"CURRENCY_ID" => $arParams["CURRENCY_ID"],
					"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"] ? 'Y' : 'N',
					"PAGE_ELEMENT_COUNT" => '999',
					"COUNT_SERVICES_IN_ANNOUNCE" => $arParams["COUNT_SERVICES_IN_ANNOUNCE"],
				],
				false, array("HIDE_ICONS"=>"Y")
			);?>
		<?$htmlBuyServices=ob_get_clean();
		if($htmlBuyServices && trim($htmlBuyServices) && strpos($htmlBuyServices, 'error') === false){
			$buyServices = true;
		}?>
	<?endif;?>

	<?$i = 0;
	$templateData["STORES"]["SITE_ID"] = SITE_ID;
	$bShowDocs = ($templateData["FILES"]);
	$bShowAdditionalGallery = ($templateData["ADDITIONAL_GALLERY"]);
	$bShowDetailText = ($templateData['DETAIL_TEXT']);
	$bShowDetailTextTab = ($bShowDetailText || $bShowDocs || $bShowAdditionalGallery ? ++$i : '');
	$bShowPropsTab = ($templateData['CHARACTERISTICS'] ? ++$i : '');
	$bShowVideoTab = (!empty($templateData['VIDEO']) || !empty($templateData['VIDEO_IFRAME']) ? ++$i : '');
	$bShowFaqTab = (!empty($templateData['LINK_FAQ']) ? ++$i : '');
	$bShowProjecTab = (!empty($templateData['LINK_PROJECTS']) ? ++$i : '');
	$bShowHowBuyTab = (($arParams["SHOW_HOW_BUY"] == "Y") ? ++$i : '');
	$bShowPaymentTab = (($arParams["SHOW_PAYMENT"] == "Y") ? ++$i : '');
	$bShowDeliveryTab = (($arParams["SHOW_DELIVERY"] == "Y") ? ++$i : '');
	$bShowCustomTab = (($arParams['SHOW_ADDITIONAL_TAB'] == 'Y') ? ++$i : '');
	$bShowStoresTab = ($templateData["STORES"]['USE_STORES'] && $templateData["STORES"]["STORES"] ? ++$i : '');
	$bShowReviewsTab = ( ($arParams["USE_REVIEW"] == "Y" && ($templateData["YM_ELEMENT_ID"] || IsModuleInstalled("forum")) ) ? ++$i : '');
	$bShowBuyServicesTab = ($templateData['LINK_SERVICES'] && $buyServices ? ++$i : '');

	if($bShowPropsTab && $arParams["PROPERTIES_DISPLAY_LOCATION"] != "TAB")
		--$i;?>

	<div class="maxwidth-theme bottom-info-wrapper">
		<div class="bottom-info product-view--side-left">
			<?foreach($arBlockOrder as $code):?>
				<?//complect?>
				<?if($code == 'complect' && $templateData['CATALOG_SETS']['SET_ITEMS'] && $arParams['SHOW_KIT_PARTS'] == "Y"):?>
					<div class="ordered-block">
						<div class="ordered-block__title option-font-bold font_lg"><?=($arParams["T_KOMPLECT"] ? $arParams["T_KOMPLECT"] : Loc::getMessage('KOMPLECT_TITLE'));?></div>
						<div class="complect set_wrapp set_block bordered rounded3">
							<div class="row flexbox flexbox--row">
								<?foreach($templateData['CATALOG_SETS']["SET_ITEMS"] as $iii => $arSetItem):?>
									<div class="col-sm-3">
										<div class="item box-shadow">
											<div class="item_inner">
												<div class="image">
													<?$arSetItem["SET"] = "Y";?>
													<?\Aspro\Functions\CAsproMaxItem::showImg($arParams, $arSetItem, false);?>
													<?if($templateData['CATALOG_SETS']["SET_ITEMS_QUANTITY"]):?>
														<div class="quantity font_sxs">x<?=$arSetItem["QUANTITY"];?></div>
													<?endif;?>
												</div>
												<div class="item_info">
													<div class="item-title">
														<a href="<?=$arSetItem["DETAIL_PAGE_URL"]?>" class="dark_link font_xs"><span><?=$arSetItem["NAME"]?></span></a>
													</div>
													<?if($arParams["SHOW_KIT_PARTS_PRICES"] == "Y"):?>
														<div class="cost prices clearfix">
															<?
															$arCountPricesCanAccess = 0;
															foreach($arSetItem["PRICES"] as $key => $arPrice){
																if($arPrice["CAN_ACCESS"]){
																	$arCountPricesCanAccess++;
																}
															}

															if($arSetItem["MEASURE"][$arSetItem["ID"]]["MEASURE"]["SYMBOL_RUS"])
																$strMeasure = $arSetItem["MEASURE"][$arSetItem["ID"]]["MEASURE"]["SYMBOL_RUS"];
															?>
															<?if(isset($arSetItem['PRICE_MATRIX']) && $arSetItem['PRICE_MATRIX']):?>
																<?
																// USE_PRICE_COUNT
																if(\CMax::GetFrontParametrValue('SHOW_POPUP_PRICE') == 'Y' && (count($arSetItem['PRICE_MATRIX']['ROWS']) > 1 || count($arSetItem['PRICE_MATRIX']['COLS']) > 1)){
																	echo CMax::showPriceRangeTop($arSetItem, $arParams, Loc::getMessage("CATALOG_ECONOMY"));
																}
																echo CMax::showPriceMatrix($arSetItem, $arParams, $strMeasure, $arAddToBasketData);
																?>
															<?else:?>
																<?\Aspro\Functions\CAsproMaxItem::showItemPrices($arParams, $arSetItem["PRICES"], $strMeasure, $min_price_id, ($arParams["SHOW_DISCOUNT_PERCENT_NUMBER"] == "Y" ? "N" : "Y"));?>
															<?endif;?>
														</div>
													<?endif;?>
												</div>
											</div>
										</div>
										<?if($templateData['CATALOG_SETS']["SET_ITEMS"][$iii + 1]):?>
											<div class="separator"></div>
										<?endif;?>
									</div>
								<?endforeach;?>
							</div>
						</div>
					</div>
				<?//nabor?>
				<?elseif($code == 'nabor'):?>
					<?if($templateData['OFFERS_INFO']['OFFERS']):?>
						<?if($templateData['OFFERS_INFO']['OFFER_GROUP']):?>
							<?foreach($templateData['OFFERS_INFO']['OFFERS'] as $offerId => $arOfferGroup):?>
								<?if(!$arOfferGroup) continue;?>
								<span data-offerSetId="<?=$offerId?>" id="<?=$templateData['ID_OFFER_GROUP'].$offerId?>" <?if($offerId != $templateData["OFFERS_INFO"]["CURRENT_OFFER"]):?>style="display: none;"<?endif;?>>
									<?$APPLICATION->IncludeComponent("bitrix:catalog.set.constructor", "main",
										array(
											"IBLOCK_ID" => $templateData['OFFERS_INFO']["OFFERS_IBLOCK"],
											"ELEMENT_ID" => $offerId,
											"PRICE_CODE" => $arParams["PRICE_CODE"],
											"BASKET_URL" => $arParams["BASKET_URL"],
											"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
											"CACHE_TYPE" => $arParams["CACHE_TYPE"],
											"CACHE_TIME" => $arParams["CACHE_TIME"],
											"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
											"SHOW_OLD_PRICE" => $arParams["SHOW_OLD_PRICE"],
											"BUNDLE_ITEMS_COUNT" => $arParams["BUNDLE_ITEMS_COUNT"],
											"SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
											"SHOW_DISCOUNT_PERCENT" => $arParams["SHOW_DISCOUNT_PERCENT"],
											"TITLE" => $arParams["T_NABOR"],
											"CONVERT_CURRENCY" => $arParams['CONVERT_CURRENCY'],
											"CURRENCY_ID" => $arParams["CURRENCY_ID"]
										), $component, array("HIDE_ICONS" => "Y")
									);?>
								</span>
							<?endforeach;?>
						<?endif;?>
					<?else:?>
						<?$APPLICATION->IncludeComponent("bitrix:catalog.set.constructor", "main",
							array(
								"IBLOCK_ID" => $arParams["IBLOCK_ID"],
								"ELEMENT_ID" => $arResult["ID"],
								"PRICE_CODE" => $arParams["PRICE_CODE"],
								"BASKET_URL" => $arParams["BASKET_URL"],
								"CACHE_TYPE" => $arParams["CACHE_TYPE"],
								"CACHE_TIME" => $arParams["CACHE_TIME"],
								"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
								"SHOW_OLD_PRICE" => $arParams["SHOW_OLD_PRICE"],
								"BUNDLE_ITEMS_COUNT" => $arParams["BUNDLE_ITEMS_COUNT"],
								"SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
								"SHOW_DISCOUNT_PERCENT" => $arParams["SHOW_DISCOUNT_PERCENT"],
								"TITLE" => $arParams["T_NABOR"],
								"CONVERT_CURRENCY" => $arParams['CONVERT_CURRENCY'],
								"CURRENCY_ID" => $arParams["CURRENCY_ID"]
							), $component, array("HIDE_ICONS" => "Y")
						);?>
					<?endif;?>
				<?//tabs?>
				<?elseif($code == 'tabs'):?>
					<?if($bShowDetailTextTab || $bShowPropsTab || $bShowVideoTab || $bShowHowBuyTab || $bShowPaymentTab || $bShowDeliveryTab || $bShowStoresTab || $bShowCustomTab || $bShowReviewsTab || $bShowBuyServicesTab):?>
						<div class="ordered-block js-store-scroll tabs-block">
							<?if($i > 1):?>
								<div class="tabs arrow_scroll">
									<ul class="nav nav-tabs font_upper_md">
										<?$iTab = 0;?>
										<?foreach($arTabOrder as $value):?>
											<?//show desc block?>
											<?if($value == "desc"):?>
												<?if($bShowDetailTextTab || ($arParams["PROPERTIES_DISPLAY_LOCATION"] != "TAB" && $bShowPropsTab)):?>
													<li class="bordered rounded3 <?=(!($iTab++) ? 'active' : '')?>"><a href="#desc" data-toggle="tab"><?=($arParams["T_DESC"] ? $arParams["T_DESC"] : Loc::getMessage("T_DESC"));?></a></li>
												<?endif;?>
											<?endif;?>
											<?//show char block?>
											<?if($value == "char"):?>
												<?if($bShowPropsTab && $arParams["PROPERTIES_DISPLAY_LOCATION"] == "TAB"):?>
													<li class="bordered rounded3 <?=(!($iTab++) ? 'active' : '')?>"><a href="#props" data-toggle="tab"><?=($arParams["T_CHARACTERISTICS"] ? $arParams["T_CHARACTERISTICS"] : Loc::getMessage("T_CHARACTERISTICS"));?></a></li>
												<?endif;?>
											<?endif;?>
											<?//show howbuy block?>
											<?if($value == "buy"):?>
												<?if($bShowHowBuyTab):?>
													<li class="bordered rounded3 <?=(!($iTab++) ? 'active' : '')?>"><a href="#buy" data-toggle="tab"><?=$arParams["TITLE_HOW_BUY"];?></a></li>
												<?endif;?>
											<?endif;?>
											<?//show payment block?>
											<?if($value == "payment"):?>
												<?if($bShowPaymentTab):?>
													<li class="bordered rounded3 <?=(!($iTab++) ? 'active' : '')?>"><a href="#payment" data-toggle="tab"><?=$arParams["TITLE_PAYMENT"];?></a></li>
												<?endif;?>
											<?endif;?>
											<?//show delivery block?>
											<?if($value == "delivery"):?>
												<?if($bShowDeliveryTab):?>
													<li class="bordered rounded3 <?=(!($iTab++) ? 'active' : '')?>"><a href="#delivery" data-toggle="tab"><?=$arParams["TITLE_DELIVERY"];?></a></li>
												<?endif;?>
											<?endif;?>
											<?//show stores block?>
											<?if($value == "stores"):?>
												<?if($bShowStoresTab):?>
													<li class="bordered rounded3 <?=(!($iTab++) ? 'active' : '')?>"><a href="#stores" data-toggle="tab"><?=$arParams["TAB_STOCK_NAME"];?></a></li>
												<?endif;?>
											<?endif;?>
											<?//show custom_tab block?>
											<?if($value == "custom_tab"):?>
												<?if($bShowCustomTab):?>
													<li class="bordered rounded3 <?=(!($iTab++) ? 'active' : '')?>"><a href="#custom_tab" data-toggle="tab"><?=$arParams["TAB_DOPS_NAME"];?></a></li>
												<?endif;?>
											<?endif;?>
											<?//show reviews block?>
											<?if($value == "reviews"):?>
												<?if($bShowReviewsTab):?>
													<li class="bordered rounded3 <?=(!($iTab++) ? 'active' : '')?>">
														<a href="#reviews" data-toggle="tab"><?=$arParams["TAB_REVIEW_NAME"];?><?$APPLICATION->ShowViewContent('PRODUCT_REVIWS_COUNT_INFO')?></a></li>
												<?endif;?>
											<?endif;?>
											<?//show video block?>
											<?if($value == "video"):?>
												<?if($bShowVideoTab):?>
													<li class="bordered rounded3 <?=(!($iTab++) ? 'active' : '')?>">
														<a href="#video" data-toggle="tab">
															<?=$arParams["TAB_VIDEO_NAME"];?>
															<?if(count($templateData["VIDEO"]) > 1):?>
																<span class="count empty">&nbsp;(<?=count($templateData["VIDEO"])?>)</span>
															<?endif;?>
														</a>
													</li>
												<?endif;?>
											<?endif;?>
											<?//show buy_services block?>
											<?if($value == "buy_services"):?>
												<?if($bShowBuyServicesTab):?>
													<li class="bordered rounded3 <?=(!($iTab++) ? 'active' : '')?>">
														<a href="#buy_services" data-toggle="tab">
															<?=$arParams["TAB_BUY_SERVICES_NAME"];?>													
														</a>
													</li>
												<?endif;?>
											<?endif;?>
										<?endforeach;?>
									</ul>
								</div>
							<?endif;?>
							<div class="tab-content<?=($i <= 1 ? ' not_tabs' : '')?>">
								<?$iTab = 0;?>
								<?foreach($arTabOrder as $value):?>
									<?//detail text?>
									<?if($value == "desc"):?>
										<?if($bShowDetailTextTab || ($arParams["PROPERTIES_DISPLAY_LOCATION"] != "TAB" && $bShowPropsTab)):?>
											<div class="tab-pane <?=(!($iTab++) ? 'active' : '')?>" id="desc">
												<?if($bShowDetailText):?>
													<?if($i == 1):?>
														<div class="ordered-block__title option-font-bold font_lg">
															<?=($arParams["T_DESC"] ? $arParams["T_DESC"] : Loc::getMessage("T_DESC"));?>
														</div>
													<?endif;?>
													<?$APPLICATION->ShowViewContent('PRODUCT_DETAIL_TEXT_INFO')?>
												<?endif;?>
												<?if($arParams["PROPERTIES_DISPLAY_LOCATION"] != "TAB" && $bShowPropsTab):?>
													<div class="ordered-block">
														<div class="ordered-block__title option-font-bold font_lg">
															<?=($arParams["T_CHARACTERISTICS"] ? $arParams["T_CHARACTERISTICS"] : Loc::getMessage("T_CHARACTERISTICS"));?>
														</div>
														<?$APPLICATION->ShowViewContent('PRODUCT_PROPS_INFO')?>
													</div>
												<?endif;?>
												<?if($bShowDocs):?>
													<div class="ordered-block">
														<div class="ordered-block__title option-font-bold font_lg">
															<?=$arParams["BLOCK_DOCS_NAME"];?>
														</div>
														<?$APPLICATION->ShowViewContent('PRODUCT_FILES_INFO')?>
													</div>
												<?endif;?>
												<?if($bShowAdditionalGallery):?>
													<?$APPLICATION->ShowViewContent('PRODUCT_ADDITIONAL_GALLERY_INFO')?>
												<?endif;?>
											</div>
										<?endif;?>
									<?endif;?>
									<?//props?>
									<?if($value == "char"):?>
										<?if($bShowPropsTab && $arParams["PROPERTIES_DISPLAY_LOCATION"] == "TAB"):?>
											<div class="tab-pane <?=$value;?> <?=(!($iTab++) ? 'active' : '')?>" id="props">
												<?if($i == 1):?>
													<div class="ordered-block__title option-font-bold font_lg">
														<?=($arParams["T_CHARACTERISTICS"] ? $arParams["T_CHARACTERISTICS"] : Loc::getMessage("T_CHARACTERISTICS"));?>
													</div>
												<?endif;?>
												<?$APPLICATION->ShowViewContent('PRODUCT_PROPS_INFO')?>
											</div>
										<?endif;?>
									<?endif;?>
									<?//how buy?>
									<?if($value == "buy"):?>
										<?if($bShowHowBuyTab):?>
											<div class="tab-pane <?=$value;?> <?=(!($iTab++) ? 'active' : '')?>" id="buy">
												<?if($i == 1):?>
													<div class="ordered-block__title option-font-bold font_lg">
														<?=$arParams["TITLE_HOW_BUY"];?>
													</div>
												<?endif;?>
												<?$APPLICATION->ShowViewContent('PRODUCT_HOW_BUY_INFO')?>
											</div>
										<?endif;?>
									<?endif;?>
									<?//payment?>
									<?if($value == "payment"):?>
										<?if($bShowPaymentTab):?>
											<div class="tab-pane <?=$value;?> <?=(!($iTab++) ? 'active' : '')?>" id="payment">
												<?if($i == 1):?>
													<div class="ordered-block__title option-font-bold font_lg">
														<?=$arParams["TITLE_PAYMENT"];?>
													</div>
												<?endif;?>
												<?$APPLICATION->ShowViewContent('PRODUCT_PAYMENT_INFO')?>
											</div>
										<?endif;?>
									<?endif;?>
									<?//delivery?>
									<?if($value == "delivery"):?>
										<?if($bShowDeliveryTab):?>
											<div class="tab-pane <?=$value;?> <?=(!($iTab++) ? 'active' : '')?>" id="delivery">
												<?if($i == 1):?>
													<div class="ordered-block__title option-font-bold font_lg">
														<?=$arParams["TITLE_DELIVERY"];?>
													</div>
												<?endif;?>
												<?$APPLICATION->ShowViewContent('PRODUCT_DELIVERY_INFO')?>
											</div>
										<?endif;?>
									<?endif;?>
									<?//custom_tab?>
									<?if($value == "custom_tab"):?>
										<?if($bShowCustomTab):?>
											<div class="tab-pane <?=$value;?> <?=(!($iTab++) ? 'active' : '')?>" id="custom_tab">
												<?if($i == 1):?>
													<div class="ordered-block__title option-font-bold font_lg">
														<?=$arParams["TAB_DOPS_NAME"];?>
													</div>
												<?endif;?>
												<?$APPLICATION->ShowViewContent('PRODUCT_CUSTOM_TAB_INFO')?>
											</div>
										<?endif;?>
									<?endif;?>
									<?//show video block?>
									<?if($value == "video"):?>
										<?if($bShowVideoTab):?>
											<div class="tab-pane <?=$value;?> <?=(!($iTab++) ? 'active' : '')?>" id="video">
												<?if($i == 1):?>
													<div class="ordered-block__title option-font-bold font_lg">
														<?=$arParams["TAB_VIDEO_NAME"];?>
													</div>
												<?endif;?>
												<?$APPLICATION->ShowViewContent('PRODUCT_VIDEO_INFO')?>
											</div>
										<?endif;?>
									<?endif;?>
									<?//show buy_services block?>
									<?if($value == "buy_services"):?>
										<?if($bShowBuyServicesTab):?>
											<div class="tab-pane <?=$value;?> <?=(!($iTab++) ? 'active' : '')?>" id="buy_services">
												<?if($i == 1):?>
													<div class="ordered-block__title option-font-bold font_lg">
														<?=$arParams["TAB_BUY_SERVICES_NAME"];?>
													</div>
												<?endif;?>
												<div class='buy_services_wrap js-scroll-services' data-parent_product=<?=$currentProductId?>>
													<?=$htmlBuyServices;?>
												</div>
											</div>
										<?endif;?>
									<?endif;?>
									<?//show stores block?>
									<?if($value == "stores"):?>
										<?if($bShowStoresTab):?>
											<div class="tab-pane <?=$value;?> <?=(!($iTab++) ? 'active' : '')?>" id="stores">
												<?if($i == 1 || $bCombineStoresMode):?>
													<div class="ordered-block__title option-font-bold font_lg">
														<?=$arParams["TAB_STOCK_NAME"];?>
													</div>
												<?endif;?>
												<div class="stores_tab">
													<div class="loading_block"><div class="loading_block_content"></div></div>
												</div>
											</div>
										<?endif;?>
									<?endif;?>
									<?//show reviews block?>
									<?if($value == "reviews"):?>
										<?if($bShowReviewsTab):?>
											<div class="tab-pane <?=$value;?> <?=$arParams['REVIEWS_VIEW']?> <?=(!($iTab++) ? 'active' : '')?>" id="reviews">
												<?if($i == 1 && $arParams['REVIEWS_VIEW'] == 'STANDART'):?>
													<div class="ordered-block__title option-font-bold font_lg">
														<?=$arParams["TAB_REVIEW_NAME"];?>
													</div>
												<?endif;?>
												<div id="reviews_content" class="<?=$arParams['REVIEWS_VIEW'] == 'EXTENDED' ? '' : 'bordered rounded3'?>">
													<?if($templateData["YM_ELEMENT_ID"]):?>
														<?$APPLICATION->IncludeComponent(
															"aspro:api.yamarket.reviews_model.max",
															"main",
															Array(
																"YANDEX_MODEL_ID" => $templateData["YM_ELEMENT_ID"]
															)
														);?>
													<?elseif(IsModuleInstalled("forum") && $arParams['REVIEWS_VIEW'] == 'STANDART'):?>
														<?Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("area");?>
															<?$APPLICATION->IncludeComponent(
																"bitrix:forum.topic.reviews",
																"main",
																Array(
																	"CACHE_TYPE" => $arParams["CACHE_TYPE"],
																	"CACHE_TIME" => $arParams["CACHE_TIME"],
																	"MESSAGES_PER_PAGE" => $arParams["MESSAGES_PER_PAGE"],
																	"USE_CAPTCHA" => $arParams["USE_CAPTCHA"],
																	"FORUM_ID" => $arParams["FORUM_ID"],
																	"ELEMENT_ID" => $arResult["ID"],
																	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
																	"AJAX_POST" => $arParams["REVIEW_AJAX_POST"],
																	"SHOW_RATING" => "N",
																	"SHOW_MINIMIZED" => "Y",
																	"SECTION_REVIEW" => "Y",
																	"POST_FIRST_MESSAGE" => "Y",
																	"MINIMIZED_MINIMIZE_TEXT" => GetMessage("HIDE_FORM"),
																	"MINIMIZED_EXPAND_TEXT" => GetMessage("ADD_REVIEW"),
																	"SHOW_AVATAR" => "N",
																	"SHOW_LINK_TO_FORUM" => "N",
																	"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
																),	false
															);?>
														<?Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("area", "");?>
													<?elseif(IsModuleInstalled("blog") && $arParams['REVIEWS_VIEW'] == 'EXTENDED' && ($arParams['USE_REVIEW'] == 'Y' || $arParams["DETAIL_USE_COMMENTS"] == 'Y') ):?>
														<div class="ordered-block__title option-font-bold font_lg">
															<?=$arParams["TAB_REVIEW_NAME"];?>
															<span class="element-count-wrapper">
																<span class="element-count muted font_xs rounded3" style="display: none;">
																</span>
															</span>
														</div>
														<div class="right_reviews_info">
															<div class="rating-wrapper">
																<div class="votes_block nstar with-text">
																	<div class="ratings">
																		<div class="inner_rating">
																			<?for($i=1;$i<=5;$i++):?>
																				<div class="item-rating"><?=CMax::showIconSvg("star", SITE_TEMPLATE_PATH."/images/svg/catalog/star_small.svg");?></div>
																			<?endfor;?>
																		</div>
																	</div>
																</div>
																<div class="rating-value">
																	<span class="count"></span>
																	<span class="maximum_value"><?=Loc::getMessage("VOTES_RESULT_NONE")?></span>
																</div>
															</div>
															<div class="show-comment btn btn-xs btn-default">
																<?=GetMessage('ADD_REVIEW')?>
															</div>
														</div>
														<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/rating_likes.js"); ?>
														<?Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("area");?>
														<?ob_start()?>
															<?$APPLICATION->IncludeComponent(
																"bitrix:catalog.comments",
																"catalog",
																array(
																	'CACHE_TYPE' => $arParams['CACHE_TYPE'],
																	'CACHE_TIME' => $arParams['CACHE_TIME'],
																	'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
																	"COMMENTS_COUNT" => (isset($arParams["MESSAGES_PER_PAGE"]) ? $arParams["MESSAGES_PER_PAGE"] : $arParams['COMMENTS_COUNT']),
																	"ELEMENT_CODE" => "",
																	"ELEMENT_ID" => $arResult["ID"],
																	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
																	"IBLOCK_TYPE" => "aspro_max_catalog",
																	"SHOW_DEACTIVATED" => "N",
																	"TEMPLATE_THEME" => "blue",
																	"URL_TO_COMMENT" => "",
																	"AJAX_POST" => "Y",
																	"WIDTH" => "",
																	"COMPONENT_TEMPLATE" => ".default",
																	"BLOG_USE" => 'Y',
																	"PATH_TO_SMILE" => '/bitrix/images/blog/smile/',
																	"EMAIL_NOTIFY" => $arParams["DETAIL_BLOG_EMAIL_NOTIFY"],
																	"SHOW_SPAM" => "Y",
																	"SHOW_RATING" => "Y",
																	"RATING_TYPE" => "like_graphic_catalog_reviews",
																	"MAX_IMAGE_SIZE" => $arParams["MAX_IMAGE_SIZE"],
																	"BLOG_URL" => $arParams["BLOG_URL"],
																),
																false, array("HIDE_ICONS" => "Y")
															);?>
															<?=\Aspro\Functions\CAsproMax::showComments()?>
															<?$html=ob_get_clean();?>
															<?if($html && strpos($html, 'error') === false):?>
																<div class="ordered-block comments-block">
																	<?=$html;?>
																</div>
																<div class="line-after"></div>
															<?endif;?>

														<?Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("area", "");?>
													<?endif;?>
												</div>
											</div>
										<?endif;?>
									<?endif;?>
								<?endforeach;?>
							</div>
						</div>
					<?endif;?>
				<?//offers?>
				<?elseif($code == 'offers' && $templateData["OFFERS_INFO"]["OFFERS_MORE"]):?>
					<div class="ordered-block js-offers-scroll <?=$code?>">
						<div class="ordered-block__title option-font-bold font_lg">
							<?=$arParams["TAB_OFFERS_NAME"];?>
						</div>
						<?$APPLICATION->ShowViewContent('PRODUCT_OFFERS_INFO')?>
					</div>
				<?//detail text?>
				<?elseif($code == 'desc' && $bShowDetailTextTab):?>
					<?if($bShowDetailText):?>
						<div class="ordered-block <?=$code?>">
							<div class="ordered-block__title option-font-bold font_lg">
								<?=($arParams["T_DESC"] ? $arParams["T_DESC"] : Loc::getMessage("T_DESC"));?>
							</div>
							<?$APPLICATION->ShowViewContent('PRODUCT_DETAIL_TEXT_INFO')?>
						</div>
					<?endif;?>
					<?//docs?>
					<?if($bShowDocs):?>
						<div class="ordered-block <?=$code?>">
							<div class="ordered-block__title option-font-bold font_lg">
								<?=$arParams["BLOCK_DOCS_NAME"];?>
							</div>
							<?$APPLICATION->ShowViewContent('PRODUCT_FILES_INFO')?>
						</div>
					<?endif;?>
					<?if($bShowAdditionalGallery):?>
						<?$APPLICATION->ShowViewContent('PRODUCT_ADDITIONAL_GALLERY_INFO')?>
					<?endif;?>
				<?//props?>
				<?elseif($code == 'char' && $bShowPropsTab):?>
					<div class="ordered-block <?=$code?>">
						<div class="ordered-block__title option-font-bold font_lg">
							<?=($arParams["T_CHARACTERISTICS"] ? $arParams["T_CHARACTERISTICS"] : Loc::getMessage("T_CHARACTERISTICS"));?>
						</div>
						<?$APPLICATION->ShowViewContent('PRODUCT_PROPS_INFO')?>
					</div>
				<?//howbuy?>
				<?elseif($code == 'buy' && $bShowHowBuyTab):?>
					<div class="ordered-block <?=$code?>">
						<div class="ordered-block__title option-font-bold font_lg">
							<?=$arParams["TITLE_HOW_BUY"];?>
						</div>
						<?$APPLICATION->ShowViewContent('PRODUCT_HOW_BUY_INFO')?>
					</div>
				<?//payment?>
				<?elseif($code == 'payment' && $bShowPaymentTab):?>
					<div class="ordered-block <?=$code?>">
						<div class="ordered-block__title option-font-bold font_lg">
							<?=$arParams["TITLE_PAYMENT"];?>
						</div>
						<?$APPLICATION->ShowViewContent('PRODUCT_PAYMENT_INFO')?>
					</div>
				<?//delivery?>
				<?elseif($code == 'delivery' && $bShowDeliveryTab):?>
					<div class="ordered-block <?=$code?>">
						<div class="ordered-block__title option-font-bold font_lg">
							<?=$arParams["TITLE_DELIVERY"];?>
						</div>
						<?$APPLICATION->ShowViewContent('PRODUCT_DELIVERY_INFO')?>
					</div>
				<?//show video block?>
				<?elseif($code == "video" && $bShowVideoTab):?>
					<div class="ordered-block <?=$code?>">
						<div class="ordered-block__title option-font-bold font_lg">
							<?=$arParams["TAB_VIDEO_NAME"];?>
							<?if(count($templateData["VIDEO"]) > 1):?>
								<span class="count empty">&nbsp;(<?=count($templateData["VIDEO"])?>)</span>
							<?endif;?>
						</div>
						<?$APPLICATION->ShowViewContent('PRODUCT_VIDEO_INFO')?>
					</div>
				<?//show buy_services block?>
				<?elseif($code == "buy_services" && $bShowBuyServicesTab):?>
					<div class="ordered-block <?=$code?> js-scroll-services">
						<div class="ordered-block__title option-font-bold font_lg">
							<?=$arParams["TAB_BUY_SERVICES_NAME"];?>					
						</div>
						<div class='buy_services_wrap' data-parent_product=<?=$currentProductId?>>
							<?=$htmlBuyServices;?>
						</div>
					</div>
				<?//show reviews block?>
				<?elseif($code == "reviews" && $bShowReviewsTab):?>
					<div class="ordered-block <?=$code?> <?=$arParams['REVIEWS_VIEW']?>">
						<?if($arParams['REVIEWS_VIEW'] == 'EXTENDED'):?>
							<div class="reviews-title__wrapper">

								<div class="ordered-block__title option-font-bold font_lg">
									<?=$arParams["TAB_REVIEW_NAME"];?>
									<span class="element-count-wrapper">
										<span class="element-count muted font_xs rounded3" style="display: none;">
										</span>
									</span>
								</div>

								<div class="right_reviews_info">
									<div class="rating-wrapper" style="display: none;">
										<div class="votes_block nstar with-text">
											<div class="ratings">
												<div class="inner_rating">
													<?for($i=1;$i<=5;$i++):?>
														<div class="item-rating"><?=CMax::showIconSvg("star", SITE_TEMPLATE_PATH."/images/svg/catalog/star_small.svg");?></div>
													<?endfor;?>
												</div>
											</div>
										</div>
										<div class="rating-value">
											<span class="count"></span>
											<span class="maximum_value">/5</span>
										</div>
									</div>
									<div class="show-comment btn btn-xs btn-default">
										<?=GetMessage('ADD_REVIEW')?>
									</div>
								</div>

							</div>
						<?else:?>
							<div class="ordered-block__title option-font-bold font_lg">
								<?=$arParams["TAB_REVIEW_NAME"];?>
							</div>
						<?endif?>
						<div id="reviews_content" class="<?=$arParams['REVIEWS_VIEW'] == 'EXTENDED' ? '' : 'bordered rounded3'?>">
							<?if($templateData["YM_ELEMENT_ID"]):?>
								<?$APPLICATION->IncludeComponent(
									"aspro:api.yamarket.reviews_model.max",
									"main",
									Array(
										"YANDEX_MODEL_ID" => $templateData["YM_ELEMENT_ID"]
									)
								);?>
							<?elseif(IsModuleInstalled("forum") && $arParams['REVIEWS_VIEW'] == 'STANDART'):?>
								<?Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("area");?>
									<?$APPLICATION->IncludeComponent(
										"bitrix:forum.topic.reviews",
										"main",
										Array(
											"CACHE_TYPE" => $arParams["CACHE_TYPE"],
											"CACHE_TIME" => $arParams["CACHE_TIME"],
											"MESSAGES_PER_PAGE" => $arParams["MESSAGES_PER_PAGE"],
											"USE_CAPTCHA" => $arParams["USE_CAPTCHA"],
											"FORUM_ID" => $arParams["FORUM_ID"],
											"ELEMENT_ID" => $arResult["ID"],
											"IBLOCK_ID" => $arParams["IBLOCK_ID"],
											"AJAX_POST" => $arParams["REVIEW_AJAX_POST"],
											"SHOW_RATING" => "N",
											"SHOW_MINIMIZED" => "Y",
											"SECTION_REVIEW" => "Y",
											"POST_FIRST_MESSAGE" => "Y",
											"MINIMIZED_MINIMIZE_TEXT" => GetMessage("HIDE_FORM"),
											"MINIMIZED_EXPAND_TEXT" => GetMessage("ADD_REVIEW"),
											"SHOW_AVATAR" => "N",
											"SHOW_LINK_TO_FORUM" => "N",
											"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
										),	false
									);?>
								<?Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("area", "");?>
							<?elseif(IsModuleInstalled("blog") && $arParams['REVIEWS_VIEW'] == 'EXTENDED' && ($arParams['USE_REVIEW'] == 'Y' || $arParams["DETAIL_USE_COMMENTS"] == 'Y') ):?>
								<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/rating_likes.js"); ?>
								<?Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("area");?>
								<?ob_start()?>
									<?$APPLICATION->IncludeComponent(
										"bitrix:catalog.comments",
										"catalog",
										array(
											'CACHE_TYPE' => $arParams['CACHE_TYPE'],
											'CACHE_TIME' => $arParams['CACHE_TIME'],
											'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
											"COMMENTS_COUNT" => (isset($arParams["MESSAGES_PER_PAGE"]) ? $arParams["MESSAGES_PER_PAGE"] : $arParams['COMMENTS_COUNT']),
											"ELEMENT_CODE" => "",
											"ELEMENT_ID" => $arResult["ID"],
											"IBLOCK_ID" => $arParams["IBLOCK_ID"],
											"IBLOCK_TYPE" => "aspro_max_catalog",
											"SHOW_DEACTIVATED" => "N",
											"TEMPLATE_THEME" => "blue",
											"URL_TO_COMMENT" => "",
											"AJAX_POST" => "Y",
											"WIDTH" => "",
											"COMPONENT_TEMPLATE" => "catalog",
											"BLOG_USE" => 'Y',
											"PATH_TO_SMILE" => '/bitrix/images/blog/smile/',
											"EMAIL_NOTIFY" => $arParams["DETAIL_BLOG_EMAIL_NOTIFY"],
											"SHOW_SPAM" => "Y",
											"SHOW_RATING" => "Y",
											"RATING_TYPE" => "like_graphic_catalog_reviews",
											'SORT_PROP' => $_COOKIE['REVIEW_SORT_PROP'] ? $_COOKIE['REVIEW_SORT_PROP'] : 'UF_ASPRO_COM_RATING',
											'SORT_ORDER' => $_COOKIE['REVIEW_SORT_ORDER'] ? $_COOKIE['REVIEW_SORT_ORDER'] : 'SORT_DESC',
											"BLOG_URL" => $arParams["BLOG_URL"],
										),
										false, array("HIDE_ICONS" => "Y")
									);?>
									<?=\Aspro\Functions\CAsproMax::showComments()?>
									<?$html=ob_get_clean();?>
									<?if($html && strpos($html, 'error') === false):?>
										<div class="ordered-block comments-block">
											<?=$html;?>
										</div>
										<div class="line-after"></div>
									<?endif;?>

								<?Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("area", "");?>
							<?endif;?>
						</div>
					</div>
				<?//custom_tab?>
				<?elseif($code == 'custom_tabs' && $bShowCustomTab):?>
					<div class="ordered-block <?=$code?>">
						<div class="ordered-block__title option-font-bold font_lg">
							<?=$arParams["TAB_DOPS_NAME"];?>
						</div>
						<?$APPLICATION->ShowViewContent('PRODUCT_CUSTOM_TAB_INFO')?>
					</div>
				<?//gifts?>
				<?elseif($code == 'gifts'):?>
					<?$APPLICATION->ShowViewContent('PRODUCT_GIFT_INFO')?>
				<?//stores?>
				<?elseif($code == 'stores' && $bShowStoresTab):?>
					<div class="ordered-block js-store-scroll <?=$code?>">
						<div class="ordered-block__title option-font-bold font_lg">
							<?=$arParams["TAB_STOCK_NAME"];?>
						</div>
						<div class="stores_tab">
							<div class="loading_block"><div class="loading_block_content"></div></div>
						</div>
					</div>
				<?//services?>
				<?elseif($code == 'services' && $templateData['LINK_SERVICES']):?>
					<?ob_start();?>
						<?$GLOBALS['arrServicesFilter'] = array('ID' => $templateData['LINK_SERVICES']);
						$GLOBALS['arrServicesFilter']['!PROPERTY_ALLOW_BUY_VALUE'] = 'Y';
						?>
						<?$APPLICATION->IncludeComponent(
							"bitrix:news.list",
							"news-list",
							array(
								"IBLOCK_TYPE" => "aspro_max_content",
								"IBLOCK_ID" => $arParams['IBLOCK_SERVICES_ID'],
								"NEWS_COUNT" => "20",
								"SORT_BY1" => "SORT",
								"SORT_ORDER1" => "ASC",
								"SORT_BY2" => "ID",
								"SORT_ORDER2" => "DESC",
								"FILTER_NAME" => "arrServicesFilter",
								"FIELD_CODE" => array(
									0 => "NAME",
									1 => "DETAIL_PAGE_URL",
									2 => "PREVIEW_TEXT",
									3 => "PREVIEW_PICTURE",
								),
								"PROPERTY_CODE" => array(
									0 => "",
								),
								"CHECK_DATES" => "Y",
								"DETAIL_URL" => "",
								"AJAX_MODE" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "Y",
								"AJAX_OPTION_HISTORY" => "N",
								"CACHE_TYPE" => $arParams['CACHE_TYPE'],
								"CACHE_TIME" => "36000000",
								"CACHE_FILTER" => "Y",
								"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
								"CACHE_GROUPS" => "N",
								"PREVIEW_TRUNCATE_LEN" => "",
								"ACTIVE_DATE_FORMAT" => "d.m.Y",
								"SET_TITLE" => "N",
								"SET_STATUS_404" => "N",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								"ADD_SECTIONS_CHAIN" => "N",
								"PARENT_SECTION" => "",
								"PARENT_SECTION_CODE" => "",
								"INCLUDE_SUBSECTIONS" => "Y",
								"PAGER_TEMPLATE" => ".default",
								"DISPLAY_TOP_PAGER" => "N",
								"DISPLAY_BOTTOM_PAGER" => "Y",
								"PAGER_TITLE" => "",
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
								"PAGER_SHOW_ALL" => "N",
								"VIEW_TYPE" => "list",
								"IMAGE_POSITION" => "left",
								"COUNT_IN_LINE" => "3",
								"SHOW_TITLE" => "Y",
								"AJAX_OPTION_ADDITIONAL" => "",
								"BORDERED" => "Y",
								"LINKED_MODE" => "Y",
							),
							false, array("HIDE_ICONS" => "Y")
						);?>
					<?$html=ob_get_clean();?>
					<?if($html && trim($html) && strpos($html, 'error') === false):?>
						<div class="ordered-block <?=$code?>">
							<div class="ordered-block__title option-font-bold font_lg">
								<?=$arParams["BLOCK_SERVICES_NAME"];?>
							</div>
							<?=$html;?>
						</div>
					<?endif;?>
				<?//news?>
				<?elseif($code == 'news' && $templateData['LINK_NEWS']):?>
					<?ob_start();?>
						<?$GLOBALS['arrNewsFilter'] = array('ID' => $templateData['LINK_NEWS']);?>
						<?$APPLICATION->IncludeComponent(
							"bitrix:news.list",
							"news-list",
							array(
								"IBLOCK_TYPE" => "aspro_max_content",
								"IBLOCK_ID" => $arParams['IBLOCK_LINK_NEWS_ID'],
								"NEWS_COUNT" => "20",
								"SORT_BY1" => "SORT",
								"SORT_ORDER1" => "ASC",
								"SORT_BY2" => "ID",
								"SORT_ORDER2" => "DESC",
								"FILTER_NAME" => "arrNewsFilter",
								"FIELD_CODE" => array(
									0 => "NAME",
									1 => "DETAIL_PAGE_URL",
									2 => "PREVIEW_TEXT",
									3 => "PREVIEW_PICTURE",
									4 => "DATE_ACTIVE_FROM",
								),
								"PROPERTY_CODE" => array(
									0 => "PERIOD",
								),
								"CHECK_DATES" => "Y",
								"DETAIL_URL" => "",
								"AJAX_MODE" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "Y",
								"AJAX_OPTION_HISTORY" => "N",
								"CACHE_TYPE" => $arParams['CACHE_TYPE'],
								"CACHE_TIME" => "36000000",
								"CACHE_FILTER" => "Y",
								"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
								"CACHE_GROUPS" => "N",
								"PREVIEW_TRUNCATE_LEN" => "",
								"ACTIVE_DATE_FORMAT" => "d.m.Y",
								"SET_TITLE" => "N",
								"SET_STATUS_404" => "N",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								"ADD_SECTIONS_CHAIN" => "N",
								"PARENT_SECTION" => "",
								"PARENT_SECTION_CODE" => "",
								"INCLUDE_SUBSECTIONS" => "Y",
								"PAGER_TEMPLATE" => ".default",
								"DISPLAY_TOP_PAGER" => "N",
								"DISPLAY_BOTTOM_PAGER" => "Y",
								"PAGER_TITLE" => "",
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
								"PAGER_SHOW_ALL" => "N",
								"VIEW_TYPE" => "list",
								"IMAGE_POSITION" => "left",
								"COUNT_IN_LINE" => "3",
								"SHOW_TITLE" => "Y",
								"AJAX_OPTION_ADDITIONAL" => "",
								"BORDERED" => "Y",
								"LINKED_MODE" => "Y",
							),
							false, array("HIDE_ICONS" => "Y")
						);?>
					<?$html=ob_get_clean();?>
					<?if($html && trim($html) && strpos($html, 'error') === false):?>
						<div class="ordered-block <?=$code?>">
							<div class="ordered-block__title option-font-bold font_lg">
								<?=$arParams["TAB_NEWS_NAME"];?>
							</div>
							<?=$html;?>
						</div>
					<?endif;?>
				<?//blog?>
				<?elseif($code == 'blog' && $templateData['LINK_BLOG']):?>
					<?ob_start();?>
						<?$GLOBALS['arrBlogFilter'] = array('ID' => $templateData['LINK_BLOG']);?>

						<?$APPLICATION->IncludeComponent(
							"bitrix:news.list",
							"news-list",
							array(
								"IBLOCK_TYPE" => "aspro_max_content",
								"IBLOCK_ID" => $arParams['IBLOCK_LINK_BLOG_ID'],
								"NEWS_COUNT" => "20",
								"SORT_BY1" => "SORT",
								"SORT_ORDER1" => "ASC",
								"SORT_BY2" => "ID",
								"SORT_ORDER2" => "DESC",
								"FILTER_NAME" => "arrBlogFilter",
								"FIELD_CODE" => array(
									0 => "NAME",
									1 => "DETAIL_PAGE_URL",
									2 => "PREVIEW_TEXT",
									3 => "PREVIEW_PICTURE",
									4 => "DATE_ACTIVE_FROM",
								),
								"PROPERTY_CODE" => array(
									0 => "PERIOD",
								),
								"CHECK_DATES" => "Y",
								"DETAIL_URL" => "",
								"AJAX_MODE" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "Y",
								"AJAX_OPTION_HISTORY" => "N",
								"CACHE_TYPE" => $arParams['CACHE_TYPE'],
								"CACHE_TIME" => "36000000",
								"CACHE_FILTER" => "Y",
								"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
								"CACHE_GROUPS" => "N",
								"PREVIEW_TRUNCATE_LEN" => "",
								"ACTIVE_DATE_FORMAT" => "d.m.Y",
								"SET_TITLE" => "N",
								"SET_STATUS_404" => "N",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								"ADD_SECTIONS_CHAIN" => "N",
								"PARENT_SECTION" => "",
								"PARENT_SECTION_CODE" => "",
								"INCLUDE_SUBSECTIONS" => "Y",
								"PAGER_TEMPLATE" => ".default",
								"DISPLAY_TOP_PAGER" => "N",
								"DISPLAY_BOTTOM_PAGER" => "Y",
								"PAGER_TITLE" => "",
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
								"PAGER_SHOW_ALL" => "N",
								"VIEW_TYPE" => "list",
								"IMAGE_POSITION" => "left",
								"COUNT_IN_LINE" => "3",
								"SHOW_TITLE" => "Y",
								"AJAX_OPTION_ADDITIONAL" => "",
								"BORDERED" => "Y",
								"LINKED_MODE" => "Y",
							),
							false, array("HIDE_ICONS" => "Y")
						);?>
					<?$html=ob_get_clean();?>
					<?if($html && trim($html) && strpos($html, 'error') === false):?>
						<div class="ordered-block <?=$code?>">
							<div class="ordered-block__title option-font-bold font_lg">
								<?=$arParams["TAB_BLOG_NAME"];?>
							</div>
							<?=$html;?>
						</div>
					<?endif;?>
				<?//staff?>
				<?elseif($code == 'staff' && $templateData['LINK_STAFF']):?>
					<?ob_start();?>
						<?$GLOBALS['arrStaffFilter'] = array('ID' => $templateData['LINK_STAFF']);?>
						<?$APPLICATION->IncludeComponent(
							"bitrix:news.list",
							$arParams["STAFF_VIEW_TYPE"],
							array(
								"IBLOCK_TYPE" => "aspro_max_content",
								"IBLOCK_ID" => $arParams['IBLOCK_LINK_STAFF_ID'],
								"NEWS_COUNT" => "20",
								"SORT_BY1" => "SORT",
								"SORT_ORDER1" => "ASC",
								"SORT_BY2" => "ID",
								"SORT_ORDER2" => "DESC",
								"FILTER_NAME" => "arrStaffFilter",
								"FIELD_CODE" => array(
									0 => "NAME",
									1 => "DETAIL_PAGE_URL",
									2 => "PREVIEW_TEXT",
									3 => "PREVIEW_PICTURE",
								),
								"PROPERTY_CODE" => array(
								    0 => "POST",
								    1 => "PHONE",
								    2 => "EMAIL",
								    3 => "SEND_MESSAGE_BUTTON",
								),
								"CHECK_DATES" => "Y",
								"DETAIL_URL" => "",
								"AJAX_MODE" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "Y",
								"AJAX_OPTION_HISTORY" => "N",
								"CACHE_TYPE" => $arParams['CACHE_TYPE'],
								"CACHE_TIME" => "36000000",
								"CACHE_FILTER" => "Y",
								"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
								"CACHE_GROUPS" => "N",
								"PREVIEW_TRUNCATE_LEN" => "",
								"ACTIVE_DATE_FORMAT" => "d.m.Y",
								"SET_TITLE" => "N",
								"SET_STATUS_404" => "N",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								"ADD_SECTIONS_CHAIN" => "N",
								"PARENT_SECTION" => "",
								"PARENT_SECTION_CODE" => "",
								"INCLUDE_SUBSECTIONS" => "Y",
								"PAGER_TEMPLATE" => ".default",
								"DISPLAY_TOP_PAGER" => "N",
								"DISPLAY_BOTTOM_PAGER" => "Y",
								"PAGER_TITLE" => "",
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
								"PAGER_SHOW_ALL" => "N",
								"VIEW_TYPE" => "list",
								"IMAGE_POSITION" => "left",
								"COUNT_IN_LINE" => "3",
								"SHOW_TITLE" => "Y",
								"AJAX_OPTION_ADDITIONAL" => "",
								"BORDERED" => "Y",
								"LINKED_MODE" => "Y",
							),
							false, array("HIDE_ICONS" => "Y")
						);?>
					<?$html=ob_get_clean();?>
					<?if($html && trim($html) && strpos($html, 'error') === false):?>
						<div class="ordered-block <?=$code?>">
							<div class="ordered-block__title option-font-bold font_lg">
								<?=$arParams["TAB_STAFF_NAME"];?>
							</div>
							<?=$html;?>
						</div>
					<?endif;?>
				<?//vacancy?>
				<?elseif($code == 'vacancy' && $templateData['LINK_VACANCY']):?>
					<?ob_start();?>
						<?$GLOBALS['arrVacancyFilter'] = array('ID' => $templateData['LINK_VACANCY']);?>
						<?$APPLICATION->IncludeComponent(
							"bitrix:news.list",
							"vacancy",
							array(
								"IBLOCK_TYPE" => "aspro_max_content",
								"IBLOCK_ID" => $arParams['IBLOCK_LINK_VACANCY_ID'],
								"NEWS_COUNT" => "20",
								"SORT_BY1" => "SORT",
								"SORT_ORDER1" => "ASC",
								"SORT_BY2" => "ID",
								"SORT_ORDER2" => "DESC",
								"FILTER_NAME" => "arrVacancyFilter",
								"FIELD_CODE" => array(
									0 => "NAME",
									1 => "DETAIL_PAGE_URL",
									2 => "PREVIEW_TEXT",
									3 => "PREVIEW_PICTURE",
								),
								"PROPERTY_CODE" => array(
									0 => "PAY",
									1 => "CITY",
									2 => "WORK_TYPE",
									3 => "QUALITY",
								),
								"CHECK_DATES" => "Y",
								"DETAIL_URL" => "",
								"AJAX_MODE" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "Y",
								"AJAX_OPTION_HISTORY" => "N",
								"CACHE_TYPE" => $arParams['CACHE_TYPE'],
								"CACHE_TIME" => "36000000",
								"CACHE_FILTER" => "Y",
								"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
								"CACHE_GROUPS" => "N",
								"PREVIEW_TRUNCATE_LEN" => "",
								"ACTIVE_DATE_FORMAT" => "d.m.Y",
								"SET_TITLE" => "N",
								"SET_STATUS_404" => "N",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								"ADD_SECTIONS_CHAIN" => "N",
								"PARENT_SECTION" => "",
								"PARENT_SECTION_CODE" => "",
								"INCLUDE_SUBSECTIONS" => "Y",
								"PAGER_TEMPLATE" => ".default",
								"DISPLAY_TOP_PAGER" => "N",
								"DISPLAY_BOTTOM_PAGER" => "Y",
								"PAGER_TITLE" => "",
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
								"PAGER_SHOW_ALL" => "N",
								"VIEW_TYPE" => "list",
								"IMAGE_POSITION" => "left",
								"COUNT_IN_LINE" => "3",
								"SHOW_TITLE" => "Y",
								"AJAX_OPTION_ADDITIONAL" => "",
								"BORDERED" => "Y",
								"LINKED_MODE" => "Y",
							),
							false, array("HIDE_ICONS" => "Y")
						);?>
					<?$html=ob_get_clean();?>
					<?if($html && trim($html) && strpos($html, 'error') === false):?>
						<div class="ordered-block <?=$code?>">
							<div class="ordered-block__title option-font-bold font_lg">
								<?=$arParams["TAB_VACANCY_NAME"];?>
							</div>
							<?=$html;?>
						</div>
					<?endif;?>
				<?//new complect?>
				<?elseif($code == 'modules'):?>
					<?include 'epilog_blocks/'.$code.'.php';?>
				<?//goods?>
				<?elseif($code == 'goods'):?>
					<?if($arParams['DETAIL_LINKED_GOODS_TABS'] != 'N'):?>
						<?//tabs mode?>
						<div class="ordered-block <?=$code?>">
							<?$bNavTabs = false;?>
<?//выводим все книги серии по уровням?>
<?
//ИД серии текущего товара
$seria = array();
$db_props = CIBlockElement::GetProperty($arParams['IBLOCK_ID'], $arParams['ELEMENT_ID'], array("sort" => "asc"), Array("CODE"=>"SERIYA"));
while ($ob = $db_props->GetNext())
    {
        $seria[] = $ob['VALUE'];
    }



//для уровня по шкале
$rsurov1 = CIBlockElement::GetList(
   array(), 
   array(
   "IBLOCK_ID" => 36, 
   array("ID" => CIBlockElement::SubQuery("ID", array("IBLOCK_ID" => 36, "PROPERTY_SERIYA" => $seria[0]))),
   ),
   false, 
   false,
   array("PROPERTY_UROVEN_V_SERII")
);

while($arrurov2 = $rsurov1->GetNext()) {
    $arrIDurov1[] = array("ID" => $arrurov2[PROPERTY_UROVEN_V_SERII_ENUM_ID], "NAME" => $arrurov2[PROPERTY_UROVEN_V_SERII_VALUE]);
}

$arrIDurov = array(
0 => array("ID" => "", "NAME" => ""),
1 => array("ID" => "828", "NAME" => "Level Junior A"),
2 => array("ID" => "849", "NAME" => "Little Explorers A"),
3 => array("ID" => "851", "NAME" => "Young Explorers 1"),
4 => array("ID" => "862", "NAME" => "Level Intro"),
5 => array("ID" => "863", "NAME" => "Level 1"),
6 => array("ID" => "868", "NAME" => "Starter Level"),
7 => array("ID" => "871", "NAME" => "Level Hello"),
8 => array("ID" => "873", "NAME" => "Level Little"),
9 => array("ID" => "875", "NAME" => "Band 1"),
10 => array("ID" => "876", "NAME" => "Band 2"),
11 => array("ID" => "885", "NAME" => "Level A1/B1"),
12 => array("ID" => "887", "NAME" => "Level A1"),
13 => array("ID" => "888", "NAME" => "Level A"),
14 => array("ID" => "1323", "NAME" => "Level A1/B2"),
15 => array("ID" => "1324", "NAME" => "Level A1/A2"),
16 => array("ID" => "1339", "NAME" => "Level 1A"),
17 => array("ID" => "840", "NAME" => "Level A2"),
18 => array("ID" => "844", "NAME" => "Level A1+"),
19 => array("ID" => "845", "NAME" => "Level A2+"),
20 => array("ID" => "852", "NAME" => "Young Explorers 2"),
21 => array("ID" => "861", "NAME" => "Pre-Intermediate Level"),
22 => array("ID" => "864", "NAME" => "Level 2"),
23 => array("ID" => "867", "NAME" => "Elementary Level"),
24 => array("ID" => "1341", "NAME" => "Level 2A"),
25 => array("ID" => "829", "NAME" => "Level Junior B"),
26 => array("ID" => "841", "NAME" => "Level B1"),
27 => array("ID" => "850", "NAME" => "Little Explorers B"),
28 => array("ID" => "853", "NAME" => "Explorers 3"),
29 => array("ID" => "859", "NAME" => "Intermediate Level"),
30 => array("ID" => "865", "NAME" => "Level 3"),
40 => array("ID" => "869", "NAME" => "Beginner Level"),
41 => array("ID" => "872", "NAME" => "Level B"),
42 => array("ID" => "880", "NAME" => "Band 3"),
43 => array("ID" => "884", "NAME" => "Level B1/B2"),
44 => array("ID" => "1340", "NAME" => "Level 1B"),
45 => array("ID" => "820", "NAME" => "Level B2+"),
46 => array("ID" => "842", "NAME" => "Level B1+"),
47 => array("ID" => "843", "NAME" => "Level B2"),
48 => array("ID" => "854", "NAME" => "Explorers 4"),
49 => array("ID" => "860", "NAME" => "Upper-Intermediate Level"),
50 => array("ID" => "866", "NAME" => "Level 4"),
51 => array("ID" => "870", "NAME" => "Level Essentials"),
52 => array("ID" => "881", "NAME" => "Band 4"),
53 => array("ID" => "1342", "NAME" => "Level 2B"),
54 => array("ID" => "855", "NAME" => "Explorers 5"),
55 => array("ID" => "882", "NAME" => "Band 5"),
56 => array("ID" => "889", "NAME" => "Level 5"),
57 => array("ID" => "1338", "NAME" => "Level B2/C1"),
58 => array("ID" => "824", "NAME" => "Level C1/C2"),
59 => array("ID" => "856", "NAME" => "Explorers 6"),
60 => array("ID" => "858", "NAME" => "Advanced Level"),
61 => array("ID" => "886", "NAME" => "Level C1"),
62 => array("ID" => "890", "NAME" => "Level 6"),
63 => array("ID" => "1320", "NAME" => "Level C2"),
64 => array("ID" => "891", "NAME" => "Level 7"),
65 => array("ID" => "892", "NAME" => "Level 8"),
66 => array("ID" => "893", "NAME" => "Level 9"),
67 => array("ID" => "894", "NAME" => "Level 10"),
68 => array("ID" => "821", "NAME" => "Pre-FCE Level"),
69 => array("ID" => "822", "NAME" => "FCE Level"),
70 => array("ID" => "823", "NAME" => "Plus Level"),
71 => array("ID" => "825", "NAME" => "Essential Level"),
72 => array("ID" => "826", "NAME" => "IELTS"),
73 => array("ID" => "827", "NAME" => "Level Pre-Junior"),
74 => array("ID" => "830", "NAME" => "2 класс"),
75=> array("ID" => "831", "NAME" => "3 класс"),
76=> array("ID" => "832", "NAME" => "4 класс"),
77=> array("ID" => "833", "NAME" => "5 класс"),
78=> array("ID" => "834", "NAME" => "6 класс"),
79=> array("ID" => "835", "NAME" => "7 класс"),
80=> array("ID" => "836", "NAME" => "8 класс"),
81=> array("ID" => "837", "NAME" => "9 класс"),
82=> array("ID" => "838", "NAME" => "10 класс"),
83=> array("ID" => "839", "NAME" => "11 класс"),
84=> array("ID" => "846", "NAME" => "Real Listening and Speaking"),
85=> array("ID" => "847", "NAME" => "Real Reading"),
86=> array("ID" => "848", "NAME" => "Real Writing"),
87=> array("ID" => "857", "NAME" => "Easystarts Level"),
88=> array("ID" => "874", "NAME" => "KET"),
89=> array("ID" => "877", "NAME" => "Niveau débutant"),
90=> array("ID" => "878", "NAME" => "Niveau Intermédiaire"),
91=> array("ID" => "879", "NAME" => "Nuveau Avance"),
92=> array("ID" => "1321", "NAME" => "PET"),
93=> array("ID" => "1322", "NAME" => "Level Foundation"),
94=> array("ID" => "1334", "NAME" => "Band 6"),
95=> array("ID" => "1336", "NAME" => "Band 8"),
96=> array("ID" => "1337", "NAME" => "Band 9"),
97=> array("ID" => "1357", "NAME" => "CAE"),
98=> array("ID" => "1359", "NAME" => "First"),
99=> array("ID" => "1377", "NAME" => "Part 1"),
100=> array("ID" => "1378", "NAME" => "Part 2"),
101=> array("ID" => "1379", "NAME" => "Part 3"),
102=> array("ID" => "1380", "NAME" => "Movers"),
103=> array("ID" => "1381", "NAME" => "Movers Skills"),
104=> array("ID" => "1382", "NAME" => "Starters"),
105=> array("ID" => "1383", "NAME" => "Starters Skills"),
106=> array("ID" => "1384", "NAME" => "Flyers"),
107=> array("ID" => "1385", "NAME" => "Flyers Skills"),
108=> array("ID" => "1389", "NAME" => "Part 5"),
109=> array("ID" => "1386", "NAME" => "Part 6"),
110=> array("ID" => "1390", "NAME" => "Part 7"),
111=> array("ID" => "1387", "NAME" => "Part 8"),
112=> array("ID" => "1388", "NAME" => "Part 9"),
113=> array("ID" => "1391", "NAME" => "KET for Schools"),
114=> array("ID" => "1393", "NAME" => "IELTS Grammar for Bands 6.5 and above"),
115=> array("ID" => "1394", "NAME" => "IELTS Vocabulary for Bands 6.5 and above"),
116=> array("ID" => "1396", "NAME" => "BEC, BULATS Pre-int/Interm Level"),
117=> array("ID" => "1397", "NAME" => "Pre-Intermediate/Intermediate Level"),
118=> array("ID" => "1398", "NAME" => "BEC, BULATS Advanced Level"),
119=> array("ID" => "1399", "NAME" => "BEC Pre-int/Interm Level"),
120=> array("ID" => "1400", "NAME" => "BEC Advanced Level"),
121=> array("ID" => "1401", "NAME" => "BULATS Pre-int/Interm Level"),
122=> array("ID" => "1402", "NAME" => "BULATS Upper-Intermediate Level"),
123=> array("ID" => "1403", "NAME" => "BULATS Pre-Intermediate Level"),
124=> array("ID" => "1404", "NAME" => "Essential BULATS"),
125=> array("ID" => "1413", "NAME" => "CAE and Proficiency"),
126=> array("ID" => "1414", "NAME" => "Abschlusskurs"),
127=> array("ID" => "1415", "NAME" => "Hauptkurs"),
128=> array("ID" => "1416", "NAME" => "Bruckenkurs"),
129=> array("ID" => "1417", "NAME" => "CPE"),
130=> array("ID" => "1418", "NAME" => "CLIL Module"),
131=> array("ID" => "1419", "NAME" => "KAL Module"),
132=> array("ID" => "1420", "NAME" => "Training Activities"),
133=> array("ID" => "1421", "NAME" => "TOEFL"),
134=> array("ID" => "1422", "NAME" => "Academic English"),
135=> array("ID" => "1423", "NAME" => "BEC Higher"),
136=> array("ID" => "1424", "NAME" => "BEC Preliminary"),
137=> array("ID" => "1425", "NAME" => "BEC Vantage"),
138=> array("ID" => "1426", "NAME" => "Advanced Level Listening & Speaking"),
139=> array("ID" => "1427", "NAME" => "Advanced Level Reading"),
140=> array("ID" => "1428", "NAME" => "Advanced Level Use of English"),
141=> array("ID" => "1429", "NAME" => "Advanced Level Writing"),
142=> array("ID" => "1430", "NAME" => "FCE Level Listening&Speaking"),
143=> array("ID" => "1431", "NAME" => "FCE Level Reading"),
144=> array("ID" => "1432", "NAME" => "FCE Level Use of English"),
145=> array("ID" => "1433", "NAME" => "FCE Level Writing"),
146=> array("ID" => "1435", "NAME" => "IELTS Academic"),
147=> array("ID" => "1436", "NAME" => "IELTS General Training"),
148=> array("ID" => "1437", "NAME" => "IELTS Listening & Speaking Skills"),
149=> array("ID" => "1438", "NAME" => "IELTS Reading and Writing skills"),
150=> array("ID" => "1439", "NAME" => "IELTS Reading Skills"),
151=> array("ID" => "1440", "NAME" => "IELTS Writing skills"),
152=> array("ID" => "1441", "NAME" => "PET for schools"),
153=> array("ID" => "1442", "NAME" => "PTE Academic"),
154=> array("ID" => "1443", "NAME" => "TOEIC"),
155=> array("ID" => "1444", "NAME" => "Grammar and Vocabulary 1st Edition"),
156=> array("ID" => "1445", "NAME" => "Grammar and Vocabulary 2nd Edition"),
157=> array("ID" => "1446", "NAME" => "Grammar and Vocabulary 3rd Edition"),
158=> array("ID" => "1447", "NAME" => "Grammar and Vocabulary for ГИА A1+"),
159=> array("ID" => "1448", "NAME" => "Grammar and Vocabulary for ГИА A2"),
160=> array("ID" => "1449", "NAME" => "Grammar and Vocabulary for ГИА A2 2020"),
161=> array("ID" => "1450", "NAME" => "Grammar and Vocabulary for ГИА B1 2020"),
162=> array("ID" => "1451", "NAME" => "Grammar and Vocabulary 1st Edition  B1"),
163=> array("ID" => "1452", "NAME" => "Grammar and Vocabulary for ГИА B1"),
164=> array("ID" => "1453", "NAME" => "Practice Tests for YEGE 2nd Edition"),
165=> array("ID" => "1454", "NAME" => "Practice Tests for YEGE 1st Edition"),
166=> array("ID" => "1455", "NAME" => "Practice Tests for YEGE 3rd Edition"),
167=> array("ID" => "1456", "NAME" => "Practice Tests for ГИА"),
168=> array("ID" => "1457", "NAME" => "Practice Tests for ОГЭ"),
169=> array("ID" => "1458", "NAME" => "Reading and Writing 1st Edition"),
170=> array("ID" => "1459", "NAME" => "Reading and Writing 2nd Edition"),
171=> array("ID" => "1460", "NAME" => "Speaking and Listening 1st Edition"),
172=> array("ID" => "1461", "NAME" => "Speaking and Listening 2nd Edition"),
173=> array("ID" => "1462", "NAME" => "Speaking ОГЭ"),
174=> array("ID" => "1463", "NAME" => "IELTS Foundation"),
175=> array("ID" => "1464", "NAME" => "Part 2 General"),
176=> array("ID" => "1465", "NAME" => "Part 3 General"),
177=> array("ID" => "1466", "NAME" => "PTE"),
178=> array("ID" => "1467", "NAME" => "Fantastic Flyers"),
179=> array("ID" => "1468", "NAME" => "Mighty Movers"),
180=> array("ID" => "1469", "NAME" => "Super Starters"),
181=> array("ID" => "1470", "NAME" => "ЕГЭ"),
182=> array("ID" => "1471", "NAME" => "ГИА"),
183=> array("ID" => "1472", "NAME" => "Level A2/B1"),
184=> array("ID" => "1473", "NAME" => "TestDaF"),
185=> array("ID" => "1474", "NAME" => "Part 15"),
186=> array("ID" => "1475", "NAME" => "Avanzado"),
187=> array("ID" => "1476", "NAME" => "Elemental"),
188=> array("ID" => "1477", "NAME" => "Intermedio"),
189=> array("ID" => "1478", "NAME" => "Medio"),
190=> array("ID" => "1479", "NAME" => "Basi"),
191=> array("ID" => "1480", "NAME" => "Intermedio-Avanzato"),
192=> array("ID" => "1481", "NAME" => "Band 3/4"),
193=> array("ID" => "2264", "NAME" => "High-Elementary Level"),
194=> array("ID" => "2265", "NAME" => "Level 3A"),
195=> array("ID" => "2266", "NAME" => "Level 3B"),
196=> array("ID" => "2351", "NAME" => "Advanced 2020"),
197=> array("ID" => "2352", "NAME" => "Advanced Level 2nd Edition"),
198=> array("ID" => "2353", "NAME" => "Advanced Level 3rd Edition"),
199=> array("ID" => "2354", "NAME" => "Advanced Level 4rd Edition"),
200=> array("ID" => "2355", "NAME" => "Proficiency Level"),
201=> array("ID" => "2357", "NAME" => "Proficiency Level 2nd Edition"),
202=> array("ID" => "2358", "NAME" => "Proficiency Level 3rd Edition"),
203=> array("ID" => "2356", "NAME" => "Proficiency Level 4th Edition"),
204=> array("ID" => "2359", "NAME" => "First 2020"),
205=> array("ID" => "2360", "NAME" => "First for Schools"),
206=> array("ID" => "2361", "NAME" => "First for Schools 2020"),
207=> array("ID" => "2362", "NAME" => "First and First for Schools"),
208=> array("ID" => "2363", "NAME" => "First 2nd Edition"),
209=> array("ID" => "2364", "NAME" => "First for Schools 2nd Edition"),
210=> array("ID" => "2365", "NAME" => "First 3d Edition"),
211=> array("ID" => "2366", "NAME" => "First for Schools 3d Edition"),
212=> array("ID" => "2367", "NAME" => "First 4th Edition"),
213=> array("ID" => "2368", "NAME" => "IELTS Academic 2020"),
214=> array("ID" => "2369", "NAME" => "IELTS General Training 2020"),
215=> array("ID" => "2370", "NAME" => "IELTS Academic 2nd edition"),
216=> array("ID" => "2371", "NAME" => "IELTS 2nd Edition"),
217=> array("ID" => "2372", "NAME" => "IELTS Advanced"),
218=> array("ID" => "2373", "NAME" => "IELTS Intermediate"),
219=> array("ID" => "2374", "NAME" => "KEY and KEY  for Schools"),
220=> array("ID" => "2375", "NAME" => "KEY 2020"),
221=> array("ID" => "2376", "NAME" => "KEY for Schools 2020"),
222=> array("ID" => "2377", "NAME" => "KEY for Schools  2nd Edition"),
223=> array("ID" => "2378", "NAME" => "KEY 2nd Edition"),
224=> array("ID" => "2379", "NAME" => "KEY and KEY  for Schools 2nd edition"),
225=> array("ID" => "2380", "NAME" => "LCCI"),
226=> array("ID" => "2381", "NAME" => "PET for schools 2020"),
227=> array("ID" => "2382", "NAME" => "PET and PET for schools"),
228=> array("ID" => "2383", "NAME" => "PET 2020"),
229=> array("ID" => "2384", "NAME" => "PET 2nd edition"),
230=> array("ID" => "2385", "NAME" => "PET for schools 2nd Edition"),
231=> array("ID" => "2386", "NAME" => "PET 3rd Edition"),
232=> array("ID" => "2387", "NAME" => "PET and PET for schools 2nd edition"),
233=> array("ID" => "2388", "NAME" => "PTE GENERAL"),
234=> array("ID" => "2389", "NAME" => "Modules 1, 2 and 3"),
235=> array("ID" => "2390", "NAME" => "Prim A1"),
236=> array("ID" => "2391", "NAME" => "Scolaire et Junior A1"),
237=> array("ID" => "2392", "NAME" => "Scolaire et Junior A1 NEW"),
238=> array("ID" => "2393", "NAME" => "Scolaire et Junior A2"),
239=> array("ID" => "2394", "NAME" => "Scolaire et Junior A2 NEW"),
240=> array("ID" => "2395", "NAME" => "Scolaire et Junior B1"),
241=> array("ID" => "2396", "NAME" => "Scolaire et Junior B1 NEW"),
242=> array("ID" => "2397", "NAME" => "Scolaire et Junior B2"),
243=> array("ID" => "2398", "NAME" => "1 сертификационный уровень"),
244=> array("ID" => "2399", "NAME" => "2 сертификационный уровень"),
245=> array("ID" => "2400", "NAME" => "3 сертификационный уровень"),
246=> array("ID" => "2401", "NAME" => "Базовый уровень"),
247=> array("ID" => "2402", "NAME" => "элементарныйуровень"),
248=> array("ID" => "2411", "NAME" => "Starters 2nd Edition"),
249=> array("ID" => "2412", "NAME" => "Starters 4th Edition"),
250=> array("ID" => "2407", "NAME" => "Movers 1st Edition"),
251=> array("ID" => "2408", "NAME" => "Movers 2nd Edition"),
252=> array("ID" => "2409", "NAME" => "Movers 3d Edition"),
253=> array("ID" => "2410", "NAME" => "Movers 4th Edition"),
254=> array("ID" => "2403", "NAME" => "Flyers 1st Edition"),
255=> array("ID" => "2404", "NAME" => "Flyers 2nd Edition"),
256=> array("ID" => "2405", "NAME" => "Flyers 3d Edition"),
257=> array("ID" => "2406", "NAME" => "Flyers 4th Edition"),
258=> array("ID" => "2413", "NAME" => "Grundstufe"),
259=> array("ID" => "2414", "NAME" => "Mittelstufe"),
260=> array("ID" => "2442", "NAME" => "Foundation")
);

//функция для сортировки массива
function unique_multidim_array($array, $key) {
    $temp_array = array();
    $i = 0;
    $key_array = array();
   
    foreach($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
        }
        $i++;
    }
    return $temp_array;
}


$arrIDurov1 = array_values(unique_multidim_array($arrIDurov1, "ID"));

foreach ($arrIDurov1 as $key => $row) {
    $volume[$key]  = $row['ID'];
    $edition[$key] = $row['NAME'];
}

$sortID = array_column($arrIDurov1, 'ID');
$sortNAME = array_column($arrIDurov1, 'NAME');

array_multisort($sortNAME, SORT_ASC, $arrIDurov1);


$n = 0;
while($arrIDurov[$n]) {
    $arr1IDurov[] = $arrIDurov[$n][ID];
	$arr2IDurov[] = $arrIDurov[$n][NAME];
	$n++;
}

$n1 = 0;
while($arrIDurov1[$n1]) {
    $arr1IDurov1[] = $arrIDurov1[$n1][ID];
	$arr2IDurov1[] = $arrIDurov1[$n1][NAME];
	$n1++;
}


$diff = array_intersect($arr1IDurov, $arr1IDurov1);
$diff = array_values($diff);

$diff1 = array_intersect($arr2IDurov, $arr2IDurov1); 
$diff1 = array_values($diff1);


$i = 0;
?>
<?if($seria[0]):?>
<div class="row">
<div class="col-md-12">
	<h2>Все книги серии:</h2>
		<div class="toogle">
			<?while ($diff1[$i]):?>
			<section class="toggle">
				<label><?echo $diff1[$i];?></label>
				<div class="toggle-content">
					<p><?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"catalog_block",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CONVERT_CURRENCY" => "N",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[{\"CLASS_ID\":\"CondIBProp:36:699\",\"DATA\":{\"logic\":\"Equal\",\"value\":$seria[0]}},{\"CLASS_ID\":\"CondIBProp:36:691\",\"DATA\":{\"logic\":\"Equal\",\"value\":$diff[$i]}}]}",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"ENLARGE_PRODUCT" => "STRICT",
		"FILTER_NAME" => "ar",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => "36",
		"IBLOCK_TYPE" => "aspro_max_catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_LAZY_LOAD" => "Показать ещё",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_FIELD_CODE" => array("", ""),
		"OFFERS_LIMIT" => "5",
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_ORDER2" => "desc",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "18",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array("Розничные"),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => "",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("", ""),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "Y",
		"TEMPLATE_THEME" => "blue",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N"
	)
);?></p>
				</div>
			</section>
<?$i++;?>
<?endwhile;?>
		</div>
	</div>
</div>
<?endif?>

							<?//закончили выводить книги серии по уровням?>
							<?if($templateData['ASSOCIATED'] && $templateData['EXPANDABLES']):?>
								<?
								$bShowAssociatedTab = \Aspro\Functions\CAsproMax::checkAvailable($templateData['ASSOCIATED'], array('REGION'), $arParams);
								$bShowExpandablesTab = \Aspro\Functions\CAsproMax::checkAvailable($templateData['EXPANDABLES'], array('REGION'), $arParams);
								?>
								<?if($bShowAssociatedTab || $bShowExpandablesTab):?>
									<div class="tabs arrow_scroll bottom-line" data-plugin-options='{"axis": "x", "scrollInertia": 200, "snapAmount": 70, "scrollButtons": {"enable": true}}'>
										<ul class="nav nav-tabs">
											<?if($bShowAssociatedTab):?>
												<li class="active"><a href="#assoc" data-toggle="tab" class="linked"><?=$arParams["DETAIL_ASSOCIATED_TITLE"];?></a></li>
											<?endif;?>
											<?if($bShowExpandablesTab):?>
												<li class="<?=$bShowAssociatedTab ? '' : 'active'?>"><a href="#expandables" data-toggle="tab" class="linked"><?=$arParams["DETAIL_EXPANDABLES_TITLE"];?></a></li>
											<?endif;?>
										</ul>
									</div>
								<div class="tab-content">
								<?$bNavTabs = true;?>
								<?endif;?>
							<?endif;?>
							<?if($templateData['ASSOCIATED']):?>
								<?
								$bShowAssociatedTab = \Aspro\Functions\CAsproMax::checkAvailable($templateData['ASSOCIATED'], array('REGION'), $arParams);
								?>
								<?if($bShowAssociatedTab):?>
									<?if($bNavTabs):?>
										<div class="tab-pane active cur" id="assoc">
									<?else:?>
										<div class="ordered-block__title option-font-bold font_lg">
											<?=$arParams["DETAIL_ASSOCIATED_TITLE"];?>
										</div>
										<div class="cur">
									<?endif;?>

										<div class="assoc-block js-load-block loader_circle" data-block="assoc" data-file="<?=$APPLICATION->GetCurURI()?>">
											<div class="stub"></div>
											<?CMax::checkRestartBuffer(true, 'assoc');?>
												<?if(CMax::checkAjaxRequest()):?>
													<?$APPLICATION->ShowAjaxHead();?>
													<?
													$GLOBALS['arrProductsFilter'] = [];
													$GLOBALS['arrProductsFilter'] = $templateData['ASSOCIATED'];
													?>
													<?include($_SERVER['DOCUMENT_ROOT'].SITE_DIR.'/include/detail.linked_products_block.php');?>
												<?endif;?>
											<?CMax::checkRestartBuffer(true, 'assoc');?>
										</div>

									</div>
								<?endif;?>
							<?endif;?>

							<?if($templateData['EXPANDABLES']):?>
								<?
								$bShowExpandablesTab = \Aspro\Functions\CAsproMax::checkAvailable($templateData['EXPANDABLES'], array('REGION'), $arParams);
								?>
								<?if($bShowExpandablesTab):?>
									<?if($bNavTabs):?>
										<div class="tab-pane <?=(!$templateData['ASSOCIATED'] ? "active cur" : "");?>" id="expandables">
									<?else:?>
										<div class="ordered-block__title option-font-bold font_lg">
											<?=$arParams["DETAIL_EXPANDABLES_TITLE"];?>
										</div>
										<div class="cur">
									<?endif;?>

										<div class="expandables-block js-load-block loader_circle" data-block="expandables" data-file="<?=$APPLICATION->GetCurURI()?>">
											<div class="stub"></div>
											<?CMax::checkRestartBuffer(true, 'expandables');?>
												<?if(CMax::checkAjaxRequest()):?>
													<?if(!$templateData['ASSOCIATED'])
														$APPLICATION->ShowAjaxHead();?>
													<?$GLOBALS['arrProductsFilter'] = [];?>
													<?$GLOBALS['arrProductsFilter'] = $templateData['EXPANDABLES'];?>
													<?include($_SERVER['DOCUMENT_ROOT'].SITE_DIR.'/include/detail.linked_products_block.php');?>
												<?endif;?>
											<?CMax::checkRestartBuffer(true, 'expandables');?>
										</div>

									</div>
								<?endif;?>
							<?endif;?>

							<?if($templateData['ASSOCIATED'] && $templateData['EXPANDABLES']):?>
								<?if($bShowAssociatedTab || $bShowExpandablesTab):?>
									</div>
								<?endif;?>
							<?endif;?>
						</div>
					<?else:?>
						<?if($templateData['ASSOCIATED']):?>
							<?
							$bShowAssociatedTab = \Aspro\Functions\CAsproMax::checkAvailable($templateData['ASSOCIATED'], array('REGION'), $arParams);
							?>
							<?if($bShowAssociatedTab):?>
								<div class="ordered-block <?=$code?> cur">
									<div class="ordered-block__title option-font-bold font_lg">
										<?=$arParams["DETAIL_ASSOCIATED_TITLE"];?>
									</div>
									<div class="assoc-block js-load-block loader_circle" data-block="assoc" data-file="<?=$APPLICATION->GetCurURI()?>">
										<div class="stub"></div>
										<?CMax::checkRestartBuffer(true, 'assoc');?>
											<?if(CMax::checkAjaxRequest()):?>
												<?$APPLICATION->ShowAjaxHead();?>
												<?$GLOBALS['arrProductsFilter'] = [];?>
												<?$GLOBALS['arrProductsFilter'] = $templateData['ASSOCIATED'];?>
												<?include($_SERVER['DOCUMENT_ROOT'].SITE_DIR.'/include/detail.linked_products_block.php');?>
											<?endif;?>
										<?CMax::checkRestartBuffer(true, 'assoc');?>
									</div>
								</div>
							<?endif;?>
						<?endif;?>
						<?if($templateData['EXPANDABLES']):?>
							<?
							$bShowExpandablesTab = \Aspro\Functions\CAsproMax::checkAvailable($templateData['EXPANDABLES'], array('REGION'), $arParams);
							?>
							<?if($bShowExpandablesTab):?>
								<div class="ordered-block <?=$code?> cur">
									<div class="ordered-block__title option-font-bold font_lg">
										<?=$arParams["DETAIL_EXPANDABLES_TITLE"];?>
									</div>
									<div class="expandables-block js-load-block loader_circle" data-block="expandables" data-file="<?=$APPLICATION->GetCurURI()?>">
										<div class="stub"></div>
										<?CMax::checkRestartBuffer(true, 'expandables');?>
											<?if(CMax::checkAjaxRequest()):?>
												<?$APPLICATION->ShowAjaxHead();?>
												<?$GLOBALS['arrProductsFilter'] = [];?>
												<?$GLOBALS['arrProductsFilter'] = $templateData['EXPANDABLES'];?>
												<?include($_SERVER['DOCUMENT_ROOT'].SITE_DIR.'include/detail.linked_products_block.php');?>
											<?endif;?>
										<?CMax::checkRestartBuffer(true, 'expandables');?>
									</div>
								</div>
							<?endif;?>
						<?endif;?>
					<?endif;?>
				<?endif;?>
			<?endforeach;?>
			<?CMax::get_banners_position('CONTENT_BOTTOM');
			global $bannerContentBottom;
			$bannerContentBottom = true;
			?>
		</div>
		<div class="left_block sticky-sidebar-custom product-side">
			<?$APPLICATION->ShowViewContent('PRODUCT_SIDE_INFO')?>

			<?//bigdata?>
			<?if($arParams['USE_BIG_DATA'] == 'Y'):?>
				<?
				$GLOBALS['CATALOG_CURRENT_ELEMENT_ID'] = $arResult['ID'];

				$GLOBALS['arrFilterBigData']['IBLOCK_ID'] = $arParams['IBLOCK_ID'];
				CMax::makeElementFilterInRegion($GLOBALS['arrFilterBigData']);
				?>
				<div class="bigdata-wrapper"><?include_once($arParams['BIG_DATA_TEMPLATE']);?></div>
			<?endif;?>

			<?//feedback?>
			<?if($arParams['SHOW_ASK_BLOCK'] == 'Y'):?>
				<div class="side-block side-block--feedback rounded2 bordered box-shadow colored_theme_hover_bg-block">
					<div class="side-block__top text-center">
						<?=CMax::showIconSvg("icon colored", SITE_TEMPLATE_PATH.'/images/svg/catalog/ask_question.svg', '', '', true, false);?>
						<div class="side-block__text side-block__text--small">
							<?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "page",
									"AREA_FILE_SUFFIX" => "feedback",
									"EDIT_TEMPLATE" => ""
								)
							);?>
						</div>
					</div>
					<div class="side-block__bottom side-block__bottom--last">
						<span class="btn btn-lg btn-transparent round-ignore btn-wide font_upper animate-load colored_theme_hover_bg-el has-ripple" data-event="jqm" data-param-form_id="ASK" data-name="ask"><?=($arParams["ASK_TAB"] ? $arParams["ASK_TAB"] : GetMessage("ASK_TAB"))?></span>
					</div>
				</div>
			<?endif;?>
		</div>
	</div>
<?endif;?>
<?if (isset($templateData['TEMPLATE_LIBRARY']) && !empty($templateData['TEMPLATE_LIBRARY'])){
	$loadCurrency = false;
	if (!empty($templateData['CURRENCIES']))
		$loadCurrency = Loader::includeModule('currency');
	CJSCore::Init($templateData['TEMPLATE_LIBRARY']);
	if ($loadCurrency){?>
		<script type="text/javascript">
			BX.Currency.setCurrencies(<? echo $templateData['CURRENCIES']; ?>);
		</script>
	<?}
}?>
<script type="text/javascript">
	viewItemCounter('<?=$arResult["ID"];?>','<?=current($arParams["PRICE_CODE"]);?>');
	var viewedCounter = {
		path: '/bitrix/components/bitrix/catalog.element/ajax.php',
		params: {
			AJAX: 'Y',
			SITE_ID: "<?= SITE_ID ?>",
			PRODUCT_ID: "<?= $arResult['ID'] ?>",
			PARENT_ID: "<?= $arResult['ID'] ?>"
		}
	};
	BX.ready(
		BX.defer(function(){
			$('body').addClass('detail_page');
			BX.ajax.post(
				viewedCounter.path,
				viewedCounter.params
			);
		})
	);
</script>

<?$des = new \Bitrix\Main\Page\FrameStatic('des');$des->startDynamicArea();?>
<script>
	insertElementStoreBlock = function(html){
		if(
			typeof map === 'object' &&
			map && typeof map.destroy === 'function'
		){
			// there is a map on the page
			map.destroy();
		}

		html = html.replace('this.parentNode.removeChild(script);', 'try{this.parentNode.removeChild(script);} catch(e){}');
		html = html.replace('(document.head || document.documentElement).appendChild(script);', '(typeof ymaps === \'undefined\') && (document.head || document.documentElement).appendChild(script);');

		$('.stores .stores_tab').html(html);

		if($('.stores .stores_tab').siblings('.ordered-block__title').length){
			if($('.stores > .ordered-block__title + .stores-title').length){
				$('.stores > .ordered-block__title + .stores-title').remove();
			}

			$('.stores .stores_tab .stores-title').insertAfter($('.stores .stores_tab').siblings('.ordered-block__title'));
		}

		$('.block_container .items, .block_container .detail_items').mCustomScrollbar({
			mouseWheel: {
				scrollAmount: 150,
				preventDefault: true
			}
		});
	}

	setElementStore = function(check, oid){
		if(typeof check !== 'undefined' && check == "Y")
			return;

		if($('.stores_tab').length )
		{
			var objUrl = parseUrlQuery(),
				oidValue = '',
				add_url = '';
			if('clear_cache' in objUrl)
			{
				if(objUrl.clear_cache == 'Y')
					add_url = '?clear_cache=Y';
			}
			if('oid' in objUrl)
			{
				if(parseInt(objUrl.oid)>0)
					oidValue = objUrl.oid;
			}
			if(typeof oid !== 'undefined' && parseInt(oid)>0)
			{
				oidValue = oid;
			}
			if(oidValue)
			{
				if(add_url)
					add_url +='&oid='+oidValue;
				else
					add_url ='?oid='+oidValue;
			}

			$.ajax({
				type:"POST",
				url:arMaxOptions['SITE_DIR']+"ajax/productStoreAmount.php"+add_url,
				data:<?=CUtil::PhpToJSObject($templateData["STORES"], false, true, true)?>,
				success: function(html){
					if(html.indexOf('new ymaps.Map') !== -1){
						// there is a map in response
						if(typeof setElementStore.mapListner === 'undefined'){
							setElementStore.wait = false;

							/*When use ya-maps-api key it does not work*/
							/*window.addEventListener('message', setElementStore.mapListner = function(event){
								if(typeof event.data === 'string'){
									if(
										event.data.indexOf('ready') !== -1 &&
										event.origin.indexOf('maps.ya') !== -1
									){*/
										// message ready recieved from yandex maps
										setTimeout(function(){
											if(typeof setElementStore.lastHtml !== 'undefined'){
												// insert the last
												insertElementStoreBlock(setElementStore.lastHtml);
												delete setElementStore.lastHtml;
											}
											else{
												setElementStore.wait = false;
											}
										}, 50);
									/*}
								}
							});*/
						}

						if(setElementStore.wait){
							// save response until not ready
							setElementStore.lastHtml = html;
						}
						else{
							// insert the first
							setElementStore.wait = true;
							insertElementStoreBlock(html);
						}
					}
					else{
						// there is no a map on the page
						insertElementStoreBlock(html);
					}
				}
			});
		}
	}
	BX.ready(
		BX.defer(function(){
			<?if($templateData["OFFERS_INFO"]["CURRENT_OFFER"]):?>
				setElementStore('', '<?=$templateData["OFFERS_INFO"]["CURRENT_OFFER"];?>');
			<?else:?>
				setElementStore('');
			<?endif;?>
		})
	);
</script>
<?$des->finishDynamicArea();?>
<?if($_GET["RID"]){?><script>$(document).ready(function(){$("<div class='rid_item' data-rid='<?=htmlspecialcharsbx($_GET["RID"]);?>'></div>").appendTo($('body'));});</script><?}?>
<?
if( $templateData["OFFERS_INFO"]["CURRENT_OFFER"] && $arTheme['CHANGE_TITLE_ITEM']['VALUE'] === "Y" ){
	global $currentOfferTitle;
	$currentOfferTitle["CURRENT_OFFER_TITLE"] = $templateData["OFFERS_INFO"]["CURRENT_OFFER_TITLE"];
	$currentOfferTitle["CURRENT_OFFER_WINDOW_TITLE"] = $templateData["OFFERS_INFO"]["CURRENT_OFFER_WINDOW_TITLE"];
}
?>