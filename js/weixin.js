function onBridgeReady(){
	document.addEventListener('WeixinJSBridgeReady', function onBridgeReady()
	{  WeixinJSBridge.call('hideToolbar');
	});
}
onBridgeReady();