<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="refresh" content="300">
	<title>Lazada Oauth Code</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
	<link href="./css/bootstrap-iso.css" rel="stylesheet">
</head>

<body>
	<div id="container" class="cls-container" style="text-align:center;">
		<div class="cls-content bootstrap-iso">
			<div class="cls-content-sm panel panel-colorful panel-login" style="margin-top: 50px !important;">
				<div class="panel-body">
                    <hr class="hr-log">
					<p class="pad-btm">Your Lazada Oauth Code</p>
                    <div class="row">
                    	<div class="col-xs-3">&nbsp;</div>
                        <div class="col-xs-6" style="text-align:center;">
                            <input type="text" name="email" class="form-control" placeholder="Lazada Oauth Code" readonly="readonly" value="<?php echo (isset($_REQUEST["code"])?$_REQUEST["code"]:""); ?>" style="cursor:text;" />
                            <br />
                            <strong>Copy the Lazada Code above and paste in the Lazada auth Sync.</strong>
                        </div>
                    	<div class="col-xs-3">&nbsp;</div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <button>
                                    <a href="javascript:window.close();">Close</a>
                                </button>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
