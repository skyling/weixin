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
<form  action="http://1.popye.sinaapp.com/phtml/newbooks.php" method="post">
   <div data-role="page">
           <div data-role="header">
             <h1>新书通告</h1>
           </div>
           <div data-role="content">
          <fieldset data-role="fieldcontain">
         <select name="newbook">
         <option value="">新书类型选择</option>
         <option value="A">A 马列主义、毛泽东思想、邓小平理论</option>
         <option value="B">B 哲学、宗教</option>
         <option value="C">C 社会科学总论</option>
         <option value="D">D 政治、法律</option>
         <option value="E">E 军事</option>
         <option value="F">F 经济</option>
         <option value="G">G 文化、科学、教育、体育</option>
         <option value="H">H 语言、文字</option>
         <option value="I">H 语言、文字</option>
         <option value="J">J 艺术</option>
         <option value="K">K 历史、地理</option>
         <option value="N">N 自然科学总论</option>
         <option value="O">O 数理科学与化学</option>
         <option value="P">P 天文学、地球科学</option>
         <option value="Q">Q 生物科学</option>
         <option value="R">R 医药、卫生</option>
         <option value="S">S 农业科学</option>
         <option value="T">T 工业技术</option>
         <option value="U">U 交通运输</option>
         <option value="V">V 航空、航天</option>
         <option value="X">X 环境科学,安全科学</option>
         <option value="Z">Z 综合性图书</option>     
        </select>
      </fieldset>  
      <input type="submit" value="查询新书" style="background-color:#03F"/>
           </div>
           
           <div data-role="footer">
           </div>
   </div >  
   </form>

</body>
</html>
