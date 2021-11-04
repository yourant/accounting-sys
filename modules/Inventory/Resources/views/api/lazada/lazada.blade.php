@extends('layouts.admin')

@section('title', trans('Lazada Management'))

@section('content')
<?php $strTitle = "Lazada Management"; session_name("MarketPlaceSync"); session_start(); ?>
<script src="./js/jquery-1.12.3.js"></script>


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
    
    // $strRedirectURL = "http://api.emergingdatatech.com/lazada/_lazada_auth/eTF7NHeGZsuDXFr4.php";
    $strRedirectURL = "https://nortify.net/account/1/inventory/lazada/auth";
    $strLazadaAPIKey = "69E43V9uoD3H7QibleCRU477loOuuimaqkdn6fvwBqoHyjfbcta62GWQ";
    $intLazadaShopID = "MY11PG0";
    $strLazadaAppKey = "101812";
    $strLazadaAppSecret = "cYy4zaPXyQZXWo6PMJLKmNoSee1HL5GM";
    //$strRedirectURL = ""; $strLazadaAPIKey = ""; $intLazadaShopID = ""; $strLazadaAppKey = ""; $strLazadaAppSecret = "";
    $strTabType = "";
    if(isset($_REQUEST["f_submit"]) && $_REQUEST["f_submit"]!="") {
        //echo "<pre>";print_r($_REQUEST);echo "</pre>";exit;
        $strRedirectURL = (isset($_REQUEST["a5"])?$_REQUEST["a5"]:"");
        $strLazadaAPIKey = (isset($_REQUEST["a1"])?$_REQUEST["a1"]:"");
        $intLazadaShopID = (isset($_REQUEST["a2"])?$_REQUEST["a2"]:"");
        $strLazadaAppKey = (isset($_REQUEST["a3"])?$_REQUEST["a3"]:"");
        $strLazadaAppSecret = (isset($_REQUEST["a4"])?$_REQUEST["a4"]:"");
    }
    if(isset($_REQUEST["type"]) && $_REQUEST["type"]!="") {
        $strTabType = $_REQUEST["type"];
    }

    include "$_SERVER[DOCUMENT_ROOT]/account/public/api/lazada/lazop-sdk-php/LazopSdk.php";
    
    $c = new LazopClient('https://api.lazada.com.my/rest', $strLazadaAppKey, $strLazadaAppSecret);
    
    if(isset($_REQUEST["opt"]) && $_REQUEST["opt"]=="ajax") {
        $strType = (isset($_REQUEST["type"])?$_REQUEST["type"]:"category");
        if($strType=="category") {
            $intCatID = (isset($_REQUEST["cid"])?$_REQUEST["cid"]:"");
            $_SESSION["category_id"] = $intCatID;
            $request = new LazopRequest('/category/attributes/get','GET');
            $request->addApiParam('primary_category_id', $intCatID);
            $arrResults = $c->execute($request);
            $arrResults = json_decode($arrResults, true);
            $arrReturns = (isset($arrResults["data"])?$arrResults["data"]:array());
            
            if(count($arrReturns)>0) {
                $strAttribute = "";
                $strAttribute .= "
                    <strong><h3>Attributes</h3></strong>
                ";
                $strAttribute .= "<table>";
                //$_SESSION["attributes_id"] = array(); $_SESSION["attributes_name"] = array();
                foreach($arrReturns as $keyReturns => $valueReturns) {
                    //$strAttribute .= "<pre>";print_r($valueReturns);echo "</pre>";
                    //echo "<pre>";print_r($valueReturns["options"]);echo "</pre>";
                    $strSelAttributes = "";
                    if($valueReturns["input_type"]=="richText"||$valueReturns["input_type"]=="text") {
                        $strSelAttributes .= "<input type='text' name='".$valueReturns["name"]."' value='' />";
                    } else {
                        $strSelAttributes .= "<select name='attributes[]'>";
                        if($valueReturns["is_mandatory"]!="1") {
                            $strSelAttributes .= "<option value=''>Select option..</option>";
                        } else if($valueReturns["is_mandatory"]=="1"&&count($valueReturns["options"])==0) {
                            $strSelAttributes .= "<option value=''>-</option>";
                        }
                        if(count($valueReturns["options"])>0) {
                            foreach($valueReturns["options"] as $keyOption => $valueOption) {
                                if($valueReturns["is_mandatory"]=="1" && $keyOption=="0") {
                                    //$_SESSION["attributes_id"][] = 0; //$valueReturns["attribute_id"];
                                    //$_SESSION["attributes_name"][] = $valueOption;
                                }
                                $strSelAttributes .= "<option value='".$valueOption["name"]."'>".$valueOption["name"]."</option>";
                            }
                        }
                        $strSelAttributes .= "</select>";
                        $strSelAttributes .= "<input type='hidden' name='attributes_id[]' value='0'>";
                    }
                    $strAttribute .= "<tr><td>".$valueReturns["label"].($valueReturns["is_mandatory"]!="1"?" (Optional)":"")."</td><td>:</td><td>".$strSelAttributes."</td></tr>";
                }
                $strAttribute .= "</table>";
                echo $strAttribute;
            }
        } else if($strType=="brand") {
            $strBrand = (isset($_REQUEST["brand"])?$_REQUEST["brand"]:"");
            $_SESSION["brand"] = $strBrand;
        }
        exit;
    }
?>
<form id="form1" name="form1" class="form-horizontal form-validate" enctype="multipart/form-data" method="get">
<input type="hidden" id="f_submit" name="f_submit" value="1" />

<div class="accordion">
    <div class="card border-1 box-shadow-none">
        <div id="accordion-header" data-toggle="collapse" data-target="#Auth_Callback_URL" aria-expanded="false" aria-controls="Auth_Callback_URL" class="card-header background-none collapsed">
            <h4 class="mb-0">Auth Callback URL</h4>
        </div> 
        <div id="Auth_Callback_URL" aria-labelledby="Auth_Callback_URL" class="hide collapse" style="">
            <div class="form-group embed-acoordion-textarea">
                <textarea data-name="Auth_Callback_URL" placeholder="Enter " id="a5" name="a5" rows="2" cols="50" class="form-control"><?php echo $strRedirectURL;?></textarea>     
            </div>
        </div>
    </div>
</div>

<div class="accordion">
    <div class="card border-1 box-shadow-none">
        <div id="accordion-header" data-toggle="collapse" data-target="#Lazada_Api_Key" aria-expanded="false" aria-controls="Lazada_Api_Key" class="card-header background-none collapsed">
            <h4 class="mb-0">Lazada Api Key</h4>
        </div> 
        <div id="Lazada_Api_Key" aria-labelledby="accordion-header" class="hide collapse" style="">
            <div class="form-group embed-acoordion-textarea">
                <textarea data-name="Lazada_Api_Key" placeholder="Enter " id="a1" name="a1" rows="2" cols="50" class="form-control"><?php echo $strLazadaAPIKey;?></textarea>     
            </div>
        </div>
    </div>
</div>

<div class="accordion">
    <div class="card border-1 box-shadow-none">
        <div id="accordion-header" data-toggle="collapse" data-target="#Lazada_Shop_ID" aria-expanded="false" aria-controls="Lazada_Shop_ID" class="card-header background-none collapsed">
            <h4 class="mb-0">Lazada Shop ID</h4>
        </div> 
        <div id="Lazada_Shop_ID" aria-labelledby="accordion-header" class="hide collapse" style="">
            <div class="form-group embed-acoordion-textarea">
                <textarea data-name="Lazada_Shop_ID" placeholder="Enter " id="a2" name="a2" rows="2" cols="50" class="form-control"><?php echo $intLazadaShopID;?></textarea>     
            </div>
        </div>
    </div>
</div>

<div class="accordion">
    <div class="card border-1 box-shadow-none">
        <div id="accordion-header" data-toggle="collapse" data-target="#Lazada_App_key" aria-expanded="false" aria-controls="Lazada_App_key" class="card-header background-none collapsed">
            <h4 class="mb-0">Lazada App key</h4>
        </div> 
        <div id="Lazada_App_key" aria-labelledby="accordion-header" class="hide collapse" style="">
            <div class="form-group embed-acoordion-textarea">
                <textarea data-name="Lazada_App_key" placeholder="Enter " id="a3" name="a3" rows="2" cols="50" class="form-control"><?php echo $strLazadaAppKey;?></textarea>     
            </div>
        </div>
    </div>
</div>

<div class="accordion">
    <div class="card border-1 box-shadow-none">
        <div id="accordion-header" data-toggle="collapse" data-target="#Lazada_App_Secret" aria-expanded="false" aria-controls="Lazada_App_Secret" class="card-header background-none collapsed">
            <h4 class="mb-0">Lazada App Secret</h4>
        </div> 
        <div id="Lazada_App_Secret" aria-labelledby="accordion-header" class="hide collapse" style="">
            <div class="form-group embed-acoordion-textarea">
                <textarea data-name="Lazada_App_Secret" placeholder="Enter " id="a4" name="a4" rows="2" cols="50" class="form-control"><?php echo $strLazadaAppSecret;?></textarea>     
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
                <div class="form-group col-md-12"><label for="Brand" class="form-control-label">Brand</label>
                    <div class="input-group input-group-merge ">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-font"></i></span></div>
                        <input data-name="subheading" data-value="<?php if(isset($_SESSION["brand"])) { echo $_SESSION["brand"]; }?>" placeholder=" Brand" data-field="setting" name="Brand"
                            type="text" id="Brand" value="<?php if(isset($_SESSION["brand"])) { echo $_SESSION["brand"]; }?>" class="form-control" readonly>
                    </div>
                    <!---->
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group col-md-12"><label for="Seller" class="form-control-label">Seller SKUs</label>
                    <div class="input-group input-group-merge ">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-font"></i></span></div>
                        <input data-name="Seller" data-value="<?php if(isset($_SESSION["skus"]) && is_array($_SESSION["skus"])) { echo implode(";", $_SESSION["skus"]); }?>" placeholder=" Seller SKUs" data-field="setting"
                            name="Seller" type="text" value="<?php if(isset($_SESSION["skus"]) && is_array($_SESSION["skus"])) { echo implode(";", $_SESSION["skus"]); }?>" id="title" class="form-control" readonly>
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
        
            <?php if($strRedirectURL!="" && $strLazadaAPIKey!="" && $intLazadaShopID!="" && $strLazadaAppKey!="" && $strLazadaAppSecret!="") { ?>
                <?php 
                function priorCategoryName($arrOrigCategories, $parent_id, $has_children) {
                    foreach($arrOrigCategories as $keyCategory => $valueCategory) {
                        if($parent_id!="0" && $valueCategory["category_id"]==$parent_id) { return $valueCategory; break; }
                    } return array();
                } ?>
                <script type="text/javascript">
                function changeCategory(val) {
                    $.ajax({url: '<?php echo "./lazada?f_submit=1&a1=".$strLazadaAPIKey."&a2=".$intLazadaShopID."&a3=".$strLazadaAppKey."&a4=".$strLazadaAppSecret."&a5=".$strRedirectURL."&opt=ajax&type=category&cid=";?>'+val, success: function(result){
                            $("#attribute_id").removeAttr("style");
                            $("#attribute_id").html(result);
                        }
                    });
                }
                function changeBrand(val) {
                    $.ajax({url: '<?php echo "./lazada?f_submit=1&a1=".$strLazadaAPIKey."&a2=".$intLazadaShopID."&a3=".$strLazadaAppKey."&a4=".$strLazadaAppSecret."&a5=".$strRedirectURL."&opt=ajax&type=brand&brand=";?>'+val, success: function(result){
                            //$("#attribute_id").removeAttr("style");
                            //$("#attribute_id").html(result);
                        }
                    });
                }
                function LazadaHref(Url){
                    var location = window.location.pathname;
                    window.location.href=window.location.pathname+Url;
                }
                </script>
                <style scoped>
                    @import "css/bootstrap-iso.css";
                </style>
                
                <?php 
                    if(isset($_GET['close_session'])){
                        unset($_SESSION["lazada_access_token"]);
                    }
                    if(isset($_GET["updaccesstoken"])&&isset($_GET["lazada_code"])&&$_GET["lazada_code"]!="") {
                        $strCode = $_GET["lazada_code"];
                        $request = new LazopRequest('/auth/token/create');
                        $request->addApiParam('code',$strCode);
                        print_r($request)."<br>";
                        $arrResults = $c->execute($request);
                        print_r($arrResults)."<br>";
                        $arrResults = json_decode($arrResults, true);
                        if(isset($arrResults["access_token"]) && $arrResults["access_token"]!="") {
                            $_SESSION["lazada_access_token"] = $arrResults["access_token"];
                            echo "<script>alert('SESSION lazada_access_token call Success');</script>";
                        }else{
                            echo "</br>";
                            echo $_SESSION["lazada_access_token"] = $_GET["lazada_code"];
                            echo "<script>alert('SESSION lazada_access_token call Fail Using Sample Token SESSION lazada_access_token == $_GET[lazada_code]');</script>";
                        }
                    }
                    // $_SESSION["lazada_access_token"]="Testing";
                    if(!isset($_SESSION["lazada_access_token"])) { ?>
                        <div class="box-body text-center">
                        <div class="tab"><strong>Note</strong>: <em>Just require for 1 time, to generate the access token.</em></div>
                        <div class="tabcontent2" style="display:block;">
                            <p>
                                <form class="form-horizontal form-validate"  id="form2" name="form2" enctype="multipart/form-data" method="get">
                                    <input type="hidden" id="f_submit" name="f_submit" value="1" />
                                    <input type="hidden" id="a1" name="a1" value="<?php echo $strLazadaAPIKey;?>" />
                                    <input type="hidden" id="a2" name="a2" value="<?php echo $intLazadaShopID;?>" />
                                    <input type="hidden" id="a3" name="a3" value="<?php echo $strLazadaAppKey;?>" />
                                    <input type="hidden" id="a4" name="a4" value="<?php echo $strLazadaAppSecret;?>" />
                                    <input type="hidden" id="a5" name="a5" value="<?php echo $strRedirectURL;?>" />
                                    <input type="hidden" id="updaccesstoken" name="updaccesstoken" value="1" />
                                    
                                        <div class="form-group">
                                            <label for="name" class="control-label" for="demo-hor-1"><?php echo "Lazada Auth Code";?></label>
                                            <div>
                                                <input class="form-control field-validate" type="text" name="lazada_code" value="" placeholder="<?php echo "Lazada Auth Code";?>" class="form-control required">
                                                (Click <a style="color:green;" href="https://auth.lazada.com/oauth/authorize?response_type=code&force_auth=true&redirect_uri=<?php echo $strRedirectURL;?>&client_id=<?php echo $strLazadaAppKey;?>" target="_blank"><u>Here</u></a> to get your Lazada Code, then copy and paste to the textbox) <?php /* <em>NOTE: Lazada Auth Code will be used to generate Lazada Access Token that valid for 7 days.</em>*/ ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div>&nbsp;</div>
                                    <div class="box-footer text-center">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                
                                </form>
                            </p>
                        </div>
                        <?php 
                    } else { 
                    $accessToken = $_SESSION["lazada_access_token"]; ?>
                    <div class="row document-item-body">
                        <div class="col-sm-12 p-0" style="table-layout: fixed;">
                            <div class="item-columns-edit">
                                <button type="button" class="btn btn-primary" onClick="LazadaHref(<?php echo "'"."?f_submit=1&a1=".$strLazadaAPIKey."&a2=".$intLazadaShopID."&a3=".$strLazadaAppKey."&a4=".$strLazadaAppSecret."&a5=".$strRedirectURL."&type=category"."'"; ?>)">
                                    Category
                                </button>
                                <!---->
                                <button type="button" class="btn btn-primary" onClick="LazadaHref(<?php echo "'"."?f_submit=1&a1=".$strLazadaAPIKey."&a2=".$intLazadaShopID."&a3=".$strLazadaAppKey."&a4=".$strLazadaAppSecret."&a5=".$strRedirectURL."&type=brands"."'"; ?>)">
                                    Brands
                                </button>
                                <!---->
                                <button type="button" class="btn btn-primary" onClick="LazadaHref(<?php echo "'"."?f_submit=1&a1=".$strLazadaAPIKey."&a2=".$intLazadaShopID."&a3=".$strLazadaAppKey."&a4=".$strLazadaAppSecret."&a5=".$strRedirectURL."&type=prodlist"."'"; ?>)">
                                    Product Listing
                                </button>
                                <!---->
                                <button type="button" class="btn btn-warning" onClick="LazadaHref(<?php echo "'"."?f_submit=1&a1=".$strLazadaAPIKey."&a2=".$intLazadaShopID."&a3=".$strLazadaAppKey."&a4=".$strLazadaAppSecret."&a5=".$strRedirectURL."&type=addprod"."'"; ?>)">
                                    Add A Product
                                </button>
                                <!---->
                                <button type="button" class="btn btn-primary" onClick="LazadaHref(<?php echo "'"."?f_submit=1&a1=".$strLazadaAPIKey."&a2=".$intLazadaShopID."&a3=".$strLazadaAppKey."&a4=".$strLazadaAppSecret."&a5=".$strRedirectURL."&type=proddetail"."'"; ?>)">
                                    A Product Detail
                                </button>
                                <!---->
                                <button type="button" class="btn btn-danger"  onClick="LazadaHref(<?php echo "'"."?f_submit=1&a1=".$strLazadaAPIKey."&a2=".$intLazadaShopID."&a3=".$strLazadaAppKey."&a4=".$strLazadaAppSecret."&a5=".$strRedirectURL."&type=delprods"."'"; ?>)">
                                    Delete Product(s)
                                </button>
                                <!---->
                                <button type="button" class="btn btn-success"  onClick="LazadaHref(<?php echo "'"."?f_submit=1&a1=".$strLazadaAPIKey."&a2=".$intLazadaShopID."&a3=".$strLazadaAppKey."&a4=".$strLazadaAppSecret."&a5=".$strRedirectURL."&type=orders"."'"; ?>)">
                                    Order(s)
                                </button>
                                <!---->
                                <form method="GET" action="">
                                    <button type="submit" name="close_session" value="close_session" class="btn btn-success">
                                        Close Session
                                    </button>
                                </form>
                            </div>
                            
                            <?php if($strTabType=="" || $strTabType=="category") { ?>
                                <div class="form-group col-md-6" id="category">
									<label class="form-control-label">
										<h3>Category</h3>
									</label>
								
                                        <?php 
                                        $request = new LazopRequest('/category/tree/get','GET');
                                        $arrResults = $c->execute($request);
                                        $arrayCategoriesData = json_decode($arrResults, true);
                                        //echo "<pre>";print_r($arrayCategoriesData);echo "</pre>";exit;
                                        $arrCategories = array("" => "Select Category..");
                                        function sortCategoryName($arrCategories, $valueCategory, $parent_id, $parent_name) {
                                            //echo "<pre>";print_r($valueCategory);echo "</pre>";exit;
                                            if(isset($valueCategory) && is_array($valueCategory) && count($valueCategory)>0) {
                                                foreach($valueCategory as $keyInnerCategory => $valueInnerCategory) {
                                                    $strNames = $parent_name . " > " . $valueInnerCategory["name"];
                                                    if($valueInnerCategory["leaf"]=="1") {
                                                        $arrCategories[$valueInnerCategory["category_id"]] = $strNames;
                                                    } else {
                                                        $arrCategories["child_".$valueInnerCategory["category_id"]] = $strNames;
                                                    }
                                                    if(isset($valueInnerCategory["children"]) && is_array($valueInnerCategory["children"]) && count($valueInnerCategory["children"])>0) {
                                                        $arrCategories = sortCategoryName($arrCategories, $valueInnerCategory["children"], $valueInnerCategory["category_id"], $strNames);
                                                    }
                                                }
                                            }
                                            return $arrCategories;
                                        }
                                        if(isset($arrayCategoriesData["data"]) && count($arrayCategoriesData["data"])>0) {
                                            foreach($arrayCategoriesData["data"] as $keyCategory => $valueCategory) {		
                                                if($valueCategory["leaf"]=="1") {
                                                    $arrCategories[$valueCategory["category_id"]] = $valueCategory["name"];
                                                } else {
                                                    $arrCategories["child_".$valueCategory["category_id"]] = $valueCategory["name"];
                                                }
                                                if(isset($valueCategory["children"]) && is_array($valueCategory["children"]) && count($valueCategory["children"])>0) {
                                                    $arrCategories = sortCategoryName($arrCategories, $valueCategory["children"], $valueCategory["category_id"], $valueCategory["name"]);
                                                }
                                            }
                                        }
                                        //echo "<pre>";print_r($arrCategories);echo "</pre>"; ?>
                                        <div class="has-label">
                                            <div data-v-08ebf0f0="" class="el-select">
                                                <div class="el-input el-input--prefix el-input--suffix is-focus">
                                                    <select data-v-08ebf0f0="" name="lazada_category_id" id="lazada_category_id" onChange="javascript:changeCategory(this.value);" class="el-input__inner" placeholder="Choose A Category" tabindex="-1" data-hide-disabled="true">
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
                                    <div id="attribute_id" style="display:none;"></div>
                            <?php } ?>
                            
                            <?php if($strTabType=="brands") { ?>
                                <div class="form-group col-md-6" id="brands">
									<label class="form-control-label">
										<h3>Brands</h3>
									</label>
                                
                                        
                                            <?php 
                                            $arrBrands = array();
                                            $request = new LazopRequest('/brands/get','GET');
                                            $request->addApiParam('offset',0);
                                            $request->addApiParam('limit',1000);
                                            $arrResults = $c->execute($request);
                                            $arrResults = json_decode($arrResults, true); 
                                            $arrBrands = (isset($arrResults["data"])?$arrResults["data"]:array());
                                            ?>
                                            <div class="has-label">
                                                <div data-v-08ebf0f0="" class="el-select">
                                                    <div class="el-input el-input--prefix el-input--suffix is-focus">
                                                        <select data-v-08ebf0f0="" name="brand" id="brand" onChange="javascript:changeBrand(this.value);" class="el-input__inner" placeholder="Brands" tabindex="-1" data-hide-disabled="true">
                                                            <option value="">Select Brand</option>
                                                            <option value="No Brand">No Brand</option>
                                                            <?php if(isset($arrBrands) && is_array($arrBrands) && count($arrBrands)>0) { ?>
                                                                <?php foreach($arrBrands as $keyBrand => $valueBrand) { ?>
                                                                    <option value="<?php echo $valueBrand["name"]; //$valueBrand["brand_id"]; ?>"><?php echo $valueBrand["name"]; ?></option>
                                                                <?php } ?>
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
                            <?php } ?>
                            
                            <?php if($strTabType=="prodlist") { ?>
                                <div class="form-group col-md-12" id="prodlist">
									<label class="form-control-label">
										<h3>Product Listing(In Lazada)</h3>
									</label>
                                            <?php 
                                                $arrBrands = array();
                                                $request = new LazopRequest('/products/get','GET');
                                                /*$request->addApiParam('filter','live');
                                                $request->addApiParam('update_before','2018-01-01T00:00:00+0800');
                                                $request->addApiParam('search','product_name');
                                                $request->addApiParam('create_before','2018-01-01T00:00:00+0800');
                                                $request->addApiParam('offset','0');
                                                $request->addApiParam('create_after','2010-01-01T00:00:00+0800');
                                                $request->addApiParam('update_after','2010-01-01T00:00:00+0800');
                                                $request->addApiParam('limit','10');
                                                $request->addApiParam('options','1');
                                                $request->addApiParam('sku_seller_list',' [\"39817:01:01\", \"Samsung Note FE Black\"]');*/
                                                $arrResults = $c->execute($request, $accessToken);
                                                $datatest = file_get_contents("$_SERVER[DOCUMENT_ROOT]/account_test/public/api/lazada/lazop-sdk-php/apiData.php");
                                                $j = json_decode($arrResults, true); 
                                                
                                                $i = 0;
                                                $a = 0;
                                                $count = 0;
                                                $servername = "mi3-ss61"; // mi3-ss61 (In Cpanel server)
                                                $username = "elegan14_akau644_test"; //elegan14_akau644
                                                $password = ";9mUwOX*y[QW"; //1pS)q9L]17
                                                $database = "elegan14_akau644_test"; //elegan14_akau644
                                                $conn = new mysqli($servername, $username, $password, $database);
                                        if(!isset($j['data'])){
                                            echo "<pre>";print_r($arrResults);echo "</pre>";
                                        }else{
                                            $totalproduct = $j['data']['total_products'];
                                            $item_id = $j['data']['products'][0]['attributes']['short_description'];
                                            ?>

                                            <div class="table-responsive">
                                                <table class="table table-flush table-hover">
                                                    <thead class="thead-light">
                                                        <tr class="row table-head-line">
                                                            <th class="col-md-1">Id</th>
                                                            <th class="col-md-2">Name</th>
                                                            <th class="col-md-1">SKU ID</th>
                                                            <th class="col-md-2">Warrenty</th>
                                                            <th class="col-md-1">Brand</th>
                                                            <th class="col-md-1">Quantity</th>
                                                            <th class="col-md-1">Price</th>
                                                            <th class="col-md-2">Created</th>
                                                            <th class="col-md-1">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach($j['data']['products'] as $keys=>$value){
                                                            ?>
                                                            <tr class="row align-items-center border-top-1">
                                                                <td class="col-md-1"><?php echo $value['item_id']; ?></td>
                                                                <td class="col-md-2"><?php echo $j['data']['products'][$a]['attributes']['name']; ?></td>
                                                                <td class="col-md-1"><?php echo $j['data']['products'][$a]['skus'][0]['SkuId']; ?></td>
                                                                <td class="col-md-2"><?php echo $j['data']['products'][$a]['attributes']['warranty_type']; ?></td>
                                                                <td class="col-md-1"><?php echo $j['data']['products'][$a]['attributes']['brand']; ?></td>
                                                                <td class="col-md-1"><?php echo $j['data']['products'][$a]['skus'][0]['quantity']; ?></td>
                                                                <td class="col-md-1"><?php echo $j['data']['products'][$a]['skus'][0]['price']; ?></td>
                                                                <td class="col-md-2"><?php echo $value['created_time']; ?></td>
                                                                <td class="col-md-1"><?php echo $j['data']['products'][$a]['skus'][0]['Status']; ?></td>
                                                            </tr>
                                                            <?php
                                                            $a++;
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php
                                            foreach($j['data']['products'] as $keys=>$value){
                                                // echo "Item Id: "; echo $value['item_id']; echo "</br>";
                                                // echo "Short Desc: "; echo $j['data']['products'][$i]['attributes']['short_description']; echo "</br>";
                                                // echo "Name: "; echo $j['data']['products'][$i]['attributes']['name']; echo "</br>";
                                                // echo "Desc: "; echo $j['data']['products'][$i]['attributes']['description']; echo "</br>";
                                                // echo "Warrenty Type: "; echo $j['data']['products'][$i]['attributes']['warranty_type']; echo "</br>";
                                                // echo "Brand: "; echo $j['data']['products'][$i]['attributes']['brand']; echo "</br>";
                                                // echo "Created Time: "; echo $value['created_time']; echo "</br>";
                                                // echo "Updated Time: "; echo $value['updated_time']; echo "</br>";
                                                // echo "Status: "; echo $j['data']['products'][$i]['skus'][0]['Status']; echo "</br>";
                                                // echo "Quantity: "; echo $j['data']['products'][$i]['skus'][0]['quantity']; echo "</br>";
                                                // echo "Product Weight: "; echo $j['data']['products'][$i]['skus'][0]['product_weight']; echo "</br>";
                                                // //echo "Images: "; echo $j['data']['products'][$i]['skus'][0]['Images']; echo "</br>";
                                                // echo "Seller Sku: "; echo $j['data']['products'][$i]['skus'][0]['SellerSku']; echo "</br>";
                                                // echo "Package Width "; echo $j['data']['products'][$i]['skus'][0]['package_width']; echo "</br>";
                                                // echo "Package Length: "; echo $j['data']['products'][$i]['skus'][0]['package_length']; echo "</br>";
                                                // echo "Package Height: "; echo $j['data']['products'][$i]['skus'][0]['package_height']; echo "</br>";
                                                // echo "Package Weight: "; echo $j['data']['products'][$i]['skus'][0]['package_weight']; echo "</br>";
                                                // echo "Special From Time: "; echo $j['data']['products'][$i]['skus'][0]['special_from_time']; echo "</br>";
                                                // echo "Special To Time: "; echo $j['data']['products'][$i]['skus'][0]['special_to_time']; echo "</br>";
                                                // echo "Special To Date: "; echo $j['data']['products'][$i]['skus'][0]['special_to_date']; echo "</br>";
                                                // echo "Price: "; echo $j['data']['products'][$i]['skus'][0]['price']; echo "</br>";
                                                // echo "Available: "; echo $j['data']['products'][$i]['skus'][0]['Available']; echo "</br>";
                                                // echo "SKU ID: "; echo $j['data']['products'][$i]['skus'][0]['SkuId']; echo "</br></br>";

                                                $sql = "SELECT item_id FROM data_insert WHERE item_id = '".$value['item_id']."'";
                                                $result = mysqli_query($conn,$sql);
                                                $rss = mysqli_fetch_array($result);
                                                
                                                if($rss['item_id'] != "") {
                                                    // echo "Data Available "; echo $value['item_id']; echo "</br>";
                                                    // Update all the data of the item_id place
                                                }else{
                                                    $sql = "INSERT INTO data_insert(
                                                                        item_id,
                                                                        short_desc,
                                                                        name,
                                                                        desciprtion,
                                                                        warrenty_type,
                                                                        brand,
                                                                        create_time,
                                                                        update_time,
                                                                        status,
                                                                        quantity,
                                                                        prod_weight,
                                                                        seller_sku,
                                                                        pack_width,
                                                                        pack_length,
                                                                        pack_height,
                                                                        pack_weight,
                                                                        special_from_time,
                                                                        special_to_time,
                                                                        special_to_date,
                                                                        price,
                                                                        available,
                                                                        SKU_ID
                                                                        )
                                                                        VALUES(
                                                                        '".$value['item_id']."',
                                                                        '".$j['data']['products'][$i]['attributes']['short_description']."',
                                                                        '".$j['data']['products'][$i]['attributes']['name']."',
                                                                        '".$j['data']['products'][$i]['attributes']['description']."',
                                                                        '".$j['data']['products'][$i]['attributes']['warranty_type']."',
                                                                        '".$j['data']['products'][$i]['attributes']['brand']."',
                                                                        '".$value['created_time']."',
                                                                        '".$value['updated_time']."',
                                                                        '".$j['data']['products'][$i]['skus'][0]['Status']."',
                                                                        '".$j['data']['products'][$i]['skus'][0]['quantity']."',
                                                                        '".$j['data']['products'][$i]['skus'][0]['product_weight']."',
                                                                        '".$j['data']['products'][$i]['skus'][0]['SellerSku']."',
                                                                        '".$j['data']['products'][$i]['skus'][0]['package_width']."',
                                                                        '".$j['data']['products'][$i]['skus'][0]['package_length']."',
                                                                        '".$j['data']['products'][$i]['skus'][0]['package_height']."',
                                                                        '".$j['data']['products'][$i]['skus'][0]['package_weight']."',
                                                                        '".$j['data']['products'][$i]['skus'][0]['special_from_time']."',
                                                                        '".$j['data']['products'][$i]['skus'][0]['special_to_time']."',
                                                                        '".$j['data']['products'][$i]['skus'][0]['special_to_date']."',
                                                                        '".$j['data']['products'][$i]['skus'][0]['price']."',
                                                                        '".$j['data']['products'][$i]['skus'][0]['Available']."',
                                                                        '".$j['data']['products'][$i]['skus'][0]['SkuId']."'
                                                                        )";
                                                    if ($conn->query($sql) === TRUE) {
                                                        $count++;
                                                    } else {
                                                        echo "Error: " . $sql . "<br>" . $conn->error;
                                                    }
                                                }
                                                $i++;
                                            }
                                            if($count == 0){
                                                echo "<script>alert('All Data Available')</script>";
                                            }elseif($count >= 1){
                                                echo "<script>alert('$count New record created successfully')</script>";
                                            }else{
                                                echo "<script>alert('Something get error')</script>";
                                            }

                                        }
                                        ?>   
                                </div>
                                <div class="form-group col-md-12" id="prodlist">
									<label class="form-control-label">
										<h3>Product Listing(In System)</h3>
									</label>
                                        <div class="table-responsive">
                                            <table class="table table-flush table-hover">
                                                <thead class="thead-light">
                                                    <tr class="row table-head-line">
                                                        <th class="col-md-1">Id</th>
                                                        <th class="col-md-2">Name</th>
                                                        <th class="col-md-1">SKU ID</th>
                                                        <th class="col-md-2">Warrenty</th>
                                                        <th class="col-md-1">Brand</th>
                                                        <th class="col-md-1">Quantity</th>
                                                        <th class="col-md-1">Price</th>
                                                        <th class="col-md-2">Created</th>
                                                        <th class="col-md-1">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql_data = "SELECT * FROM data_insert";
                                                    $result_data = mysqli_query($conn,$sql_data);
                                                    while($sys = mysqli_fetch_array($result_data)){
                                                        ?>
                                                    <tr class="row align-items-center border-top-1">
                                                        <td class="col-md-1"><?php echo $sys['item_id']; ?></td>
                                                        <td class="col-md-2"><?php echo $sys['name']; ?></td>
                                                        <td class="col-md-1"><?php echo $sys['SKU_ID']; ?></td>
                                                        <td class="col-md-2"><?php echo $sys['warrenty_type']; ?></td>
                                                        <td class="col-md-1"><?php echo $sys['brand']; ?></td>
                                                        <td class="col-md-1"><?php echo $sys['quantity']; ?></td>
                                                        <td class="col-md-1"><?php echo $sys['price']; ?></td>
                                                        <td class="col-md-2"><?php echo $sys['create_time']; ?></td>
                                                        <td class="col-md-1"><?php echo $sys['status']; ?></td>
                                                    </tr>
                                                    <?php 
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                <div>
                            <?php } ?>
                            
                            <?php if($strTabType=="addprod") { ?>
                                <div class="form-group col-md-6" id="addprod">
									<label class="form-control-label">
										<h3>Add A Product</h3>
									</label>
                                </div>
                                        <?php 
                                            if(isset($_SESSION["category_id"]) && $_SESSION["category_id"]!="") {
                                                // Add Item
                                                $strXML = '<?xml version="1.0" encoding="UTF-8" ?>
                                                <Request>
                                                    <Product>
                                                        <PrimaryCategory>'.$_SESSION["category_id"].'</PrimaryCategory>
                                                        <SPUId></SPUId>
                                                        <AssociatedSku></AssociatedSku>
                                                        <Attributes>
                                                            <name>Sync Product, Don\'t Buy</name>
                                                            <short_description>Sync Product, Don\'t Buy</short_description>
                                                            <brand>'.(isset($_SESSION["brand"])&&$_SESSION["brand"]!=""?$_SESSION["brand"]:"No Brand").'</brand>
                                                            <model>theModel</model>
                                                        </Attributes>
                                                        <Skus>
                                                            <Sku>
                                                                <SellerSku>api-create-test-x1</SellerSku>
                                                                <color_family>Green</color_family>
                                                                <size>40</size>
                                                                <quantity>1</quantity>
                                                                <price>1.50</price>
                                                                <package_weight>0.50</package_weight>
                                                                <package_length>10</package_length>
                                                                <package_height>20</package_height>
                                                                <package_width>50</package_width>
                                                                <package_content>As described as Description</package_content>
                                                                <tax_class>default</tax_class>
                                                            </Sku>
                                                        </Skus>
                                                    </Product>
                                                </Request>';
                                                $request = new LazopRequest('/product/create');
                                                $request->addApiParam('payload', $strXML);
                                                $arrResults = $c->execute($request, $accessToken);
                                                $arrResults = json_decode($arrResults, true);
                                                //echo "<pre>";print_r($arrResults);echo "</pre>";exit;
                                                
                                                $sync_error = "";
                                                $sync_msg = "";
                                                $lazada_sync = 0;
                                                if(isset($arrResults["code"])) {
                                                    if($arrResults["code"]=="0") {
                                                        echo "<pre>";print_r($arrResults);echo "</pre>";//exit;
                                                        $sync_msg = "Product successfully synced.";
                                                        if(!isset($_SESSION["skus"])) {
                                                            $_SESSION["skus"] = array();	
                                                        }
                                                        $_SESSION["skus"][] = (isset($arrResults["data"]["sku_list"][0]["seller_sku"])?$arrResults["data"]["sku_list"][0]["seller_sku"]:"");
                                                        // Images will be migrated to lazada site before set to the product. - Start
                                                        $strImages = "<Request><Images><Url>http://limcorp.net/images/shop_open-512.png</Url></Images></Request>";
                                                        //echo "<pre>";print_r($strImages);echo "</pre>";exit;
                                                        $request = new LazopRequest('/images/migrate');
                                                        $request->addApiParam('payload', $strImages);
                                                        $arrResults = $c->execute($request, $accessToken);
                                                        $arrResults = json_decode($arrResults, true);
                                                        //echo "<pre>";print_r($arrResults);echo "</pre>";
                                                        $intBatchID = "";
                                                        if(isset($arrResults["batch_id"]) && $arrResults["batch_id"]!="") {
                                                            $intBatchID = $arrResults["batch_id"];
                                                        }
                                                        if($intBatchID!="") {
                                                            sleep(3);
                                                            $request = new LazopRequest('/image/response/get','GET');
                                                            $request->addApiParam('batch_id', $intBatchID);
                                                            $arrResults = $c->execute($request, $accessToken);
                                                            $arrResults = json_decode($arrResults, true);
                                                            //echo "<pre>".$intBatchID;print_r($arrResults);echo "</pre>";
                                                            if(isset($arrResults["code"]) && $arrResults["code"]=="0" && isset($arrResults["data"]["images"]) && is_array($arrResults["data"]["images"]) && count($arrResults["data"]["images"])>0) {
                                                                if(isset($arrResults["data"]["errors"]) && is_array($arrResults["data"]["errors"]) && count($arrResults["data"]["errors"])>0) {
                                                                    $sync_msg .= "; But ".count($arrResults["data"]["errors"])." photo".(count($arrResults["data"]["errors"])>1?"s":"")." failed to upload (Image min height [330], min width[330])";
                                                                }
                                                                $strImages = "
                                                                <Request>
                                                                    <Product>
                                                                        <Skus>
                                                                            <Sku>
                                                                                <SellerSku>api-create-test-x1</SellerSku>
                                                                                <Images>";
                                                                                    foreach($arrResults["data"]["images"] as $keyImage => $valueImage) {
                                                                                        $strImages .= "<Image>".$valueImage["url"]."</Image>";
                                                                                    }
                                                                $strImages .= "</Images>
                                                                            </Sku>
                                                                        </Skus>
                                                                    </Product>
                                                                </Request>";
                                                                $request = new LazopRequest('/images/set');
                                                                $request->addApiParam('payload', $strImages);
                                                                $arrResults = $c->execute($request, $accessToken);
                                                                $arrResults = json_decode($arrResults, true);
                                                                //echo "<pre>".$intBatchID;print_r($arrResults);echo "</pre>";
                                                            } else if(isset($arrResults["code"]) && $arrResults["code"]!="0") {
                                                                $sync_msg .= "; But all photo(s) failed to upload".(isset($arrResults["message"])?(" (".$arrResults["message"].")"):"")."";
                                                            }
                                                        }
                                                        // Images will be migrated to lazada site before set to the product. - End
                                                        echo $sync_msg."<br />";
                                                    } else {
                                                        echo "Error: ".$arrResults["code"]."<br />";
                                                        echo $arrResults["message"].(isset($arrResults["detail"][0]["message"])?(" (".$arrResults["detail"][0]["message"].")"):"");
                                                    }
                                                } else {
                                                    echo "Failed to sync. please try again!";
                                                }
                                            } else {
                                                echo "<pre>";print_r("Category ID is compulsory!");echo "</pre>";//exit;
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
                                            if(isset($_SESSION["skus"]) && count($_SESSION["skus"])>0) {
                                                foreach($_SESSION["skus"] as $keyData => $valueData) {
                                                    $request = new LazopRequest('/products/get','GET');
                                                    /*$request->addApiParam('filter','live');
                                                    $request->addApiParam('update_before','2018-01-01T00:00:00+0800');
                                                    $request->addApiParam('search','product_name');
                                                    $request->addApiParam('create_before','2018-01-01T00:00:00+0800');
                                                    $request->addApiParam('offset','0');
                                                    $request->addApiParam('create_after','2010-01-01T00:00:00+0800');
                                                    $request->addApiParam('update_after','2010-01-01T00:00:00+0800');
                                                    $request->addApiParam('limit','10');
                                                    $request->addApiParam('options','1');*/
                                                    $request->addApiParam('sku_seller_list','["'.$valueData.'"]');
                                                    $arrResults = $c->execute($request, $accessToken);
                                                    $arrResults = json_decode($arrResults, true); 
                                                    echo "<pre>";print_r($arrResults);echo "</pre>";//exit;
                                                    break;
                                                }
                                            } else {
                                                echo "<pre>";print_r("Seller SKU(s) is compulsory!");echo "</pre>";//exit;
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
                                            if(isset($_SESSION["skus"]) && count($_SESSION["skus"])>0) {
                                                foreach($_SESSION["skus"] as $keyData => $valueData) {
                                                    $request = new LazopRequest('/product/remove');
                                                    $request->addApiParam('seller_sku_list','["'.$valueData.'"]');
                                                    $arrResults = $c->execute($request, $accessToken);
                                                    $arrResults = json_decode($arrResults, true); 
                                                    echo "<pre>";print_r($arrResults);echo "</pre>";//exit;
                                                }
                                                unset($_SESSION["skus"]);
                                            } else {
                                                echo "<pre>";print_r("Seller SKU(s) is compulsory!");echo "</pre>";//exit;
                                            }
                                        ?>
                            <?php } ?>
                            
                            <?php if($strTabType=="orders") { ?>
                                <div class="form-group col-md-6" id="orders">
									<label class="form-control-label">
										<h3>Orders</h3>
									</label>
                                </div>
                                            <?php 
                                            $request = new LazopRequest('/orders/get','GET');
                                            $request->addApiParam('created_after','2020-01-01T00:00:00+0800');
                                            $arrResults = $c->execute($request, $accessToken);
                                            $arrayOrdersData = json_decode($arrResults, true);
                                            echo "<pre>ALL ORDER:";print_r($arrayOrdersData);echo "</pre>";//exit;
                                            ?>
                            <?php } ?>

                        </div>
                <?php } ?>
                
            <?php 
                } else {
                    unset($_SESSION["category_id"]);
                    unset($_SESSION["brand"]);
                    unset($_SESSION["skus"]);
                    unset($_SESSION["lazada_access_token"]);
                } 
            ?>
        </div>
    </div>
</div>


<!--<div class="card">-->
<!--    <div class="card-body">-->
<!--        <div class="box-body text-center">-->
<!--            <h3>References</h3>-->
<!--            <div>API Documentations:<a href="https://open.lazada.com/doc/api.htm#/api?cid=5&path=/product/create" target="_blank">https://open.lazada.com/doc/api.htm#/api?cid=5&path=/product/create</a></div>-->
<!--            <div>Link to Synced Product:https://www.lazada.com.my/products/<em>UNIQUE_ID</em>.html</div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<script type="text/javascript">
    <?php if($strTabType=="" || $strTabType=="category") { ?>
        openCity('category')
    <?php } else if($strTabType=="brands") { ?>
        openCity('brands')
    <?php } else if($strTabType=="prodlist") { ?>
        openCity('prodlist')
    <?php } else if($strTabType=="addprod") { ?>
        openCity('addprod')
    <?php } else if($strTabType=="proddetail") { ?>
        openCity('proddetail')
    <?php } else if($strTabType=="delprods") { ?>
        openCity('delprods')
    <?php } else if($strTabType=="orders") { ?>
        openCity('orders')
    <?php } ?>
</script>
                                            
@endsection