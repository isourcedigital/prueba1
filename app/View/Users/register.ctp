<?php 
echo $this->Session->flash(); 
echo $this->Form->create();
?>
<div style="width:400px;">
		<div class="contPop">
			<div align="center" class="tituloPop" style="width:100%; font-size:32px; color:#666666; line-height:60px;">
				<p>Sign Up</p>
			</div>
			<div align="center" style="width:100%; font-size:12px;">
				<p>Are you new? Sign Up</p>
			</div>
			<div class="block">
				<div align="right" style="float:left; margin-right:12px; width:75px!important; height:50px; line-height:50px; color:#666666; font-size:14px;">
					EMAIL
				</div>
				<div style="float:left; margin-right:10px; width:225px!important; height:50px;">
					<?php echo $this->Form->input('email', array('error' => false,'label'=>""));?>
				</div>
				<div align="right" style="float:left; margin-right:12px; width:75px!important; height:50px; line-height:50px; color:#666666; font-size:14px;">
					PASSWORD
				</div>
				<div style="float:left; margin-right:10px; width:225px!important; height:50px;">
					<?php echo $this->Form->input('password', array('error' => false,'label'=>""));?>
				</div>
				<div align="right" style="float:left; margin-right:12px; width:75px!important; height:50px; line-height:50px; color:#666666; font-size:14px;">
					REPASSWORD
				</div>
				<div style="float:left; margin-right:10px; width:225px!important; height:50px;">
					<?php 
					echo $this->Form->input('repeat_password', array('type' => 'password','error' => false,'label'=>""));
					?>
				</div>
				<br style="clear:both;" />
				<div style="margin-left:10px; width:380px!important;">
					<div onclick="document.forms['UserRegisterForm'].submit();" align="center" style="margin:7px 0px 0px 77px; width:225px; height:50px; line-height:50px; background-color:#196D53; color:#FFFFFF;">
						SIGN IN
						
					</div>
				</div>
				<div class="clear">
				</div>
				<div style="float:left; margin-left:86px; font-size:12px; color:#666666; line-height:30px;">
					Do you know our
					<a href="#popSingUp" data-rel="popup" data-position-to="window" data-transition="pop">
						Terms and Conditions
					</a>
					?
				</div>
				<br style="clear:both;" />
			</div>
		</div>
	</div>
<?php echo $this->Form->end();?>