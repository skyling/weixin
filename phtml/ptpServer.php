<?php
	$openid = $_GET['openid'];
	setcookie('openid',$openid);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset= utf-8" />
<meta name = "viewport" content="width=device-width,initial-scale=1.0" />
<link href='../jquery/jquery.mobile-1.4.2.min.css' rel = 'stylesheet' type = 'text/css' ></link>
<script type="text/javascript" src="../jquery/jquery-2.0.2.js"></script>
<script type="text/javascript" src="../jquery/jquery.mobile-1.4.2.min.js"></script>
</head> 
<body> 
	<div data-role="page" id="page">
		<div data-role="header">
			<h1>馆际互借一对一服务</h1>
		</div>
		<div data-role="collapsible">
			<h3>文献传递</h3>
				<div data-role="collapsible" data-collapsed="true">
					<h4>登录途径</h4>
					<p>
						</strong>我馆读者数据均已进入CALIS馆际互借系统，读者选择以下任一途径，输入自己的一卡通号码以及密码，即可登录。<br />
						1、直接登录馆际互借系统读者网关地址：<a href="http://ill.hun.calis.edu.cn/gateway/">http://ill.hun.calis.edu.cn/gateway/</a><br />
						2、湖南省高校数字图书馆主页（<a href="http://www.hnadl.cn/">http://www.hnadl.cn/</a>）的 CALIS数字图书馆资源馆际互借系统登录<br />
						3、从CALIS中心门户网站进入（<a href="http://www.calis.edu.cn">http://www.calis.edu.cn</a>），点击高校读者登录，选择湖南省，湖南理工学院登录<br />
						4、在我校图书馆主页（<a href="http://lib.hnist.cn">http://lib.hnist.cn</a>）E读入口检索文献之后，直接提交申请<br />
						5、在外文期刊网（<a href="http://ccc.calis.edu.cn">http://ccc.calis.edu.cn</a>）检索文献之后，直接提交申请<br />
					</p>
				</div>
				<div data-role="collapsible" data-collapsed="true">
					<h4>如何注册馆际互借账户</h4>
					<p>
					第一次登录，系统会提示继续注册新的馆际互借账户，读者只需按照系统页面提示注册，完善自己的信息并提交，账户经馆际互借员确认后即可开始提交申请（馆际互借员在管理系统可以看到新注册的账户信息，一般会主动确认，读者可在注册后再次登录并查看系统留言）。</strong>
					</p>
				</div>
				<div data-role="collapsible" data-collapsed="true">
					<h4>CALIS馆际互借费用说明</h4>
					<p>
					<strong>1、 文献传递<br />
					</strong>a) 一般文献：（如期刊论文、会议论文、图书的部分章节等）<br />
					文献传递收费=复制费+（加急费）<br />
					其中：复制费：￥0.30 元/页（包括复印＋扫描＋普通传递）；<br />
					加急费：10.00 元/篇；<br />
					说明：普通传递包含email 方式、CALIS 文献传递、Ariel 文献传递、平寄、传真和读者自取方式。若挂号、快递方式传递文献，还需加收实际发生的传递费用。<br />
					b) 特殊文献：（如古籍、民国文献、标准、报告等）<br />
					遵循收藏馆收费标准；<br />
					c) 学位论文<br />
					遵循学位论文项目收费标准；<br />
					<strong>2、 代查代检<br />
					</strong>文献传递收费＝实际付出的费用＋代查外馆文献手续费<br />
					其中：实际付出的费用为文献提供馆收取的全部费用。<br />
					代查外馆文献手续费：<br />
					高校系统内文献：2 元/篇<br />
					国内其他文献收藏机构的文献：5 元/篇<br />
					国外高校或文献收藏机构的文献：10 元/篇<br />
					<strong>3、补贴方案<br />
					</strong>全国所有高等院校的读者均可享受CALIS 文献传递补贴，补贴总费用的50%，每笔补贴上限为150 元。<br />
					&nbsp;&nbsp;&nbsp;&nbsp; 至2012年4月30日止，我馆可免除1万元的补贴费用。谁先提出申请，谁就享受全额补贴，补完为止。<br />
					&nbsp;
					<p style="text-align: right">图书馆<br />
					2012-3-14</p>
					</p>
				</div>
				<div data-role="collapsible" data-collapsed="true">
					<h4>关于CALIS应用服务示范馆文献传递服务享受全补贴政策的通知 </h4>
					<p>
					</strong>根据CALIS中心最新通知，每个示范馆将免除总额不超过1万元的文献传递服务费用。我馆是CALIS示范馆之一，至2012年4月30日止，将可免除1万元的文献传递补贴，请全校师生抓紧时机，享受以外文文献为主的文献传递免费服务。具体使用方法，可参考以下资料，也可咨询图书馆信息服务部黄老师（电话8640971-805，V网69325）。
					</p>
				</div>
				<div data-role="collapsible" data-collapsed="true">
					<h4>关于CALIS服务</h4>
					<p>
					</strong>CALIS是中国高等教育文献保障系统（China Academic Library &amp; Information System，CALIS ）的简称，现阶段开设的服务有联合目录、外文期刊网、e读、馆际互借服务、参考咨询服务。<br />
		外文期刊网现有外文期刊10万种（203个馆藏纸本期刊，476个馆购电子期刊，1万余种OA期刊），3.4万种刊的目次，外文全文数据库59个，文摘库11个。读者可以通过直接获取电子全文、本馆纸本馆藏链接、文献传递（馆际互借）、代查代检等途径获得文献。<br />
		e读是CALIS学术搜索引擎，集成成员馆高校所有资源，整合图书馆纸本馆藏、电子馆藏和相关网络资源，使读者在海量的图书馆资源中通过一站式检索，查找所需文献，并能获取全文。e读现有600多家图书馆的丰富馆藏，200多万种图书，3700多万篇外文期刊论文，70多万篇中外文学位论文。<br />
					</p>
				</div>
		</div>
		<div data-role="content">
			<ul data-role="listview">
				<li><a href="http://uas.hun.calis.edu.cn:8090/amconsole/AuthServices?verb=login&goto=http://ill.hun.calis.edu.cn/gateway/Default.aspx">馆际互借</a></li>
			</ul>
			<hr/>
			<p>我有疑问:</p>
			<form action="question.php" method = 'post' name = 'form'>
				<textarea cols="30" rows="10" name="question" ></textarea>
				<br/>
				<input type="submit" name="submit" value="提交" />
			</form>
		</div>
		
		<div data-role="footer">
			<div data-role="navbar">
				<ul>
                    <li><a href="myQuestion.php">我的问题</a></li>
					<li><a href="allQuestion.php">所有问题</a></li>
				</ul>
			</div>
		</div>	
		<!-- <a href="shequ.html" data-rel="dialog">Open dialog</a> -->
	</div>
</body> 
</html> 