<div class="back_home"><a href="<?php echo $html->url(array('controller' => 'texts', 'action' => 'home'))?>">< Back to Home</a></div>
<h1 class="clear">SanDisk Channel Services Network - Retrive Password</h1>
<p class="subject">Insert your Email and we will send your password as soon as posible</p><br><br>
<div id="add_registro">
<p class="tit_arrow">Retrive Password</p>
	<?php echo $form->create() ?>
		<fieldset>
			<table>
				<tr>
					<td>
						<?php echo $form->input('email') ?>
					</td>
				</tr>
				<tr>
					<td align="right" class="separator"><?php echo $html->image('spacer_items_05.png') ?></td>
				</tr>
				<tr>
					<td align="right">
						<div class="submit">
							<input type="submit" value="<?php __('Send');?>"/>
						</div>
					</td>
				</tr>
			</table>
		</fieldset>
	</form>
</div>