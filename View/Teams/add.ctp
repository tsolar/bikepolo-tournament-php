<div class="teams form">
<?php echo $this->Form->create('Team'); ?>
	<fieldset>
		<legend><?php echo __('Add Team'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('since_date');
		//echo $this->Form->input('active', array('checked'=>true)); //default is 1
		//echo $this->Form->input('logo');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php /*
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Teams'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Team Memberships'), array('controller' => 'team_memberships', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team Membership'), array('controller' => 'team_memberships', 'action' => 'add')); ?> </li>
	</ul>
</div>
*/