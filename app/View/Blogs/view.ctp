<?php 
$url=$blog["Blog"]["url"];
$id=$blog["Blog"]["id"];
$cache='';
class LectorRSS {
	var $url;
	var $data;
	function LectorRSS ($url){
		$this->url;
		$this->data = implode ("", file ($url));
	}
	function obtener_items (){
		preg_match_all ("/<item .*>.*<\/item>/xsmUi", $this->data, $matches);
		$items = array ();
		foreach ($matches[0] as $match){
			$items[] = new RssItem ($match);
		}
		return $items;
	}
}
class RssItem {
	var $title, $url,$excerpt, $description,$totalcomments,$fecha,$guid,$urlrsscomment;
	function RssItem ($xml){
		$this->populate ($xml);
	}
	function populate ($xml){
		preg_match ("/<title> (.*) <\/title>/xsmUi", $xml, $matches);
		@$this->title = $matches[1];
		preg_match ("/<link> (.*) <\/link>/xsmUi", $xml, $matches);
		@$this->url = $matches[1];
		preg_match ("/<content:encoded> (.*) <\/content:encoded>/xsmUi", $xml, $matches);
		@$this->description = $matches[1];
		preg_match ("/<description> (.*) <\/description>/xsmUi", $xml, $matches);
		@$this->excerpt = $matches[1];
		preg_match ("/<slash:comments> (.*) <\/slash:comments>/xsmUi", $xml, $matches);
		@$this->totalcomments = $matches[1];
		preg_match ("/<pubDate> (.*) <\/pubDate>/xsmUi", $xml, $matches);
		@$this->fecha = $matches[1];
		
		preg_match ('/<guid\sisPermaLink="false"> (.*) <\/guid>/xsmUi', $xml, $matches);
		@$this->guid = $matches[1];
		
		preg_match ('/<wfw:commentRss> (.*) <\/wfw:commentRss>/xsmUi', $xml, $matches);
		@$this->urlrsscomment = $matches[1];
		
		


	}
	function obtener_fecha (){
		$originalDate = $this->fecha;
		$newDate = date("m-d-Y", strtotime($originalDate));
		return $newDate;
	}
	function obtener_totalcomments (){
		return $this->totalcomments;
	}
	function obtener_titulo (){
		return $this->title;
	}
	function obtener_url (){
		return $this->url;
	}
	function obtener_description (){

		return htmlspecialchars_decode(str_replace("]]>", "", str_replace("<![CDATA[", "", $this->description)));
	}
	function obtener_excerpt (){
		//return str_replace("]]>", "", str_replace("<![CDATA[", "", $this->excerpt));
		return htmlspecialchars_decode(str_replace("]]>", "", str_replace("<![CDATA[", "", $this->excerpt)));
	}
	function obtener_guid (){
		return $this->guid;
	}
	function obtener_urlrsscomment (){
		return $this->urlrsscomment;
	}
	
}

function myTruncate($string, $limit, $break=".", $pad="...") {
	// return with no change if string is shorter than $limit
	if(strlen($string) <= $limit)
		return $string;
	// is $break present between $limit and the end of the string?
	if(false !== ($breakpoint = strpos($string, $break, $limit))) {
		if($breakpoint < strlen($string)-1) {
			$string = substr($string, 0, $breakpoint) . $pad;
		}
	}
	return $string;
}

function getCache($url,$path,$id){
	$RSS = new LectorRSS ($url);
	$c_page1=0;
	$c_page1_item=0;
	$c_page2=0;
	$c_page2_item=0;
	$c_page3=0;
	$c_page3_item=0;
	$c_page4=0;
	$c_page4_item=0;
	$iteradorRSS=$RSS->obtener_items ();
	$cantItem=sizeof($iteradorRSS);
	$totItem=0;
	$arrayItem=null;
	$cache='';
	foreach ( $iteradorRSS as $item){
		$totItem++;
		$titleItem=$item->obtener_titulo();
		
		$contentItemImg=$item->obtener_description();
		$contentItem=strip_tags(eregi_replace('<img[^>]*>','',$contentItemImg));
		
		$excerpItem=strip_tags(eregi_replace('<img[^>]*>','',$item->obtener_excerpt()));
		$totalComments=$item->obtener_totalcomments();
		$fechaItem=$item->obtener_fecha();
		$guidItem=$item->obtener_guid();
		$urlrsscommentItem=$item->obtener_urlrsscomment();
		$src='';
		$imgItem='';
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $contentItemImg, $src);
	
		$first_img = @$src [1] [0];
	
	
		// no image found display default image instead
		if(!empty($first_img)){
			$imgItem1='<img src='.$first_img.' class="imagenNotaPrincipal" height="338" width="723" />';
			$imgItem2='<img src="'.$first_img.'" height="178" width="333" />';
			$imgItem3='<img src="'.$first_img.'" height="177" width="332" />';
			$imgItem4='<img src="'.$first_img.'" height="319" width="345" />';
			$imgItem5='<img src="'.$first_img.'" height="178" width="333" />';
			$imgItem6='<img src="'.$first_img.'" height="177" width="332" />';
			$imgItem7='<img src="'.$first_img.'" height="178" width="333" />';
			$imgItem8='<img src="'.$first_img.'" height="177" width="332" />';
			$imgItem9='<img src="'.$first_img.'" height="319" width="345" />';
			$imgItemn='<img src="'.$first_img.'" height="178" width="333" />';
		}else{
			$imgItem1='<img src="'.$path.'images/imagenPrincipal.jpg" class="imagenNotaPrincipal" />';
			$imgItem2='<img src="'.$path.'images/imaga2.jpg" height="178" width="333" />';
			$imgItem3='<img src="'.$path.'images/image3.jpg" height="177" width="332" />';
			$imgItem4='<img src="'.$path.'images/imagenDestacada.jpg" />';
			$imgItem5='<img src="'.$path.'images/imaga3.jpg" height="178" width="333" />';
			$imgItem6='<img src="'.$path.'images/image4.jpg" height="177" width="332" />';
			$imgItem7='<img src="'.$path.'images/imaga3.jpg" height="178" width="333" />';
			$imgItem8='<img src="'.$path.'images/image4.jpg" height="177" width="332" />';
			$imgItem9='<img src="'.$path.'images/imagenDestacada.jpg" height="319" width="345" />';
			$imgItemn='<img src="'.$path.'images/imaga2.jpg" height="178" width="333" />';
		}
		$idItem=$id."-".$totItem;
		
		$excerpItemJson=utf8_encode($excerpItem);
		$contentItemJson=utf8_encode($contentItem);
		$arrayItem[]=array(
				'title'=>empty($titleItem)?'s/n':htmlentities( (string) $titleItem, ENT_QUOTES, 'utf-8', FALSE),
				'excerpt'=>$excerpItemJson,
				'description'=>empty($contentItemJson)?$excerpItemJson:$contentItemJson,
				'image'=>empty($imgItem1)?'s/n':$imgItem1,
				'date'=>empty($fechaItem)?'s/n':$fechaItem,
				'totalcomments'=>empty($totalComments)?0:$totalComments,
				'guid'=>$guidItem,
				'urlrsscomment'=>$urlrsscommentItem
		);
	
	
		//echo $imgItem;
		//echo "<a href='".$item->obtener_url()."'><h3>".$item->obtener_titulo()."</h3></a>";
		//echo $excerpItem."<br><br>";
	
		if($c_page1<3){
			$c_page1++;
			$c_page1_item++;
			if($c_page1==1){
				$cache.= '<div class="p" id="blog1-page1"><div class="contenedorNotas" id="blog">';
			}
			if($c_page1_item==1){
				$cache.= '
				<a href="'.$path.'blogs/detalle/'.$idItem.'" data-transition="pop" id="testPop">
				<div class="notaPrincipal">
				<div class="imagen">
				'.$imgItem1.'
				<div class="titulo">
				'.$titleItem.'
				</div>
				<div class="contentFechaComent">
				<div class="fecha">
				<img src="'.$path.'images/calendar.png" alt="calendar">
				<p>'.$fechaItem.'</p>
				</div>
				<div class="coment">
				<img src="'.$path.'images/coments.png" alt="comenta">
				<p>'.$totalComments.' comments</p>
				</div>
				</div>
				</div>
				<div class="texto">
				<p>'.$excerpItem.'</p>
				</div>
				</div>
				</a>';
			}
			if($c_page1_item==2){
				$cache.= '
				
				<div class="nota">
				<div class="imagen">
				<p>'.$imgItem2.'</p>
				</div>
	
				<div class="titulo">
				<p><a href="'.$path.'blogs/detalle/'.$idItem.'" data-transition="pop" id="testPop">'.$titleItem.'</a></p>
				</div>
	
				<div class="contentFechaComent">
				<div class="fecha">
				<p><img src="'.$path.'images/calendarGris.png" height="22" width="20" alt="calendarGris"></p>
				<p>'.$fechaItem.'</p>
				</div>
				<div class="coment">
				<p><img src="'.$path.'images/comentGris.png" height="21" width="25" alt="coment"></p>
				<p>'.$totalComments.' comments</p>
				</div>
				</div>
	
				<div class="texto">
				<p>'.myTruncate($excerpItem, 120, $break=" ", $pad="...").'</p>
				</div>
				</div>
				
				';
			}
			if($c_page1_item==3){
				$cache.= '<div class="nota">
				<div class="imagen">
				<p>'.$imgItem3.'</p>
				</div>
				<div class="titulo">
				<p><a href="'.$path.'blogs/detalle/'.$idItem.'" data-transition="pop" id="testPop">'.$titleItem.'</a></p>
				</div>
				<div class="contentFechaComent">
				<div class="fecha">
				<p><img src="'.$path.'images/calendarGris.png" height="22" width="20" alt="calendarGris"></p>
				<p>'.$fechaItem.'</p>
				</div>
				<div class="coment">
				<p><img src="'.$path.'images/comentGris.png" height="21" width="25" alt="coment"></p>
				<p>'.$totalComments.' comments</p>
				</div>
				</div>
				<div class="texto">
				<p>'.myTruncate($excerpItem, 120, $break=" ", $pad="...").'</p>
				</div>
				</div>';
			}
			if($c_page1==3){
				$cache.= '</div></div>';
			}
		}else{
	
			if($c_page2<3){
				$c_page2++;
				$c_page2_item++;
				if($c_page2==1){
					$cache.= '<div class="p" id="blog1-page2"><div class="contenedorNotas" id="blog">';
				}
				if($c_page2_item==1){
					$cache.= '<div class="notaDestacada">
	
					<div class="imagen">
	
					<p>'.$imgItem4.'</p>
	
					</div>
					<div class="titulo">
	
					<p><a href="'.$path.'blogs/detalle/'.$idItem.'" data-transition="pop" id="testPop">'.$titleItem.'</a></p>
	
					</div>
					<div class="contentFechaComent">
					<div class="fecha">
	
					<p><img src="'.$path.'images/calendarGris.png" alt="calendar">
					</p>
					<p>'.$fechaItem.'</p>
	
					</div>
					<div class="coment">
	
					<p><img src="'.$path.'images/comentGris.png" height="21" width="25" alt="comenta">
					</p>
					<p>'.$totalComments.' comments</p>
	
					</div>
					</div>
					<div class="texto">
	
					<p>'.myTruncate($excerpItem, 400, $break=" ", $pad="...").'</p>
	
					</div>
	
	
					</div>';
				}
				if($c_page2_item==2){
					$cache.= '<div class="nota">
					<div class="imagen">
	
					<p>'.$imgItem5.'</p>
	
					</div>
					<div class="titulo">
	
					<p><a href="'.$path.'blogs/detalle/'.$idItem.'" data-transition="pop" id="testPop">'.$titleItem.'</a></p>
	
					</div>
					<div class="contentFechaComent">
					<div class="fecha">
	
					<p><img src="'.$path.'images/calendarGris.png" height="22" width="20" alt="calendarGris">
					</p>
					<p>'.$fechaItem.'</p>
	
					</div>
					<div class="coment">
	
					<p><img src="'.$path.'images/comentGris.png" height="21" width="25" alt="coment">
					</p>
					<p>'.$totalComments.' comments</p>
	
					</div>
					</div>
					<div class="texto">
	
					<p>'.myTruncate($excerpItem, 120, $break=" ", $pad="...").'</p>
	
					</div>
					</div>';
				}
				if($c_page2_item==3){
					$cache.= '<div class="nota">
					<div class="imagen">
	
					<p>'.$imgItem6.'</p>
	
					</div>
					<div class="titulo">
	
					<p><a href="'.$path.'blogs/detalle/'.$idItem.'" data-transition="pop" id="testPop">'.$titleItem.'</a></p>
	
					</div>
					<div class="contentFechaComent">
					<div class="fecha">
	
					<p><img src="'.$path.'images/calendarGris.png" height="22" width="20" alt="calendarGris">
					</p>
					<p>'.$fechaItem.'</p>
	
					</div>
					<div class="coment">
	
					<p><img src="'.$path.'images/comentGris.png" height="21" width="25" alt="coment">
					</p>
					<p>'.$totalComments.' comments</p>
	
					</div>
					</div>
					<div class="texto">
	
					<p>'.myTruncate($excerpItem, 120, $break=" ", $pad="...").'</p>
	
					</div>
					</div>';
				}
	
				if($c_page2==3){
					$cache.= '</div></div>';
				}
			}else{
				if($c_page3<3){
					$c_page3++;
					$c_page3_item++;
					if($c_page3==1){
						$cache.= '<div class="p" id="blog1-page3"><div class="contenedorNotas" id="blog">';
					}
					if($c_page3_item==1){
						$cache.= '<div class="nota">
						<div class="imagen">
	
						<p>'.$imgItem7.'</p>
	
						</div>
						<div class="titulo">
	
						<p><a href="'.$path.'blogs/detalle/'.$idItem.'" data-transition="pop" id="testPop">'.$titleItem.'</a></p>
	
						</div>
						<div class="contentFechaComent">
						<div class="fecha">
	
						<p><img src="'.$path.'images/calendarGris.png" height="22" width="20" alt="calendarGris">
						</p>
						<p>'.$fechaItem.'</p>
	
						</div>
						<div class="coment">
	
						<p><img src="'.$path.'images/comentGris.png" height="21" width="25" alt="coment">
						</p>
						<p>'.$totalComments.' comments</p>
	
						</div>
						</div>
						<div class="texto">
	
						<p>'.myTruncate($excerpItem, 120, $break=" ", $pad="...").'</p>
	
						</div>
						</div>';
					}
					if($c_page3_item==2){
						$cache.= '<div class="nota">
						<div class="imagen">
	
						<p>'.$imgItem8.'</p>
	
						</div>
						<div class="titulo">
	
						<p><a href="'.$path.'blogs/detalle/'.$idItem.'" data-transition="pop" id="testPop">'.$titleItem.'</a></p>
	
						</div>
						<div class="contentFechaComent">
						<div class="fecha">
	
						<p><img src="'.$path.'images/calendarGris.png" height="22" width="20" alt="calendarGris">
						</p>
						<p>'.$fechaItem.'</p>
	
						</div>
						<div class="coment">
	
						<p><img src="'.$path.'images/comentGris.png" height="21" width="25" alt="coment">
						</p>
						<p>'.$totalComments.' comments</p>
	
						</div>
						</div>
						<div class="texto">
	
						<p>'.myTruncate($excerpItem, 120, $break=" ", $pad="...").'</p>
	
						</div>
						</div>';
					}
					if($c_page3_item==3){
						$cache.= '<div class="notaDestacada">
	
						<div class="imagen">
	
						<p>'.$imgItem9.'</p>
	
						</div>
						<div class="titulo">
	
						<p><a href="'.$path.'blogs/detalle/'.$idItem.'" data-transition="pop" id="testPop">'.$titleItem.'</a></p>
	
						</div>
						<div class="contentFechaComent">
						<div class="fecha">
	
						<p><img src="'.$path.'images/calendarGris.png" height="21" width="21" alt="calendar">
						</p>
						<p>'.$fechaItem.'</p>
	
						</div>
						<div class="coment">
	
						<p><img src="'.$path.'images/comentGris.png" height="21" width="25" alt="comenta">
						</p>
						<p>'.$totalComments.' comments</p>
	
						</div>
						</div>
						<div class="texto">
	
						<p>'.myTruncate($excerpItem, 400, $break=" ", $pad="...").'</p>
	
						</div>
	
	
						</div>';
					}
					if($c_page3==3){
						$cache.= '</div></div>';
					}
				}else{
					if($c_page4<4){
						$c_page4++;
	
						if($c_page4==1){
							$cache.= '<div class="p" id="blog1-page4"><div class="contenedorNotas" id="blog">';
						}
	
						$cache.= '<div class="nota">
						<div class="imagen">
	
						<p>'.$imgItemn.'</p>
	
						</div>
						<div class="titulo">
	
						<p><a href="'.$path.'blogs/detalle/'.$idItem.'" data-transition="pop" id="testPop">'.$titleItem.'</a></p>
	
						</div>
						<div class="contentFechaComent">
						<div class="fecha">
	
						<p><img src="'.$path.'images/calendarGris.png" height="22" width="20" alt="calendarGris">
						</p>
						<p>'.$fechaItem.'</p>
	
						</div>
						<div class="coment">
	
						<p><img src="'.$path.'images/comentGris.png" height="21" width="25" alt="coment">
						</p>
						<p>'.$totalComments.' comments</p>
	
						</div>
						</div>
						<div class="texto">
	
						<p>'.myTruncate($excerpItem, 120, $break=" ", $pad="...").'</p>
	
						</div>
						</div>';
	
						if($c_page4==4){
							$cache.= '</div></div>';$c_page4=0;
						}else{if($totItem==$cantItem){
							$cache.= '</div></div>';
						}
						}
	
					}//end if $c_page4<4
				}//end if $c_page3<3
			}//end if $c_page2<3
		}//end if $c_page1<3
	
	}
	
	
	$cache='<div class="header" style="position:relative; z-index:11" id="headerBlog">
	<div class="contenti">
	<div class="logo">
	<a href="'.$path.'#home" data-transition="slide" data-direction="reverse"><img src="'.$path.'images/logoInterno.png" alt="kaspersky"></a>
	</div>
	<div class="menu">
	<div class="blogActual">
	<a href="#popupSelcBlog" data-rel="popup" data-transition="slidedown" data-position-to="origin" class="selectMenu">KL Blogs<img src="'.$path.'images/flechita.png" class="flechita"></a>
	</div>
	</div>
	</div>
	</div>
	
	<div data-role="content" data-theme="c">
	<div id="flipBlog1" data-role="flip" data-flip-show-pager="false" data-flip-forward-dir="rtol" data-flip-keyboard-nav="true" data-flip-height="" >'.$cache.'</div>
	</div>
	
	<div data-role="footer" data-theme="c">
	<div class="contenti">
	<div style="width:75%; margin:auto;margin-top: -7px;padding-bottom: 5px;">
	<p>
	<input type="range" name="slider-4" id="slider-4" data-mini="true" min="1"  value="1" />
	</p>
	
	</div>
	</div>
	</div>
	
	
	<div data-role="popup" id="popupSelcBlog" data-theme="d" data-corners="false">
	<ul data-role="listview" data-inset="true" style="min-width:210px;" data-theme="d" data-corners="false" data-icon="false">
	<li><a href="#">BLOG 2</a></li>
	<li><a href="#">BLOG 3</a></li>
	<li><a href="#">BLOG 4</a></li>
	</ul>
	</div>';
	
	return array('cache'=>$cache,'json'=>$arrayItem);
}

$cachename = "../../cache/rss-cache-tmp-".$id.".php";
$cachename1 = "../../cache/json-cache-tmp-".$id.".txt";


if(file_exists($cachename)){
	$now = date("G");
	$time = date("G", filemtime($cachename));
	
	if($time == $now){
		include($cachename);
	}else{
		$cache=getCache($url,$this->webroot,$id);
		if(!empty($cache["cache"]) && !empty($cache["json"])){// asegura de crear la cache con contenido
			file_put_contents($cachename, $cache["cache"]);
			file_put_contents($cachename1, @json_encode($cache["json"]));
		}
		echo $cache["cache"];
		
	}
	
}else{
	
$cache=getCache($url,$this->webroot,$id);		
if(!empty($cache["cache"]) && !empty($cache["json"])){// asegura de crear la cache con contenido
	file_put_contents($cachename, $cache["cache"]);
	file_put_contents($cachename1, @json_encode($cache["json"]));
}

echo $cache["cache"];
}
?>