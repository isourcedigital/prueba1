<?php 
class LectorRSSDate {
	var $url;
	var $data;
	function LectorRSSDate ($url){
		$this->url;
		$this->data = implode ("", file ($url));
	}
	function obtener_lastBuildDate (){
		preg_match_all ("/<lastBuildDate .*>.*<\/lastBuildDate>/xsmUi", $this->data, $matches);
		//preg_match ("/<lastBuildDate> (.*) <\/lastBuildDate>/xsmUi", $this->data, $matches);
		return $matches[0];
	}
}

function ordenar( $a, $b ) {
	return strtotime($b['update']) - strtotime($a['update']);
}

$arrBlogs=null;

foreach ($blogs_kl as $blog_kl):
$id=$blog_kl['Blog']['id'];
$name=$blog_kl['Blog']['name'];
$url=$blog_kl['Blog']['url'];
$img=$blog_kl['BrwImage']['main']['sizes']['1024_1024'];
$fixed=$blog_kl['Blog']['fixed'];
if($fixed==0){
	/*
	 * descomentar aqui
	$RSS = new LectorRSSDate ($url);
	$dateUpdate=str_replace("<lastBuildDate>", "", $RSS->obtener_lastBuildDate ());
	$dateUpdate=str_replace("</lastBuildDate>", "", $dateUpdate);
	*/
	$arrBlogs[]=array(
			'id'=>$id,
			'name'=>$name,
			'url'=>$url,
			'img'=>$img,
			/*'update'=>date("d-m-Y", strtotime($dateUpdate[0]))* descomentar aqui*/
			);
}
endforeach;
//* descomentar aqui usort($arrBlogs, 'ordenar');


?>
  
<div class="ui-grid-b">
	<?php 
		$blog1=1;
		//foreach ($blogs_kl as $blog_kl):
		foreach ($arrBlogs as $blog_kl):
			$id=$blog_kl['id'];
			$name=$blog_kl['name'];
			
			
	?>
	<?php if($blog1==1){?>
	
	<div class="bloque1 blog" id="blog1" style="position:relative; width:493px!important; overflow:hidden;">							
							<a href="<?php echo $this->webroot?>blogs/view/<?php echo $id;?>" data-transition="slide" id="blogkl-<?php echo $id;?>">
								<div class="bloque">
									<img src="<?php echo $blog_kl['img'];?>" width="600px" height="493px" style="min-width:600px;">
								</div>
                                <div style="position:absolute; margin:-70px 0px 0px 30px; width:100%;">
                                    <div style="position:absolute; margin:-2px 0px 0px 40px; padding:0px 10px 0px 10px; height:40px; line-height:40px; font-size:30px; font-weight:bold; background-color:#1F6F55; opacity:0.7;">
                                        <?php echo $name;?>
                                    </div>
                                    <div style="position:absolute; margin:-2px 0px 0px 40px; padding:0px 10px 0px 10px; height:40px; line-height:40px; font-size:30px; font-weight:bold; color:#FFFFFF;">
                                        <?php echo $name;?>
                                    </div>
                                    <img src="<?php echo $this->webroot?>images/indexArrow.gif" style="float:left; width:38px!important;" />
                                </div>
							</a>
						</div>
						
	
	<?php }else{
			if($blog1==2){//get blog fixed
				?>
				<div class="bloqueNuevo blog" id="blog3" style="width:242px!important; overflow:hidden;">
							<a href="<?php echo $this->webroot?>blogs/view/<?php echo $id;?>" data-transition="slide" id="blogkl-<?php echo $blogs_fixed['Blog']['id'];?>">
								<div class="bloque">
									<!--  <img src="<?php echo $blogs_fixed['BrwImage']['main']['sizes']['1024_1024'];?>" width="310px" height="242px" style="min-width:310px;">-->
									<img src="<?php echo $blog_kl['img'];?>" width="310px" height="242px" style="min-width:310px;">
								</div>
							</a>
						</div>
						
						
				
				
				
				<?php 
			}else{
				if($blog1==3){ echo '<div class="clear"></div>';}
		?>

		<div class="bloqueNuevo blog" id="blog3" style="width:242px!important; overflow:hidden;">
							<a href="<?php echo $this->webroot?>blogs/view/<?php echo $id;?>" data-transition="slide" id="blogkl-<?php echo $id;?>">
								<div class="bloque">
									<img src="<?php echo $blog_kl['img'];?>" width="310px" height="242px" style="min-width:310px;">
								</div>
							</a>
						</div>
						
						
		
	
		<?php }//end blog fixed?>
	<?php }?>
	<?php 
	$blog1++;
	endforeach;	
	
	
	
	?>
	<div class="clear"></div>
</div>

<!--
					<div class="ui-grid-b">
						<div class="bloque1 blog" id="blog1" style="position:relative; width:493px!important; overflow:hidden;">
							<a href="#blog1-page" data-transition="slide">
								<div class="bloque">
									<img src="images/articleBig0.jpg" width="600px" height="493px" style="min-width:600px;">
								</div>
                                <div style="position:absolute; margin:-70px 0px 0px 30px; width:100%;">
                                    <div style="position:absolute; margin:-2px 0px 0px 40px; padding:0px 10px 0px 10px; height:40px; line-height:40px; font-size:30px; font-weight:bold; background-color:#1F6F55; opacity:0.7;">
                                        ROCKET LUNCH ARTICLE
                                    </div>
                                    <div style="position:absolute; margin:-2px 0px 0px 40px; padding:0px 10px 0px 10px; height:40px; line-height:40px; font-size:30px; font-weight:bold; color:#FFFFFF;">
                                        ROCKET LUNCH ARTICLE
                                    </div>
                                    <img src="images/indexArrow.gif" style="float:left; width:38px!important;" />
                                </div>
							</a>
						</div>
						<div class="bloqueNuevo blog" id="blog3" style="width:242px!important; overflow:hidden;">
							<a href="#blog3-page" data-transition="slide" id="pinchTest">
								<div class="bloque">
									<img src="images/articleBig1.jpg" width="310px" height="242px" style="min-width:310px;">
								</div>
							</a>
						</div>
						<div class="bloqueNuevo blog" id="blog4" style="width:242px!important; overflow:hidden;">
							<a href="#blog4-page" data-transition="slide">
								<div class="bloque">
									<img src="images/articleBig2.jpg" width="310px" height="242px" style="min-width:310px;">
								</div>
							</a>
						</div>
						<div class="clear"></div>
						<div class="bloqueNuevo blog" id="blog4" style="width:242px!important; overflow:hidden;">
							<a href="#blog4-page" data-transition="slide">
								<div class="bloque">
									<img src="images/articleBig3.jpg" width="310px" height="242px" style="min-width:310px;">
								</div>
							</a>
						</div>
						<div class="bloqueNuevo blog" id="blog3" style="width:242px!important; overflow:hidden;">
							<a href="#blog3-page" data-transition="slide" id="pinchTest">
								<div class="bloque">
									<img src="images/articleBig4.jpg" width="310px" height="242px" style="min-width:310px;">
								</div>
							</a>
						</div>
						<div class="bloqueNuevo blog" id="blog3" style="width:242px!important; overflow:hidden;">
							<a href="#blog3-page" data-transition="slide" id="pinchTest">
								<div class="bloque">
									<img src="images/articleBig5.jpg" width="310px" height="242px" style="min-width:310px;">
								</div>
							</a>
						</div>
					</div>
-->