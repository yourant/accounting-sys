@extends('layouts.admin')

@section('title', trans('Shopee Management'))

@section('content')

<?php $strTitle = "Shopee Marketplace Sync API"; session_name("MarketPlaceSync"); session_start(); ?>
<script src="./js/jquery-1.12.3.js"></script>
	<style type="text/css">
		.tab {
			overflow: hidden;
			border: 1px solid #ccc;
			background-color: #f1f1f1;
		}
		.tab button {
			background-color: inherit;
			float: left;
			border: none;
			outline: none;
			cursor: pointer;
			padding: 14px 16px;
			transition: 0.3s;
		}
		.tab button:hover {
			background-color: #ddd;
		}
		.tab button.active {
			background-color: #ccc;
		}
		.tabcontent {
			display: none;
			padding: 6px 12px;
			border: 1px solid #ccc;
			border-top: none;
		}
		.tabcontent {
			animation: fadeEffect 1s; /* Fading effect takes 1 second */
		}
		@keyframes fadeEffect {
			from {opacity: 0;}
			to {opacity: 1;}
		}
    </style>
    <script type="text/javascript">
		function openCity(cityName) {
			// Declare all variables
			var i, tabcontent, tablinks;
			// Get all elements with class="tabcontent" and hide them
			tabcontent = document.getElementsByClassName("tabcontent");
			for (i = 0; i < tabcontent.length; i++) {
				tabcontent[i].style.display = "none";
			}
			// Get all elements with class="tablinks" and remove the class "active"
			//tablinks = document.getElementsByClassName("tablinks");
			//for (i = 0; i < tablinks.length; i++) {
			//    tablinks[i].className = tablinks[i].className.replace(" active", "");
			//}
			// Show the current tab, and add an "active" class to the button that opened the tab
			document.getElementById(cityName).style.display = "block";
		}
    </script>
    <?php 
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		
		$strPartnerKey = "XXXX"; $intPartnerID = "XXXX"; $intShopID = "XXXX";
		//$strPartnerKey = ""; $intPartnerID = ""; $intShopID = "";
		$strTabType = "";
		if(isset($_REQUEST["f_submit"]) && $_REQUEST["f_submit"]!="") {
			//echo "<pre>";print_r($_REQUEST);echo "</pre>";exit;
			$strPartnerKey = (isset($_REQUEST["a1"])?$_REQUEST["a1"]:"");
			$intPartnerID = (isset($_REQUEST["a2"])?$_REQUEST["a2"]:"");
			$intShopID = (isset($_REQUEST["a3"])?$_REQUEST["a3"]:"");
		}
		if(isset($_REQUEST["type"]) && $_REQUEST["type"]!="") {
			$strTabType = $_REQUEST["type"];
		}
		require_once $_SERVER['DOCUMENT_ROOT'] . "/account/public/api/shopee-php-master/vendor/autoload.php";
		// require_once __DIR__ . '/shopee-php-master/vendor/autoload.php';
		$client = new \Shopee\Client([
			'secret' => $strPartnerKey,
			'partner_id' => (int)$intPartnerID,
			'shopid' => (int)$intShopID, 
		]);
		if(isset($_REQUEST["opt"]) && $_REQUEST["opt"]=="ajax") {
			$intCatID = (isset($_REQUEST["cid"])?$_REQUEST["cid"]:"");
			$_SESSION["category_id"] = $intCatID;
			
			$arrParams = array(
				"category_id" => (int)$intCatID,
				"partner_id" => (int)$intPartnerID,
				"shopid" => (int)$intShopID,
				"timestamp" => time()
			);
			$response = $client->item->customAPIAction("api/v1/item/attributes/get", $arrParams);
			$arrReturns = $response->getData();
			if(count($arrReturns)>0) {
				$strAttribute = "";
				$strAttribute .= "
					<strong><h3>Attributes</h3></strong>
				";
				$strAttribute .= '
					<form id="form2" name="form1" enctype="multipart/form-data" method="get">
				';
				foreach($arrReturns as $keyReturns => $valueReturns) {
					if(is_array($valueReturns) && count($valueReturns)>0) {
						$strAttribute .= "<table>";
						$_SESSION["attributes_id"] = array(); $_SESSION["attributes_name"] = array();
						foreach($valueReturns as $keyInnerReturn => $valueInnerReturn) {
							//$strAttribute .= "<pre>";print_r($valueInnerReturn);echo "</pre>";
							//echo "<pre>";print_r($valueInnerReturn);echo "</pre>";
							$strSelAttributes = "<select name='attributes[]'>";
								if(is_array($valueInnerReturn["options"]) && count($valueInnerReturn["options"])>0) {
									if($valueInnerReturn["is_mandatory"]!="1") {
										$strSelAttributes .= "<option value=''>Select option..</option>";
									}
									foreach($valueInnerReturn["options"] as $keyOption => $valueOption) {
										//echo "<pre>";print_r($valueOption);echo "</pre>";
										if($valueInnerReturn["is_mandatory"]=="1" && $keyOption=="0") {
											$_SESSION["attributes_id"][] = (int)$valueInnerReturn["attribute_id"];
											$_SESSION["attributes_name"][] = $valueOption;
										}
										$strSelAttributes .= "<option value='".$valueOption."'>".$valueOption."</option>";
									}
									
								}
			
							$strSelAttributes .= "</select>";
							$strSelAttributes .= "<input type='hidden' name='attributes_id[]' value='".(int)$valueInnerReturn["attribute_id"]."'>";
							$strAttribute .= "<tr><td>".$valueInnerReturn["attribute_name"].($valueInnerReturn["is_mandatory"]!="1"?" (Optional)":"")."</td><td>:</td><td>".$strSelAttributes."</td></tr>";
						}
						$strAttribute .= "</table>";
						$strAttribute .= '
						<input type="hidden" id="type" name="type" value="logistics" />
						<input type="hidden" id="f_submit" name="f_submit" value="1" />
						<input type="hidden" id="a1" name="a1" value="'.$strPartnerKey.'" />
						<input type="hidden" id="a2" name="a2" value="'.$intPartnerID.'" />
						<input type="hidden" id="a3" name="a3" value="'.$intShopID.'" />
						<input type="button" value="Next" style="margin-top:20px;padding:10px 20px 10px 20px;" onclick="javascript:document.getElementById(\'form2\').submit();">';
					}
				}
				echo $strAttribute;
			}
			exit;
		}
		if(isset($_GET["attributes"]) && count($_GET["attributes"])>0 && isset($_GET["attributes_id"]) && count($_GET["attributes_id"])>0) {
			$_SESSION["attributes_id"] = array(); $_SESSION["attributes_name"] = array();
			foreach($_GET["attributes_id"] as $keyAttributesID => $valueAttributesID) {
				if($_GET["attributes"][$keyAttributesID]!="") {
					$_SESSION["attributes_id"][] = (int)$valueAttributesID;
					$_SESSION["attributes_name"][] = $_GET["attributes"][$keyAttributesID];
				}
			}
			//echo "<pre>";print_r($_SESSION);echo "</pre>";exit;
		}
	?>

    <form id="form1" name="form1" enctype="multipart/form-data" method="get">

		<input type="hidden" id="f_submit" name="f_submit" value="1" />

		<div class="accordion">
			<div class="card border-1 box-shadow-none">
				<div id="accordion-header" data-toggle="collapse" data-target="#Partner_Key" aria-expanded="false" aria-controls="Partner_Key" class="card-header background-none collapsed">
					<h4 class="mb-0">Partner Key</h4>
				</div> 
				<div id="Partner_Key" aria-labelledby="Partner_Key" class="hide collapse" style="">
					<div class="form-group embed-acoordion-textarea">
						<textarea data-name="Partner_Key" placeholder="Enter " id="a1" name="a1" rows="2" cols="50" class="form-control"><?php echo $strPartnerKey;?></textarea>     
					</div>
				</div>
			</div>
		</div>

		<div class="accordion">
			<div class="card border-1 box-shadow-none">
				<div id="accordion-header" data-toggle="collapse" data-target="#Partner_ID" aria-expanded="false" aria-controls="Partner_ID" class="card-header background-none collapsed">
					<h4 class="mb-0">Partner ID</h4>
				</div> 
				<div id="Partner_ID" aria-labelledby="Partner_ID" class="hide collapse" style="">
					<div class="form-group embed-acoordion-textarea">
						<textarea data-name="Partner_ID" placeholder="Enter " id="a2" name="a2" rows="2" cols="50" class="form-control"><?php echo $intPartnerID;?></textarea>     
					</div>
				</div>
			</div>
		</div>

		<div class="accordion">
			<div class="card border-1 box-shadow-none">
				<div id="accordion-header" data-toggle="collapse" data-target="#Shop_ID" aria-expanded="false" aria-controls="Shop_ID" class="card-header background-none collapsed">
					<h4 class="mb-0">Shop ID</h4>
				</div> 
				<div id="Shop_ID" aria-labelledby="Shop_ID" class="hide collapse" style="">
					<div class="form-group embed-acoordion-textarea">
						<textarea data-name="Shop_ID" placeholder="Enter " id="a3" name="a3" rows="2" cols="50" class="form-control"><?php echo $intShopID;?></textarea>     
					</div>
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-xs-12 col-sm-4 col-md-5 align-items-center">
						<h2 class="d-inline-flex mb-0 long-texts">Others</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<div class="form-group col-md-12"><label for="Catergory" class="form-control-label">Catergory ID</label>
							<div class="input-group input-group-merge ">
								<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-font"></i></span></div>
								<input data-name="Catergory" data-value="<?php if(isset($_SESSION["category_id"])) { echo $_SESSION["category_id"]; }?>" placeholder=" Catergory ID" data-field="setting"
									name="Catergory" type="text" value="<?php if(isset($_SESSION["category_id"])) { echo $_SESSION["category_id"]; }?>" id="Catergory" class="form-control" readonly>
							</div>
							<!---->
						</div>
						<div class="form-group col-md-12"><label for="Logistics" class="form-control-label">Logistics ID</label>
							<div class="input-group input-group-merge ">
								<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-font"></i></span></div>
								<input data-name="Logistics" data-value="<?php if(isset($_SESSION["logistic_id"])) { echo $_SESSION["logistic_id"]; }?>" placeholder=" Logistics ID" data-field="setting"
									name="Logistics" type="text" value="<?php if(isset($_SESSION["logistic_id"])) { echo $_SESSION["logistic_id"]; }?>" id="Logistics" class="form-control" readonly>
							</div>
							<!---->
						</div>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<div class="form-group col-md-12"><label for="AttributesName" class="form-control-label">Attributes Names</label>
							<div class="input-group input-group-merge ">
								<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-font"></i></span></div>
								<input data-name="AttributesName" data-value="<?php if(isset($_SESSION["attributes_name"]) && is_array($_SESSION["attributes_name"])) { echo implode(";", $_SESSION["attributes_name"]); }?>" placeholder=" Attributes Names" data-field="setting"
									name="AttributesName" type="text" value="<?php if(isset($_SESSION["attributes_name"]) && is_array($_SESSION["attributes_name"])) { echo implode(";", $_SESSION["attributes_name"]); }?>" id="AttributesName" class="form-control" readonly>
							</div>
							<!---->
						</div>
						<div class="form-group col-md-12"><label for="Attributes" class="form-control-label">Attributes IDs</label>
							<div class="input-group input-group-merge ">
								<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-font"></i></span></div>
								<input data-name="subheading" data-value="<?php if(isset($_SESSION["attributes_id"]) && is_array($_SESSION["attributes_id"])) { echo implode(";", $_SESSION["attributes_id"]); }?>" placeholder=" Attributes IDs" data-field="setting" name="Attributes"
									type="text" id="Attributes" value="<?php if(isset($_SESSION["attributes_id"]) && is_array($_SESSION["attributes_id"])) { echo implode(";", $_SESSION["attributes_id"]); }?>" class="form-control" readonly>
							</div>
							<!---->
						</div>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
						<div class="form-group col-md-12"><label for="Items" class="form-control-label">Items IDs</label>
							<div class="input-group input-group-merge ">
								<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-font"></i></span></div>
								<input data-name="Items" data-value="<?php if(isset($_SESSION["items_id"]) && is_array($_SESSION["items_id"])) { echo implode(";", $_SESSION["items_id"]); }?>" placeholder=" Items IDs" data-field="setting"
									name="Items" type="text" value="<?php if(isset($_SESSION["items_id"]) && is_array($_SESSION["items_id"])) { echo implode(";", $_SESSION["items_id"]); }?>" id="Items" class="form-control" readonly>
							</div>
							<!---->
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<div class="box-footer text-center">
					<button type="submit" class="btn btn-primary"><span class="btn-inner--text">Go</span></button>
				</div>
			</div>
		</div>
    </form>
		<div class="card">
			<div class="card-body">
				<div class="row document-item-body">
					<?php if($strPartnerKey!="" && $intPartnerID!="" && $intShopID!="") { ?>

					<?php 
						function priorCategoryName($arrOrigCategories, $parent_id, $has_children) {
							foreach($arrOrigCategories as $keyCategory => $valueCategory) {
								if($parent_id!="0" && $valueCategory["category_id"]==$parent_id) { return $valueCategory; break; }
							} return array();
						} 
					?>

					<script type="text/javascript">
						function changeCategory(val) {
							$.ajax({url: '<?php echo "./the_shopee.php?f_submit=1&a1=".$strPartnerKey."&a2=".$intPartnerID."&a3=".$intShopID."&opt=ajax&type=category&cid=";?>'+val, success: function(result){
									$("#attribute_id").removeAttr("style");
									$("#attribute_id").html(result);
								}
							});
						}
						function ShopeeHref(Url){
							var location = window.location.pathname;
							window.location.href=window.location.pathname+Url;
						}
					</script>
					

					<div class="col-sm-12 p-0" style="table-layout: fixed;">
						<div class="item-columns-edit">
							<button type="button" class="btn btn-primary" onClick="ShopeeHref(<?php echo "'"."?f_submit=1&a1=".$strPartnerKey."&a2=".$intPartnerID."&a3=".$intShopID."&type=category"."'"; ?>)">
								Category
							</button>
							<!---->
							<button type="button" class="btn btn-primary" onClick="ShopeeHref(<?php echo "'"."?f_submit=1&a1=".$strPartnerKey."&a2=".$intPartnerID."&a3=".$intShopID."&type=logistics"."'"; ?>)">
								Logistics
							</button>
							<!---->
							<button type="button" class="btn btn-primary" onClick="ShopeeHref(<?php echo "'"."?f_submit=1&a1=".$strPartnerKey."&a2=".$intPartnerID."&a3=".$intShopID."&type=prodlist"."'"; ?>)">
								Product Listing
							</button>
							<!---->
							<button type="button" class="btn btn-warning" onClick="ShopeeHref(<?php echo "'"."?f_submit=1&a1=".$strPartnerKey."&a2=".$intPartnerID."&a3=".$intShopID."&type=addprod"."'"; ?>)">
								Add A Product
							</button>
							<!---->
							<button type="button" class="btn btn-primary" onClick="ShopeeHref(<?php echo "'"."?f_submit=1&a1=".$strPartnerKey."&a2=".$intPartnerID."&a3=".$intShopID."&type=proddetail"."'"; ?>)">
								A Product Detail
							</button>
							<!---->
							<button type="button" class="btn btn-danger"  onClick="ShopeeHref(<?php echo "'"."?f_submit=1&a1=".$strPartnerKey."&a2=".$intPartnerID."&a3=".$intShopID."&type=delprods"."'"; ?>)">
								Delete Product(s)
							</button>
							<!---->
						</div>

						<div class="table-responsive overflow-x-scroll overflow-y-hidden">
							
							<?php if($strTabType=="" || $strTabType=="category") { ?>
								
										<?php 
										$arrReturns = array();
										$arrParams = array(
											"partner_id" => (int)$intPartnerID,
											"shopid" => (int)$intShopID,
											"timestamp" => time()
										);
										try {
											$response = $client->item->customAPIAction("api/v1/item/categories/get", $arrParams);
											$arrReturns = $response->getData();
											
											$arrCategories = array("" => "Select Category..");
											$arrOrigCategories = (isset($arrReturns["categories"])?$arrReturns["categories"]:array());
											if(count($arrOrigCategories)>0) {
												foreach($arrOrigCategories as $keyCategory => $valueCategory) {
													$arrWholeName = array();
													$arrTopInfo = array();
													
													$currParentID = $valueCategory["parent_id"];
													$currHasChildren = $valueCategory["has_children"];
													if($valueCategory["parent_id"]!="0") {
														$countLimit = 0;
														do {
															$arrTopInfo = priorCategoryName($arrOrigCategories, $currParentID, $currHasChildren);
															if(count($arrTopInfo)>0) {
																$arrWholeName[] = (isset($arrTopInfo["category_name"])?$arrTopInfo["category_name"]:"");
																$currParentID = (isset($arrTopInfo["parent_id"])?$arrTopInfo["parent_id"]:"0");
																$currHasChildren = (isset($arrTopInfo["has_children"])?$arrTopInfo["has_children"]:"0");
															}
															if($countLimit>100) { break; }
															$countLimit++;
														} while(count($arrTopInfo)>0);
														if(count($arrWholeName)>0) {
															$arrWholeName = array_reverse($arrWholeName,false);
														}
													}
													if(count($arrWholeName)>0) {
														if(trim($valueCategory["has_children"])!="") {
															$arrCategories["child_".$valueCategory["category_id"]] = implode(" > ",$arrWholeName)." > ".$valueCategory["category_name"];
														} else {
															$arrCategories[$valueCategory["category_id"]] = implode(" > ",$arrWholeName)." > ".$valueCategory["category_name"];
														}
													} else {
														$arrCategories["child_".$valueCategory["category_id"]] = $valueCategory["category_name"];
													}
												}
											} 
											?>
												<div data-v-08ebf0f0="" class="form-group col-md-6" id="form-select-category_id">
													<label class="form-control-label">
														<h3>Category</h3>
													</label>
													<div class="has-label">
														<!---->
														<div data-v-08ebf0f0="" class="el-select">
															<!---->
															<div class="el-input el-input--prefix el-input--suffix is-focus">
																<!---->
																<select data-v-08ebf0f0="" name="shopee_category_id" id="shopee_category_id" onChange="changeCategory(this.value);" class="el-input__inner" placeholder="Choose A Category">
																	<?php foreach($arrCategories as $keyCategory => $valueCategory) { ?>
																		<option value="<?php echo $keyCategory; ?>" <?php if(!is_numeric($keyCategory)&&!empty($keyCategory)) { ?> disabled="disabled" <?php } ?>><?php echo $valueCategory; ?></option>
																	<?php } ?>
																</select>
																<span class="el-input__prefix"><span data-v-08ebf0f0=""
																		class="el-input__suffix-inner el-select-icon"><i data-v-08ebf0f0=""
																			class="select-icon-position el-input__icon fa fa-folder"></i></span>
																	
																</span><span class="el-input__suffix"><span class="el-input__suffix-inner"><i
																			class="el-select__caret el-input__icon el-icon-"></i>
																		
																	</span>
																	
																</span>
																
															</div>
														</div>
														
													</div>
												</div>
											<?php 
										} catch(Exception $e) {
											echo "<pre>";print_r($e);echo "</pre>";//exit;
											//echo "Error detected, please try again later.";exit();
											?>
											<table id="items" class="table" style="table-layout: fixed;">
												<colgroup>
													<col class="document-item-40-px">
													<col class="document-item-25">
													<col class="document-item-30 description">
													<col class="document-item-10">
													<col class="document-item-10">
													<col class="document-item-20">
													<col class="document-item-40-px">
												</colgroup>
												<thead class="thead-light">
													<tr>
														<th class="border-top-0 border-right-0 border-bottom-0" style="max-width: 40px;">
															<div></div>
														</th>
														<th class="text-left border-top-0 border-right-0 border-bottom-0">
															Items
														</th>
														<th class="text-left border-top-0 border-right-0 border-bottom-0"></th>
														<th class="text-center pl-2 border-top-0 border-right-0 border-bottom-0">
															Quantity
														</th>
														<th class="text-right border-top-0 border-right-0 border-bottom-0 pr-1"
															style="padding-left: 5px;">
															Price
														</th>
														<th class="text-right border-top-0 border-bottom-0 item-total">
															Amount
														</th>
														<th class="border-top-0 border-right-0 border-bottom-0" style="max-width: 40px;">
															<div></div>
														</th>
													</tr>
												</thead>
												<tbody id="invoice-item-rows" class="table-padding-05">

												</tbody>
											</table>
											<?php
										}
										?>						
									
									<div id="attribute_id" style="display:none;"></div>
								
							<?php } ?>
							
							<?php if($strTabType=="logistics") { ?>
								<div class="form-group col-md-6" id="logistics">
									<label class="form-control-label">
										<h3>logistics</h3>
									</label>
								</div>
										<div class="bootstrap-iso">
											<style scoped>
												@import "css/bootstrap-iso.css";
											</style>
											<?php 
											$arrParams = array(
												"partner_id" => (int)$intPartnerID,
												"shopid" => (int)$intShopID,
												"timestamp" => time()
											);
											try {
												$response = $client->item->customAPIAction("api/v1/logistics/channel/get", $arrParams);
												$arrReturns = $response->getData();
												//echo "<pre>";print_r($arrReturns);echo "</pre>";//exit;
												if(isset($arrReturns["logistics"]) && count($arrReturns["logistics"])>0) {
													$arrEnabledLogistics = array();
													foreach($arrReturns["logistics"] as $keyLogistics => $valueLogistics) {
														if($keyLogistics==0 || $valueLogistics["enabled"]) {
															$arrEnabledLogistics[] = $valueLogistics;
															$_SESSION["logistic_id"] = $valueLogistics["logistic_id"];
														}
													}
													foreach($arrEnabledLogistics as $keyLogistics => $valueLogistics) { ?>
														<?php if($keyLogistics%2==0) { ?>
															<div class="form-group">
														<?php } ?>
																<label class="col-sm-3 control-label">
																	<input id="selected_logistic_id_<?php echo $keyLogistics;?>" name="selected_logistic_id[]" class="sw1" type="checkbox" value="<?php echo $valueLogistics["logistic_id"];?>" <?php if($keyLogistics==0) { ?>checked readonly="readonly" <?php } ?> onClick="javascript:if(this.checked){ document.getElementById('all_fee_type_id_<?php echo $keyLogistics;?>').removeAttribute('readonly'); } else { document.getElementById('all_fee_type_id_<?php echo $keyLogistics;?>').setAttribute('readonly', true); }" />
																	<?php echo $valueLogistics["logistic_name"];?>
																</label>
																<div class="col-sm-3">
																	<input type="hidden" name="all_logistic_id[]" value="<?php echo $valueLogistics["logistic_id"];?>" />
																	<input type="hidden" name="all_logistic_enable[]" value="<?php echo $valueLogistics["enabled"];?>" />
																	<input type="number" id="all_fee_type_id_<?php echo $keyLogistics;?>" name="all_fee_type[]" min='1' step='1' value="6" placeholder="<?php echo "fee";?>" class="form-control" <?php if($keyLogistics!=0) { ?> readonly="readonly" <?php } ?> >
																</div>
														<?php if($keyLogistics%2==1) { ?>
															</div>
															<div>&nbsp;</div>
														<?php } else if(!isset($arrReturns["logistics"][($keyLogistics+1)]) && $keyLogistics%2==0) { ?>
															</div>
															<div>&nbsp;</div>
														<?php } else if(count($arrEnabledLogistics)==1) { ?>
															</div>
															<div>&nbsp;</div>
														<?php } ?>                                    
													<?php } ?>
												<?php }
											} catch(Exception $e) {
												echo "<pre>";print_r($e);echo "</pre>";//exit;
												//echo "Error detected, please try again later.";exit();
											}
											?>
										</div>
									
							<?php } ?>
							
							<?php if($strTabType=="prodlist") { ?>
								<div class="form-group col-md-6" id="prodlist">
									<label class="form-control-label">
										<h3>Product Listing</h3>
									</label>
								</div>
										<?php 
											$arrReturns = array();
											$arrParams = array(
												"partner_id" => (int)$intPartnerID,
												"shopid" => (int)$intShopID,
												"timestamp" => time(),
												"pagination_offset" => 0,
												"pagination_entries_per_page" => 10
											);
											try {
												$response = $client->item->customAPIAction("api/v1/items/get", $arrParams);
												$arrReturns = $response->getData();
												echo "<pre>";print_r($arrReturns);echo "</pre>";
												$_SESSION["items_id"] = array();	
												if(isset($arrReturns["items"]) && is_array($arrReturns["items"]) && count($arrReturns["items"])>0){
													foreach($arrReturns["items"] as $keyData => $valueData) {
														if(!in_array($valueData["item_id"], $_SESSION["items_id"])) {
															$_SESSION["items_id"][] = (isset($valueData["item_id"])?$valueData["item_id"]:"");
														}
													}
												}
											} catch(Exception $e) {
												echo "<pre>";print_r($e);echo "</pre>";//exit;
												//echo "Error detected, please try again later.";exit();
											}
										?>
							<?php } ?>
							
							<?php if($strTabType=="addprod") { ?>
								<div class="form-group col-md-6" id="addprod">
									<label class="form-control-label">
										<h3>Add A Product</h3>
									</label>
								</div>
										<?php 
											if(isset($_SESSION["category_id"]) && $_SESSION["category_id"]!="" && isset($_SESSION["attributes_id"]) && count($_SESSION["attributes_id"])>0 && isset($_SESSION["logistic_id"]) && $_SESSION["logistic_id"]!="") {
												// Add Item
												$objectIMG[] = array("url"=>"http://limcorp.net/images/LimCorp.jpg");
												$strCatID = (isset($_SESSION["category_id"])?$_SESSION["category_id"]:"");
												$objectATR = array();
												if(is_array($_SESSION["attributes_id"]) && is_array($_SESSION["attributes_name"])) {
													foreach($_SESSION["attributes_id"] as $keyAttribute => $valueAttribute) {
														$objectATR[] = array("attributes_id"=>$valueAttribute, "value"=>$_SESSION["attributes_name"][$keyAttribute]);
													}
												}
												//echo "<pre>";print_r($objectATR);echo "</pre>";//exit;
												$objectLOG[] = array("logistic_id"=>(isset($_SESSION["logistic_id"])?$_SESSION["logistic_id"]:""), "enabled"=>true, "is_free"=>false, "shipping_fee"=>6);
												$arrParams = array(
													"category_id" => (int)$strCatID,
													"name" => "Sync Product, Don't Buy",
													"description" => "Sync Product, Don't Buy",
													"price" => 0.5,
													"stock" => 1,
													"images" => $objectIMG,
													"logistics" => $objectLOG,
													"weight" => 0.5,
													"attributes" => $objectATR,
													"partner_id" => (int)$intPartnerID,
													"shopid" => (int)$intShopID,
													"timestamp" => time()
												);
												//echo "<pre>";print_r(json_encode($arrParams));echo "</pre>";//exit;
												try {
													$response = $client->item->add($arrParams);
													$arrReturns = $response->getData();
													echo "<pre>";print_r($arrReturns);echo "</pre>";
													if(!isset($_SESSION["items_id"])) {
														$_SESSION["items_id"] = array();	
													}
													$_SESSION["items_id"][] = (isset($arrReturns["item_id"])?$arrReturns["item_id"]:"");
												} catch(Exception $e) {
													echo "<pre>";print_r($e);echo "</pre>";//exit;
												}
											} else {
												echo "<pre>";print_r("Category ID; Attribute ID; & Logistic ID are compulsory!");echo "</pre>";//exit;
											}
										?>
							<?php } ?>
							
							<?php if($strTabType=="proddetail") { ?>
								<div class="form-group col-md-6" id="proddetail">
									<label class="form-control-label">
										<h3>A Product Details</h3>
									</label>
								</div>
										<?php 
											if(isset($_SESSION["items_id"]) && count($_SESSION["items_id"])>0) {
												foreach($_SESSION["items_id"] as $keyData => $valueData) {
													$arrParams = array(
														"partner_id" => (int)$intPartnerID,
														"shopid" => (int)$intShopID,
														"timestamp" => time(),
														"item_id" => $valueData
													);
													try {
														$response = $client->item->customAPIAction("api/v1/item/get", $arrParams);
														$arrReturns = $response->getData();
														echo "<pre>";print_r($arrReturns);echo "</pre>";
													} catch(Exception $e) {
														echo "<pre>";print_r($e);echo "</pre>";//exit;
														//echo "Error detected, please try again later.";exit();
													}
													break;
												}
											} else {
												echo "<pre>";print_r("Item ID(s) is compulsory!");echo "</pre>";//exit;
											}
										?>
							<?php } ?>
							
							<?php if($strTabType=="delprods") { ?>
								<div class="form-group col-md-6" id="delprods">
									<label class="form-control-label">
										<h3>Delete Product(s)</h3>
									</label>
								</div>
										<?php 
											if(isset($_SESSION["items_id"]) && count($_SESSION["items_id"])>0) {
												foreach($_SESSION["items_id"] as $keyData => $valueData) {
													$arrParams = array(
														"partner_id" => (int)$intPartnerID,
														"shopid" => (int)$intShopID,
														"timestamp" => time(),
														"item_id" => $valueData
													);
													try {
														$response = $client->item->customAPIAction("api/v1/item/delete", $arrParams);
														$arrReturns = $response->getData();
														echo "<pre>";print_r($arrReturns);echo "</pre>";
													} catch(Exception $e) {
														echo "<pre>";print_r($e);echo "</pre>";//exit;
														//echo "Error detected, please try again later.";exit();
													}
												}
												unset($_SESSION["items_id"]);
											} else {
												echo "<pre>";print_r("Item ID(s) is compulsory!");echo "</pre>";//exit;
											}
										?>
									
							<?php } ?>
						</div>
					</div>

					<?php 
					} else {
						unset($_SESSION["category_id"]);
						unset($_SESSION["attributes_id"]);
						unset($_SESSION["attributes_name"]);
						unset($_SESSION["logistic_id"]);
						unset($_SESSION["items_id"]);
					} ?>

				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<div class="box-body text-center">
					<h3>References</h3>
					<div>API Documentations:<a href="https://partner.shopeemobile.com/docs" target="_blank">https://partner.shopeemobile.com/docs</a></div>
					<div>Link to Synced Product:https://shopee.com.my/product/<em>UNIQUE_ID</em></div>
				</div>
			</div>
		</div>

		
        
		<script type="text/javascript">
            <?php if($strTabType=="" || $strTabType=="category") { ?>
                openCity('category')
            <?php } else if($strTabType=="logistics") { ?>
                openCity('logistics')
            <?php } else if($strTabType=="prodlist") { ?>
                openCity('prodlist')
            <?php } else if($strTabType=="addprod") { ?>
                openCity('addprod')
            <?php } else if($strTabType=="proddetail") { ?>
                openCity('proddetail')
            <?php } else if($strTabType=="delprods") { ?>
                openCity('delprods')
            <?php } ?>
        </script>
        
@endsection

@push('scripts_start')
    <script src="{{ asset('modules/Inventory/Resources/assets/js/item_groups.min.js?v=' . module_version('inventory')) }}"></script>
@endpush