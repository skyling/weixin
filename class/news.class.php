<?php
   class NEWS
   {
   	
   	   function make_news()
   	   {
	   	   	$url = "http://lib.hnist.cn/";
	   	   	$content = file_get_contents( $url);
	   	   	if( $content )
	   	   	{
		   	   		$array = explode('<ul>', $content);
		   	   		 $new=explode('<li>', $array[5]);
		   	   		for($i=0;$i<count($new)-1;$i++)
		   	   		{
			   	   		$new[$i]=str_replace("<span>","",$new[$i]);
			   	   		$new[$i]=str_replace("</span>","",$new[$i]);
			   	   		$new[$i]=str_replace("</li>","",$new[$i]);
		   	   		}
		   	   		    $content='';
		   	   		for($i=0;$i<count($new)-1;$i++)
		   	   		{
		   	   		    $content.=$new[$i]."\n";
		   	   		}
	   	   	
	   	   	}
	   	   	
	   	   return $content;
   	   	
   	   }
   	
   	
   	
   	
   	
   }

?>