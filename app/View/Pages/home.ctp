<div style="width:768px; height:1024px;>


<script>
/*
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
*/

</script>

<div id="home" data-role="page">
	
	
	
	
	
	
	<!--flip-->
	
		<div data-role="content" class="contenti" style="padding:0px!important;">		
			<div id="flipBlog1" data-role="flip" data-flip-show-pager="false" data-flip-forward-dir="rtol" data-flip-keyboard-nav="true" data-flip-height="" >
		
		   
			  	<!--page0-->
			 	<?php echo $this->element('inc_bignews');?>
			  	<!--page0-->
			  	
			  	<!--page1-->
			  	<div class="p" id="blog1-page1">			  
			 	<!--header:este bloque se repite en todos los P -->
			 	<?php echo $this->element('inc_header_home');?>
				<!--header-->
				<!--Content-->				
				<?php echo $this->element('inc_content');?>
				<!--Content-->
				<!--footer:este bloque se repite en todos los P-->
				<?php echo $this->element('inc_footer_home');?>
				<!--footer-->
			 	</div>
				<!--page1-->
				
				
				<!--page2-->
				<div class="p" id="blog1-page2">
				<!--header:este bloque se repite en todos los P -->
			 	<?php echo $this->element('inc_header_home');?>
				<!--header-->
				<!--Content-->
				<div class="ui-grid-b" id="blogusers">
				<?php if(!empty($blogs_usr)){// si el usuario tiene blogs se muestran en esta seccion?>
				<?php echo $this->element('inc_content1');?>
				<?php }?>
				</div>
				<!--Content-->
				<!--footer:este bloque se repite en todos los P-->
				<?php echo $this->element('inc_footer_home');?>
				<!--footer-->
			 	</div>	
				<!--page2-->
				
												
			</div>		
	</div>
	
	<!--flip-->
	<!--content-->
	
</div>
<!---blog1-paginas--->
<?php 
$blog_list_content='';
foreach ($blogs_kl as $blog_kl):
$id=$blog_kl['Blog']['id'];
$name=$blog_kl['Blog']['name'];
$blog_list_content.='
<div data-role="page" id="blog'.$id.'-page">

<div class="header" style="position:relative; z-index:11" id="headerBlog">
		<div class="contenti">
			<div class="logo">
				<a href="#home" data-transition="slide" data-direction="reverse"><img src="images/logoInterno.png" alt="kaspersky"></a>	
			</div>		
			<div class="menu">		
				<div class="blogActual">
					<a href="#popupSelcBlog" data-rel="popup" data-transition="slidedown" data-position-to="origin" class="selectMenu">KL Blogs<img src="images/flechita.png" class="flechita"></a>
				</div>
			</div>							
		</div>		
	</div>
	
	<div id="cntblogs'.$id.'"></div>

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
</div>
</div>';
endforeach;
//echo $blog_list_content;
?>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
	<?php if(!empty($authUser)){?>
	$.cargarblogUser = function(){ 
		$.ajax({ type: "POST", url: '<?php echo $this->webroot?>blogs/listbusers/<?php echo $authUser["id"]?>',success: 
			function(html){	
			$("#blogusers").html(html);
			
	  		}
		});		
	}
<?php }?>
	
		$(".blogkltest").on("click", function() {
			var id=$(this).attr("id").split("-");
			id=id[1];

			$.ajax({ type: "POST", url: '/id/klblog1/blogs/view/'+id,success: 
				function(html){	
					
					//$("#blog"+id+"-page").html(html);
				//$("#flipBlog"+id).html(html);
				$("#cntblogs"+id).html(html);
				
				
				//$("#blog"+id+"-page").html(html).page();
				
				
				
		  		}
			});						
			
		});
});
</script>

</div>