<?php echo $this->element('backhome') ?>
<div class="clearfix">
	<div id="users-result">
		<?php
		$numbers = $paginator->numbers(array('separator' => ' | ', 'modulus' => 10));
		if ($numbers) {
			$pagination = '<div class="pagination">'
			. $paginator->prev('< ' . __('Previous', true), array('escape' => false)) . ' | '
			. $numbers . ' | '
			. $paginator->next(__('Next', true) . ' >', array('escape' => false)) . '</div>';
		} else {
			$pagination = '<div class="pagination"></div>';
		}
		echo $pagination;
		?>
		<div class="results">
			<h1><?php __('SanDisk Authorized Distributors') ?></h1>
			<?php if (!$users): ?>
				<p><?php __('There are no partners matching your query') ?></p>
			<?php endif ?>
			<?php foreach ($users as $user): ?>
			<div class="table">
				<table>
					<tr>
						<td class="label"><?php __('Company Name') ?></td>
						<td><?php echo $user['User']['company_name'] ?></td>
					</tr>
					<tr>
						<td class="label"><?php __('Address') ?></td>
						<td><?php echo $user['User']['address'] ?></td>
					</tr>
					<tr>
						<td class="label"><?php __('Country') ?></td>
						<td><?php echo $user['Country']['name'] ?></td>
					</tr>
					<tr>
						<td class="label"><?php __('Phone') ?></td>
						<td><?php echo $user['User']['telephone'] ?></td>
					</tr>
					<tr>
						<td class="label"><?php __('Company URL') ?></td>
						<td><a target="_blank" href="<?php echo $user['User']['company_url'] ?>"><?php echo $user['User']['company_url'] ?></a></td>
					</tr>
				</table>
			</div>
			<?php endforeach ?>
		</div>
		<?php echo $pagination ?>
	</div>

	<div id="search-box-results">
	<?php echo $this->element('user/search') ?>
	</div>

</div>