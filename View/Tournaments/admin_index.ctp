<div class="tournaments index">
	<h2><?php echo __('Tournaments'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('league_id'); ?></th>
			<th><?php echo $this->Paginator->sort('challonge_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($tournaments as $tournament): ?>
	<tr>
		<td><?php echo h($tournament['Tournament']['id']); ?>&nbsp;</td>
		<td><?php echo h($tournament['Tournament']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($tournament['League']['name'], array('controller' => 'leagues', 'action' => 'view', $tournament['League']['id'])); ?>
		</td>
		<td><?php echo h($tournament['Tournament']['challonge_id']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $tournament['Tournament']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $tournament['Tournament']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $tournament['Tournament']['id']), null, __('Are you sure you want to delete # %s?', $tournament['Tournament']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Tournament'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Leagues'), array('controller' => 'leagues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New League'), array('controller' => 'leagues', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Matches'), array('controller' => 'matches', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Match'), array('controller' => 'matches', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tournament Participants'), array('controller' => 'tournament_participants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tournament Participant'), array('controller' => 'tournament_participants', 'action' => 'add')); ?> </li>
	</ul>
</div>
