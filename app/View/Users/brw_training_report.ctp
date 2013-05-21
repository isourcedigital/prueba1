<div class="report">
	<div class="index clearfix">
		<h2><?php __('Individual Training Report'); ?></h2>
		<?php if (!empty($this->params['named'])): ?>
		<div class="actions">
			<ul>
				<li class="export"><a href="<?php echo Router::url(
					array('action' => 'training_report_export')	+ $this->params['named']
				); ?>">Export</a></li>
				<li class="save_query"><a class="save_query" href="<?php echo Router::url(
					array('action' => 'redirect_save_query_from_trainings') + $this->params['named']
				); ?>">Save this Query</a></li>
			</ul>
		</div>
		<?php endif ?>
	</div>
	<?php echo $form->create('User', array(
		'class' => 'filter clearfix',
		'inputDefaults' => array('separator' => ' '),
	)) ?>
		<fieldset>
			<legend>User:</legend>
			<?php
			echo $form->input('User.user_type_id', array('empty' => '- All'));
			echo $form->input('User.country_id', array('empty' => '- All'));
			echo $form->input('User.company_type_id', array('empty' => '- All'));
			echo $form->input('User.carrier_id', array('empty' => '- All'));
			echo $form->input('User.dealer_id', array('empty' => '- All', 'label' => 'Agent name'));
			?>
		</fieldset>
		<fieldset>
			<legend>Training:</legend>
			<?php
			echo $form->input('result', array(
				'options' => array(1 => 'approved', 2 => 'disapproved', 3 => 'pending'),
			));
			echo $form->input('training_id', array('type' => 'select'));
			$params = array('type' => 'date', 'minYear' => 2008, 'maxYear' => date('Y'), 'empty' => '-');
			echo $form->input('taken_from', $params);
			echo $form->input('taken_to', $params);
			?>
		</fieldset>
	<?php echo $form->end('Search') ?>
	<?php if ($this->params['named']):?>
		<?php if (!empty($rows)):?>
		<p class="counter"><?php echo count($rows) ?> results</p>
		<table id="index">
			<tr>
				<th class="string">User Id</th>
				<th class="string">Name</th>
				<th class="string">Last Name</th>
				<th class="string">User Type</th>
				<th class="string">Company Name</th>
				<th class="string">Country</th>
				<th class="string">Training</th>
				<th class="string">Taken</th>
				<th class="string">Status</th>
			</tr>
			<?php foreach ($rows as $row): ?>
			<tr>
				<td class="field"><?php echo $row['user_id']?></td>
				<td class="field"><?php echo $row['name']?></td>
				<td class="field"><?php echo $row['last_name'] ?></td>
				<td class="field"><?php echo $row['user_type'] ?></td>
				<td class="field"><?php echo $row['company_name'] ?></td>
				<td class="field"><?php echo $row['country'] ?></td>
				<td class="field"><?php echo $row['training'] ?></td>
				<td class="field"><?php echo ($row['taken']) ? date('M.d.Y h:i', strtotime($row['taken'])) : ''; ?></td>
				<td class="field"><?php echo $row['approved'] ?></td>
			</tr>
			<?php endforeach ?>
		</table>
		<?php else: ?>
		<p class="norecords">There are no training results matching your search query</p>
		<?php endif ?>
	<?php endif ?>
</div>