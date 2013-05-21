<div id="register" class="step2">
	<h2 class="subtitle"><?php __('SanDisk Channel Services Network Registration') ?></h2>
	<p>
		<b><?php __('Step two') ?></b>:
		<?php __('Please tell us a little more about you and your company so that we can provide the necessary services you need to best support your needs.'); ?>
		<?php __('Please note all information is confidential and will not be shared with third party agencies.'); ?>
	</p>
	<?php echo $session->flash() ?>
	<div class="box clearfix">
		<h1><?php __('Registration') ?></h1>
		<?php echo $form->create('User', array('url' => array('controller' => 'users', 'action' => 'step2', $id, $hash))) ?>
		<div class="theinputs">
			<?php
			if ($user['User']['mobile']) {
				echo $this->element('form_register_mobile');
			} else {
				echo  $this->element('form_register_sar');
			}
			?>
			<div id="tos"><div id="tos2">
				<?php
				echo $form->input('receive_newsletter', array(
					'label' => __('Click to subscribe to SanDisk News, Promos, and Special Communications', true),
					'checked' => true,
				)) ?>
				<div class="tos html_text">
					<div id="insideTos">
					<?php echo $tos['Text']['text'] ?>
					</div>
				</div>
				<?php echo $form->input('accept', array(
					'label' => __('Accept Terms of Use', true), 'type' => 'checkbox',
					'error' => __('You must read and accept terms and conditions in order to submit', true),
				)) ?>
			</div></div>
			<?php echo $form->submit(__('Submit', true)) ?>
		</div>
		<?php echo $form->end() ?>
	</div>
</div>