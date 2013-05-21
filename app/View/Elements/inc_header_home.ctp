<!--header:este bloque se repite en todos los P -->
	<div class="ui-header ui-bar-none" data-theme="none">
		<div align="right" style="position:absolute; padding:20px 20px 0px 0px; width:100%; z-index:100;">
			<?php 
			$usr=$fc->getUser();
			if(!empty($usr)){
				//debug($usr);
			}
			?>
			<?php if(!empty($authUser)){?>
			<div style="padding:10px 20px 0px 0px;">
				&nbsp; &nbsp; &nbsp; &nbsp; Welcome: <?php echo $authUser["email"];?>
				
				<a href="<?php echo $this->webroot?>users/logout">Logout</a>
			</div>
			<?php }else{?>
			<div style="padding:10px 20px 0px 0px;">
				&nbsp; &nbsp; &nbsp; &nbsp; Existing account?
				<br />
				<!--  <a href="#popLogIn" class="indexSignin" data-rel="popup" data-position-to="window" data-transition="pop">tap to sign in</a>-->
				<!-- LOGIN SIN POPUP<a href="<?php echo $this->webroot;?>users/login" >tap to sign in</a>-->
				<a href="javascript:void(0);" onclick="Shadowbox.open({ content: '<?php echo $this->webroot;?>users/login', width: 400, height: 430, player:'iframe' }); return false;" >tap to sign in</a>
			</div>
			<?php }?>
		</div>
		<div class="logoHome">
			<img src="<?php echo $this->webroot?>images/logo.png" width="250">
		</div>
                        
		<div class="contentTit" id="boxTitContent" style="margin-right:30px;">
			BLOGS &nbsp;
		</div>
	</div>
<!--header-->
					
					