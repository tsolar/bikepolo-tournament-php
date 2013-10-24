<div class="leagues form">
<?php echo $this->Form->create('League'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit League'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('location');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('League.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('League.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Leagues'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List League Members'), array('controller' => 'league_members', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New League Member'), array('controller' => 'league_members', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tournaments'), array('controller' => 'tournaments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tournament'), array('controller' => 'tournaments', 'action' => 'add')); ?> </li>
	</ul>
</div>
