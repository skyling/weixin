<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport"
	content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link rel="stylesheet" href="/jquery/jquery.mobile-1.4.2.min.css" />
<script src="/jquery/jquery-2.0.2.js"></script>
<script src="/jquery/jquery.mobile-1.4.2.min.js"></script>
</head>
<body>
	<div data-role="page">
		<div data-role="header">
			<h1>新书列表</h1>
		</div>
		<div data-role="content">
		<?PHP
		$type = $_POST ['newbook'];
		if ($type) {
			$mmc = memcache_init ();
			if ($mmc == false)
				echo "mc init failed\n";
			else {
				memcache_set ( $mmc, "type", "$type" );
			}
		} else {
			$mmc = memcache_init ();
			$type = memcache_get ( $mmc, "type" );
		}
		
		$url = "http://lib.hnist.cn:7788/newbook/newbook_rss.php?type=cls&s_doctype=ALL&back_days=15&cls={$type}&loca_code=ALL&clsname=%26%23x519b%3B%26%23x4e8b%3B";
		$fa = file_get_contents ( $url );
		$f = simplexml_load_string ( $fa );
		$book = $f->channel->item;
		?>
		<?php 
		if(count($book)==0)
		{	
			echo "对不起，此类型书籍最近没有新书。";
		    exit();
		
		}
		
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

