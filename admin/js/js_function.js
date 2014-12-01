//根据浏览器类型创建ajax引擎对象
function ajaxFunction()//1号线
{
	var xmlHttp;
	try{
	    // Firefox, Opera 8.0+, Safari
	    xmlHttp=new XMLHttpRequest();
	}catch (e){
		// Internet Explorer
	    try{
        	xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        }catch (e){
		    try{
		        xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		    }catch (e){
		        alert("您的浏览器不支持AJAX！");
		        return false;
	        }
	    }
    }
    return xmlHttp;
}

//代码缩写，代替document.getElementById(id)
function $(id){
	return document.getElementById(id);
}