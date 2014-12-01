<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link rel="stylesheet" href="../jquery/jquery.mobile-1.4.2.min.css"/>
<script src="../jquery/jquery-2.0.2.js"></script>
<script src="../jquery/jquery.mobile-1.4.2.min.js"></script>
</head>
<body>
<form  action="http://1.popye.sinaapp.com/phtml/book.php" method="post">
   <div data-role="page">
           <div data-role="header">
             <h1>藏书检阅</h1>
           </div>
           <div data-role="content">
          <fieldset data-role="fieldcontain">
         <select name="find">
         <option value="word">书名</option>
         <option value="keyword">主题词</option>
         <option value="aurthor">责任者</option>
         <option value="publishshop">出版社</option>
         <option value="number">索书号</option>
        </select>
      </fieldset>
      <input type="text" name="content" >   
      <input type="submit" value="提交" style="background-color:#03F"/>
           </div>
           <div data-role="footer">
           </div>
   </div >  
   </form>

</body>
</html>
