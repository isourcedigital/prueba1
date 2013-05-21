<!--footer:este bloque se repite en todos los P-->
					<div class="ui-footer ui-bar-none" data-theme="none" id="boxFooter" >
						<!--<div class="contenti footerMargin">
							<div style="margin-right:8px; float:left;">
								<a href="#panelOptions" data-rel="popup" data-position-to="window" data-transition="pop">
									<img src="images/app_18.jpg">
								</a>
							</div>
							<div style="text-align:center;" id="cantidad">
							</div>
							<div style="float: right;margin-top: -25px;">
								<a href="#popupAdd" data-rel="popup" class="button" data-position-to="window" data-transition="pop">ADD<img src="images/mas.png" height="29" width="29" alt="arrow" style="float: right;margin-top: -2px;margin-left: 5px;"></a>
							</div>		
				
						</div>-->
                        <div style="border-top:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC; z-index:501;">
                            <img src="images/footerRefresh.gif" width="54px" style="float:left; margin-left:10px;" />
                            <a href="#popupAdd" data-rel="popup" data-position-to="window" data-transition="pop"><img src="images/footerAdd.gif" width="120px" style="float:left; margin-left:250px;" /></a>
                            <!--<a href="#panelOptions" data-rel="popup" data-position-to="window" data-transition="pop"><img src="images/footerSettings.gif" width="59px" style="float:left; margin-left:250px;" /></a>-->
                            <?php if(!empty($authUser)){?>
                            <a href="javascript:void(0);" onclick="Shadowbox.open({ content: '<?php echo $this->webroot;?>blogs/busers/<?php echo $authUser["id"];?>', width: 400, height: 630, player:'iframe', options: {onClose:function(){$.cargarblogUser();}} }); return false;" ><img src="images/footerSettings.gif" width="59px" style="float:left; margin-left:250px;" /></a>
                            <?php }else{?>
                            <a href="javascript:void(0);" onclick="Shadowbox.open({ content: '<?php echo $this->webroot;?>users/login', width: 400, height: 430, player:'iframe' }); return false;" ><img src="images/footerSettings.gif" width="59px" style="float:left; margin-left:250px;" /></a>
                            <?php }?>
                            <br style="clear:both;" />
                        </div>
                    </div>
					<!--footer-->