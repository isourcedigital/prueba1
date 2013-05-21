<!--panel options-->
	
		<div id="panelOptions" data-theme="c">
		<div class="clear">
		</div>
		<div class="contenedorBlogMore custom">
			<p class="margin40">Settings</p>
			<div class="clear">
			</div>
			
			<?php 
			$b=1;
			foreach ($blogs_users as $blog){
			?>
			<div class="blogMore">
				<p><span>></span><?php echo $blog["Blog"]["name"];?></p>
				<div class="customFieldcontain">
					<fieldset data-role="controlgroup" data-type="horizontal" data-mini="true" data-inline="true">
						<input type="radio" name="blog<?php echo $b;?>" id="on_blog<?php echo $b;?>" value="on" <?php if($blog["Blog"]["status"]==1){?> checked="checked" <?php }?>>
						<label for="on_blog<?php echo $b;?>" name="blog_<?php echo $blog["Blog"]["id"];?>" class="rcb">on</label>
						<input type="radio" name="blog<?php echo $b;?>" id="off_blog<?php echo $b;?>" value="off" <?php if($blog["Blog"]["status"]==0){?> checked="checked" <?php }?>>
						<label for="off_blog<?php echo $b;?>" name="blog_<?php echo $blog["Blog"]["id"];?>" class="rcb">off</label>
					</fieldset>
				</div>
			</div>
			<div class="clear"></div>
			<?php 
			$b++;
			}
			?>
			
		</div>
		</div>
	
	<!--panel options-->
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
		$(".rcb").each(function(){
			$(this).live("click",function(){	
		var id=$(this).attr("name").split("_");
		var onof=$(this).attr("for").split("_");
		id=parseInt(id[1]);
		onof=onof[0];
		if(onof=="on"){
			onof=1;
		}else{
			onof=0;
		}		
		$.ajax({ type: "POST", url: '<?php echo $this->webroot;?>blogs/ubusers/'+id+'/'+onof,success: 
			function(html){
				
	  		}
		});
			});
	})
});
</script>