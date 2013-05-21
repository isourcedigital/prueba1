<?php 
//header('Content-Type: text/html; charset=UTF-8');
$url=$blog["Blog"]["url"];
$id=$blog["Blog"]["id"];



/*
$cachename = "../../cache/rss-cache-tmp-".$id.".php";

if(file_exists($cachename))
{
	
	$now = date("G");
	$time = date("G", filemtime($cachename));
	
	if($time == $now+1)
	{
		include($cachename);
		
	}else{
		include("../../rsslib/rsslib.php");
		$cache = RSS_Display($url, 15, false, true);
		file_put_contents($cachename, $cache);
		echo $cache;
	}
}else{
	include("../../rsslib/rsslib.php");
	$cache = RSS_Display($url, 15, false, true);
	file_put_contents($cachename, $cache);
	echo $cache;	
}
*/
include("../../rsslib/rsslib.php");
$domnodelist = RSS_Display($url, 15, true, true);

$return = array();
for ($i = 0; $i < $domnodelist->length; ++$i) {
	$return[] = $domnodelist->item($i);
}
var_dump($return);