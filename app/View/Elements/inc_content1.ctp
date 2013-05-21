<?php 
	$item_blog=0;	
	
	foreach ($blogs_usr as $blog_usr):	
	$id=$blog_usr['Blog']['id'];
	$name=$blog_usr['Blog']['name'];
	$item_blog++;
	echo '<div class="bloqueNuevo blog" id="blog3">
		<a href="#blog3-page" data-transition="slide" id="pinchTest">
		<div class="bloque">
			<img src="images/app_10.jpg">
			<div class="tituloBlog">
				<p>'.$name.'</p>
			</div>
		</div>
		</a>
	</div>';
	if($item_blog==3){
		echo '<div class="clear"></div>';
	}
	endforeach;
	

?>

