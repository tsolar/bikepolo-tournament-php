<div class="teams view">
	<?php var_dump($team) ?>
<h2><?php echo __('Team'); ?></h2>
	<dl class="dl-horizontal">
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($team['Team']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($team['Team']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Since Date'); ?></dt>
		<dd>
			<?php echo h($team['Team']['since_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($team['Team']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Logo'); ?></dt>
		<dd>
			<?php echo h($team['Team']['logo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($team['Team']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($team['Team']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Team'), array('action' => 'edit', $team['Team']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Team'), array('action' => 'delete', $team['Team']['id']), null, __('Are you sure you want to delete # %s?', $team['Team']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Teams'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Team Memberships'), array('controller' => 'team_memberships', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team Membership'), array('controller' => 'team_memberships', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Team Memberships'); ?></h3>
	<?php if (!empty($team['TeamMembership'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-hover">
	<tr>
		<!--<th><?php echo __('Id'); ?></th>-->
		<th><?php echo __('Player Id'); ?></th>
		<th><?php echo __('Team Id'); ?></th>
		<th><?php echo __('Approved'); ?></th>
		<th><?php echo __('Is Captain'); ?></th>
		<th><?php echo __('Is Admin'); ?></th>
		<th><?php echo __('Join Date'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($team['TeamMembership'] as $teamMembership): ?>
		<tr>
			<!--<td><?php  var_dump($teamMembership)// echo $teamMembership['id']; ?></td>-->
			<td><?php echo $teamMembership['Player']['name']; ?></td>
			<td><?php echo $teamMembership['Team']['name']; ?></td>
			<td><?php echo $teamMembership['approved']; ?></td>
			<td><?php echo $teamMembership['is_captain']; ?></td>
			<td><?php echo $teamMembership['is_admin']; ?></td>
			<td><?php echo $teamMembership['join_date']; ?></td>
			<td><?php echo $teamMembership['created']; ?></td>
			<td><?php echo $teamMembership['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'team_memberships', 'action' => 'view', $teamMembership['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'team_memberships', 'action' => 'edit', $teamMembership['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'team_memberships', 'action' => 'delete', $teamMembership['id']), null, __('Are you sure you want to delete # %s?', $teamMembership['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Team Membership'), array('controller' => 'team_memberships', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
