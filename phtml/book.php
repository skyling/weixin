<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport"content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link rel="stylesheet" href="/jquery/jquery.mobile-1.4.2.min.css" />
<script src="/jquery/jquery-2.0.2.js"></script>
<script src="/jquery/jquery.mobile-1.4.2.min.js"></script>
</head>
<body>
<?php
$type= $_POST ['find'];
$keyword= $_POST ['content'];
?>
	<div data-role="page">
		<div data-role="header">
			<h1>搜索结果</h1>
		</div>
		<div data-role="content">
<?PHP
		if ($type == "word")
			$url = "http://lib.hnist.cn:7788/opac/search_rss.php?location=ALL&title={$keyword}&doctype=ALL&lang_code=ALL&match_flag=forward&displaypg=20&showmode=list&orderby=DESC&sort=CATA_DATE&onlylendable=yes&with_ebook=&with_ebook=on";
		elseif ($type == "keyword")
			$url = "http://lib.hnist.cn:7788/opac/search_rss.php?dept=ALL&keyword={$keyword}&doctype=ALL&lang_code=ALL&match_flag=forward&displaypg=20&showmode=list&orderby=DESC&sort=CATA_DATE&onlylendable=yes&with_ebook=on&with_ebook=on";
		elseif ($type == "aurthor")
			$url = "http://lib.hnist.cn:7788/opac/search_rss.php?dept=ALL&author={$keyword}&doctype=ALL&lang_code=ALL&match_flag=forward&displaypg=20&showmode=list&orderby=DESC&sort=CATA_DATE&onlylendable=yes&with_ebook=on&with_ebook=on";
		elseif ($type == "publishshop")
			$url = "http://lib.hnist.cn:7788/opac/search_rss.php?dept=ALL&publisher={$keyword}&doctype=ALL&lang_code=ALL&match_flag=forward&displaypg=20&showmode=list&orderby=DESC&sort=CATA_DATE&onlylendable=yes&with_ebook=on&with_ebook=on";
		elseif ($type == "number")
		$url = "http://lib.hnist.cn:7788/opac/search_rss.php?dept=ALL&callno={$keyword}&doctype=ALL&lang_code=ALL&match_flag=forward&displaypg=20&showmode=list&orderby=DESC&sort=CATA_DATE&onlylendable=yes&with_ebook=on&with_ebook=on";
		$fa = @file_get_contents ( $url );
		$f = @simplexml_load_string ( $fa );
		$book = $f->channel->item;
		?>
		<?php for ($i=0;$i<count($book);$i++) {?>
		<?php
			$da1 = $f->channel->item [$i]->title;
			$urll = $f->channel->item [$i]->link;
			$describe = $f->channel->item [$i]->description;
			$describe1 = explode ( " ", $describe );
			$describe = "$describe1[0]" . "<br/>" . "$describe1[1]" . "<br/>" . "$describe1[2]";
			$url2 = substr ( $urll, 0, 19 );
			$url2 .= ":7788";
			$url3 = substr ( $urll, - 33 );
			$url2 .= "$url3";
			?>  		
		  <ul data-role="listview">
		    <?php echo "<br/>";?>
            <li><a href="<?=$url2?>">
            <?=$book[$i]->title?>
            <?php echo "<br/>";?>
            <?php echo "<br/>";?>
            <?=$describe?>
            <?php echo "<br/>";?>
            <?php echo "<br/>";?>
            </a></li>
			</ul>
			</a>
		<?php }?>
	</div>
	</div>
</body>
</html>


