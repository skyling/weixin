<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<link rel="stylesheet" href="../jquery/jquery.mobile-1.4.2.min.css"/>
<script src="../jquery/jquery-2.0.2.js"></script>
<script src="../jquery/jquery.mobile-1.4.2.min.js"></script>
<script type="text/javascript">

function onBridgeReady(){
	document.addEventListener('WeixinJSBridgeReady', function onBridgeReady()
	{  WeixinJSBridge.call('hideToolbar');
	});
}

if (typeof WeixinJSBridge == "undefined"){
	if( document.addEventListener ){
		document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
	}else if (document.attachEvent){
		document.attachEvent('WeixinJSBridgeReady', onBridgeReady);
		document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
	}
}else{
	onBridgeReady();
}

</script>
<script src="../js/weixin.js"></script>
</head>
<body>
<?php 
$openid=$_GET['openid'];
?>
<!-- <form action="http://lib.hnist.cn:7788/reader/redr_verify.php" method="post"> -->
<form action="tie_check.php" method="post">
   <div data-role="page">
           <div data-role="header">
             <h1>绑定账号</h1>
           </div> 
           <div data-role="content">
           <p>一卡通号:</p>
		   <input type="text" name="number" />
		   <p>密码:</p> 
		   <input type="password" name="passwd" />
		   <input type="hidden" name="select" value="cert_no" checked="checked" />  
		   <input type="hidden" name="returnUrl" value="" />
		   <input type="hidden" name="openid" value="<?=$openid ?>" >
		   <input type="submit" value="绑定" name="keep" style="background-color:#03F"/>
           </div>
           <div data-role="footer">
           </div>
   </div >
   </form>

</body>
</html>
