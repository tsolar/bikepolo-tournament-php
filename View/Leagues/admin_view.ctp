<div class="leagues view">
<h2><?php echo __('League'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($league['League']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($league['League']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo h($league['League']['location']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit League'), array('action' => 'edit', $league['League']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete League'), array('action' => 'delete', $league['League']['id']), null, __('Are you sure you want to delete # %s?', $league['League']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Leagues'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New League'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List League Members'), array('controller' => 'league_members', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New League Member'), array('controller' => 'league_members', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tournaments'), array('controller' => 'tournaments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tournament'), array('controller' => 'tournaments', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related League Members'); ?></h3>
	<?php if (!empty($league['LeagueMember'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('League Id'); ?></th>
		<th><?php echo __('Team Id'); ?></th>
		<th><?php echo __('Active'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($league['LeagueMember'] as $leagueMember): ?>
		<tr>
			<td><?php echo $leagueMember['id']; ?></td>
			<td><?php echo $leagueMember['league_id']; ?></td>
			<td><?php echo $leagueMember['team_id']; ?></td>
			<td><?php echo $leagueMember['active']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'league_members', 'action' => 'view', $leagueMember['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'league_members', 'action' => 'edit', $leagueMember['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'league_members', 'action' => 'delete', $leagueMember['id']), null, __('Are you sure you want to delete # %s?', $leagueMember['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New League Member'), array('controller' => 'league_members', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Tournaments'); ?></h3>
	<?php if (!empty($league['Tournament'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('League Id'); ?></th>
		<th><?php echo __('Challonge Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($league['Tournament'] as $tournament): ?>
		<tr>
			<td><?php echo $tournament['id']; ?></td>
			<td><?php echo $tournament['name']; ?></td>
			<td><?php echo $tournament['league_id']; ?></td>
			<td><?php echo $tournament['challonge_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'tournaments', 'action' => 'view', $tournament['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'tournaments', 'action' => 'edit', $tournament['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'tournaments', 'action' => 'delete', $tournament['id']), null, __('Are you sure you want to delete # %s?', $tournament['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Tournament'), array('controller' => 'tournaments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
