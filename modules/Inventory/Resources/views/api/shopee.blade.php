@extends('layouts.admin')

@section('title', trans('Lazada Management'))

@section('content')

<?php $strTitle = "Shopee Marketplace Sync API"; session_name("MarketPlaceSync"); session_start(); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?php echo $strTitle;?> <small>MarketPlaceSync...</small> </h1>
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('admin/dashboard/this_month')}}"><i class="fa fa-dashboard"></i> {{ trans('labels.breadcrumb_dashboard') }}</a></li>
            <li class="active"><?php echo $strTitle;?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->

        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> </h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="box box-info">
                                    <!--<div class="box-header with-border">
                                          <h3 class="box-title">Edit category</h3>
                                        </div>-->
                                    <!-- /.box-header -->
                                    <br>
                                    @if (session('update'))
                                    <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong> {{ session('update') }} </strong>
                                    </div>
                                    @endif

                                    @if (count($errors) > 0)
                                    @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        {{$errors->first()}}
                                    </div>
                                    @endif
                                    @endif

                                    <div class="box-body">
                                        
									<script type="text/javascript">
    function openCity(cityName) {
        // Declare all variables
        var i, tabcontent, tablinks;
        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tab-content");
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
		// require_once __DIR__ . '/shopee-php-master/vendor/autoload.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . "/account/modules/inventory/Resources/views/api/shopee-php-master/vendor/autoload.php";
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
    <div style="padding:20px 100px 0 100px;">
    	<div>
        	<form id="form1" name="form1" class="form-horizontal form-validate" enctype="multipart/form-data" method="get">
            	<input type="hidden" id="f_submit" name="f_submit" value="1" />
                
				<div class="form-group">
                        <label for="name" class="col-sm-2 col-md-3 control-label">Partner key </label>
                                <div class="col-sm-10 col-md-4">
								<input type="text" class="form-control field-horizontal" id="a1" name="a1" value="<?php echo $strPartnerKey;?>" style="width:100%;" />
                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Please enter partner key</span>
                                            <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                </div>
                            </div>

							<div class="form-group">
                        <label for="name" class="col-sm-2 col-md-3 control-label">Partner ID </label>
                                <div class="col-sm-10 col-md-4">
								<input type="text" class="form-control field-validate" id="a2" name="a2" value="<?php echo $intPartnerID;?>" style="width:100%;" />
                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Please enter partner ID</span>
                                            <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                </div>
                            </div>

							<div class="form-group">
                        <label for="name" class="col-sm-2 col-md-3 control-label">Shop ID </label>
                                <div class="col-sm-10 col-md-4">
								<input type="text" class="form-control field-validate" id="a3" name="a3" value="<?php echo $intShopID;?>" style="width:100%;" />
                                            <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Please enter shop ID</span>
                                            <span class="help-block hidden">{{ trans('labels.textRequiredFieldMessage') }}</span>
                                </div>
                            </div>

							<div class="form-group">
                        <label for="name" class="col-sm-2 col-md-3 control-label">Other </label>
                                <div class="col-sm-10 col-md-4">
								<strong>Catergory ID</strong>: <?php if(isset($_SESSION["category_id"])) { echo $_SESSION["category_id"]; }?><br />
                            <strong>Attributes IDs</strong>: <?php if(isset($_SESSION["attributes_id"]) && is_array($_SESSION["attributes_id"])) { echo implode(";", $_SESSION["attributes_id"]); }?><br />
                            <strong>Attributes Names</strong>: <?php if(isset($_SESSION["attributes_name"]) && is_array($_SESSION["attributes_name"])) { echo implode(";", $_SESSION["attributes_name"]); }?><br />
                            <strong>Logistics ID</strong>: <?php if(isset($_SESSION["logistic_id"])) { echo $_SESSION["logistic_id"]; }?><br />
                            <strong>Items IDs</strong>: <?php if(isset($_SESSION["items_id"]) && is_array($_SESSION["items_id"])) { echo implode(";", $_SESSION["items_id"]); }?>
                                </div>
                            </div>

							<div class="box-footer text-center">
                                     <button type="submit" class="btn btn-primary">{{ trans('labels.Submit') }}</button>
                                      
                             </div>


						


                   
                
            </form>
        </div>
        <br />
        
        <?php if($strPartnerKey!="" && $intPartnerID!="" && $intShopID!="") { ?>
			<?php 
			function priorCategoryName($arrOrigCategories, $parent_id, $has_children) {
				foreach($arrOrigCategories as $keyCategory => $valueCategory) {
					if($parent_id!="0" && $valueCategory["category_id"]==$parent_id) { return $valueCategory; break; }
				} return array();
			} ?>
        	<script type="text/javascript">
			function changeCategory(val) {
				$.ajax({url: '<?php echo "/admin/accouting/shopee/the_shopee?f_submit=1&a1=".$strPartnerKey."&a2=".$intPartnerID."&a3=".$intShopID."&opt=ajax&type=category&cid=";?>'+val, success: function(result){
						$("#attribute_id").removeAttr("style");
						$("#attribute_id").html(result);
					}
				});
			}
			</script>

            <div  class="row">
            <div class="nav-tab-custom">
				<ul class ="nav nav-tabs">
                <li><button  class="btn btn-info<?php if($strTabType=="" || $strTabType=="category") { ?> active<?php } ?>" onClick="javascript:window.location.href='<?php echo "./shopee/the_shopee?f_submit=1&a1=".$strPartnerKey."&a2=".$intPartnerID."&a3=".$intShopID."&type=category";?>';">Category</button></li>
                <li><button style="margin-left:2px;" class="btn btn-info <?php if($strTabType=="logistics") { ?> active<?php } ?>" onClick="javascript:window.location.href='<?php echo "/admin/accouting/shopee/the_shopee?f_submit=1&a1=".$strPartnerKey."&a2=".$intPartnerID."&a3=".$intShopID."&type=logistics";?>';">Logistics</button></li>
                <li><button style="margin-left:2px;" class="btn btn-info <?php if($strTabType=="prodlist") { ?> active<?php } ?>" onClick="javascript:window.location.href='<?php echo "/admin/accouting/shopee/the_shopee?f_submit=1&a1=".$strPartnerKey."&a2=".$intPartnerID."&a3=".$intShopID."&type=prodlist";?>';">Product Listing</button></li>
                <li><button style="margin-left:2px;" class="btn btn-primary <?php if($strTabType=="addprod") { ?> active<?php } ?>" onClick="javascript:window.location.href='<?php echo "/admin/accouting/shopee/the_shopee?f_submit=1&a1=".$strPartnerKey."&a2=".$intPartnerID."&a3=".$intShopID."&type=addprod";?>';">Add A Product</button></li>
                <li><button style="margin-left:2px;" class="btn btn-warning <?php if($strTabType=="proddetail") { ?> active<?php } ?>" onClick="javascript:window.location.href='<?php echo "/admin/accouting/shopee/the_shopee?f_submit=1&a1=".$strPartnerKey."&a2=".$intPartnerID."&a3=".$intShopID."&type=proddetail";?>';">A Product Details</button></li>
                <li><button style="margin-left:2px;" class="btn btn-danger <?php if($strTabType=="delprods") { ?> active<?php } ?>" onClick="javascript:window.location.href='<?php echo "/admin/accouting/shopee/the_shopee?f_submit=1&a1=".$strPartnerKey."&a2=".$intPartnerID."&a3=".$intShopID."&type=delprods";?>';">Delete Product(s)</button></li>
				</ul>
            </div>
			
            <?php if($strTabType=="" || $strTabType=="category") { ?>
                <div id="category" class="tab-content">
                    <h3>Category</h3>
                    <p>
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
							} ?>
							<select class="form-control" name="shopee_category_id" onChange="changeCategory(this.value);" placeholder="Choose a category">
								<?php foreach($arrCategories as $keyCategory => $valueCategory) { ?>
									<option value="<?php echo $keyCategory; ?>" <?php if(!is_numeric($keyCategory)&&!empty($keyCategory)) { ?> disabled="disabled" <?php } ?>><?php echo $valueCategory; ?></option>
								<?php } ?>
							</select>
                            <?php 
						} catch(Exception $e) {
                            echo "<pre>";print_r($e);echo "</pre>";//exit;
                            //echo "Error detected, please try again later.";exit();
                        }
						?>						
                    </p>
                    <br />
                	<div id="attribute_id" style="display:none;"></div>
                </div>
				</div>
            <?php } ?>
            
            <?php if($strTabType=="logistics") { ?>
				<div id="logistics" class="tab-content">
					
                    <h3>Logistics</h3>
                    <p>
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
                    </p>
                </div>
				</div>
            <?php } ?>
            
            <?php if($strTabType=="prodlist") { ?>
                <div id="prodlist" class="tab-content">
                    <h3>Product Listing</h3>
                    <p>
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
                    </p>
                </div>
				</div>
            <?php } ?>
            
            <?php if($strTabType=="addprod") { ?>
            	<div id="addprod" class="tab-content">
                    <h3>Add A Product</h3>
                    <p>
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
                    </p>
                </div>
				</div>
            <?php } ?>
            
            <?php if($strTabType=="proddetail") { ?>
                <div id="proddetail" class="tab-content">
                    <h3>A Product Details</h3>
                    <p>
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
                    </p>
                </div>
				</div>
            <?php } ?>
            
            <?php if($strTabType=="delprods") { ?>
                <div id="delprods" class="tab-content">
                    <h3>Delete Product(s)</h3>
                    <p>
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
                    </p>
                </div>
				</div>
            <?php } ?>
            
		<?php 
		} else {
			unset($_SESSION["category_id"]);
			unset($_SESSION["attributes_id"]);
			unset($_SESSION["attributes_name"]);
			unset($_SESSION["logistic_id"]);
			unset($_SESSION["items_id"]);
		} ?>
        
        <br /><br />
        <div>
            <table style="position:relative;border:1px groove black;width:100%;">
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td style="width:70%;"><h3>References</h3></td>
                </tr>
                <tr>
                    <td align="right">API Documentations</td>
                    <td>:</td>
                    <td><a href="https://partner.shopeemobile.com/docs" target="_blank">https://partner.shopeemobile.com/docs</a></td>
                </tr>
                <tr>
                    <td align="right">Link to Synced Product</td>
                    <td>:</td>
                    <td>https://shopee.com.my/product/<em>UNIQUE_ID</em></td>
                </tr>
            </table>
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
        
    </div>
										
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->

        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>



@endsection