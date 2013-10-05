<div class="teams form">
<?php echo $this->Form->create('Team'); ?>
	<fieldset>
		<legend><?php echo __('Edit Team'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('since_date');
		echo $this->Form->input('active');
		echo $this->Form->input('logo');
		echo $this->Form->input('photo');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Team.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Team.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Teams'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Team Memberships'), array('controller' => 'team_memberships', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team Membership'), array('controller' => 'team_memberships', 'action' => 'add')); ?> </li>
	</ul>
</div>
