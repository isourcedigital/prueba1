<?php 

	
/*
$idItem=$id."-".$item;

$item=$sessItemRss[$idItem];
*/

$items=file("../../cache/json-cache-tmp-".$id.".txt");
$items=json_decode($items[0]);
$index_item=$item;
$item=$items[$index_item-1];


$arrDescription=explode(" ", $item->description);
$texto1='';
$texto2='';
$p=0;
$h=2;
$q=0;
$sizearr=sizeof($arrDescription);

for($i=0;$i<$sizearr;$i++){
	$q++;
	if($i<220){
		$texto1.=$arrDescription[$i]." ";
	}else{
		$p++;
		if($p==1){
			$texto2.='<div class="p" id="blog1-page'.$h.'"><div class="contenedorNotas"><div class="notaPrincipal"><div class="texto"><p class="colum">';
		}
		$texto2.=$arrDescription[$i]." ";
		if($p==390){
			$p=0;
			$h++;
			$texto2.='</p></div></div></div></div>';
		}else{
			if($q==$sizearr){
				$texto2.='</p></div></div></div></div>';
			}
		}
		
	}
}


?>

<div data-role="page" id="blog1-nota1" class="notaPop">
		<div class="volver">
						<a href="<?php echo $this->webroot?>blogs/view/<?php echo $id;?>" data-transition="pop" data-direction="reverse">
						<img src="<?php echo $this->webroot;?>images/volver.png" height="69" width="69" alt="volver">
						</a>	
		</div>
		
		
		<div data-role="content" data-theme="c">
 			
      <div id="flipBlog2" data-role="flip" data-flip-show-pager="false" data-flip-forward-dir="rtol" data-flip-keyboard-nav="true"  data-flip-height=""  >
			<!--page1-->
			<div class="p" id="blog1-page1">
				<div class="contenedorNotas">
					
					<div class="notaPrincipal">
					
						<div class="imagen">
								<?php echo $item->image;?>
								
						</div>
						<div class="titulo">
									<?php echo $item->title;?>
								</div>
								<div class="contentFechaComent">
									<div class="fecha">
										<img src="<?php echo $this->webroot;?>images/calendarGris.png" alt="calendarGris">
										<p><?php echo $item->date;?></p>
									</div>
									<div class="coment">
										<img src="<?php echo $this->webroot;?>images/comentGris.png"  alt="coments">
										<p><?php echo $item->totalcomments;?> <a href="javascript:void(0);" onclick="Shadowbox.open({ content: '<?php echo $this->webroot;?>blogs/comments/<?php echo $id."-".$index_item;?>', width: 470, height: 360, player:'iframe' }); return false;" >comments</a></p>
									</div>
								</div>
						<div class="texto">
							<p class="colum">
								<?php echo utf8_decode($texto1);?>
							</p>
						</div>
						
					</div>
					
				</div>
			</div>			
			<?php 
			echo utf8_decode($texto2);
			?>				
      </div>
		</div>
		
		<div data-role="footer" data-theme="c">
			<div class="contenti">
				<div style="width:100%; margin:auto; margin-top:10px;">
					<a href="#blog1-page" data-transition="slide" style="float: left; margin-left:10px;">
					<img src="<?php echo $this->webroot;?>images/app_20.png" alt="">
					</a>
					<a href="#blog1-page" data-transition="slide" style="float: right; margin-right:10px;">
					<img src="<?php echo $this->webroot;?>images/app_18-03.png"  alt="">
					</a>
					<a href="#blog1-page" data-transition="slide" style="float: right; margin-right:5px;">
					<img src="<?php echo $this->webroot;?>images/app_18.png"  alt="">
					</a>
				</div>
			</div>
		</div>
		
	
		 
</div>
