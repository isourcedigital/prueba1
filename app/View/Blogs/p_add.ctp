<div id="add">	
<?php echo $this->Session->flash(); ?>
	<div class="box clearfix">
		<h1><?php __('Add Blog') ?></h1>
		<?php
		echo $this->Form->create();
		
		?>
		<div class="col">
	<?php
	echo $this->Form->input('name');
	echo $this->Form->input('url');
	?>
	</div>

		<?php		
		echo $this->Form->submit(__('Add', true));
		echo $this->Form->end();
		?>
	</div>

</div>