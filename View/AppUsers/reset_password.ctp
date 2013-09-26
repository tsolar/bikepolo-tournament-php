<div class="users user-form">
<h2><?php echo __d('users', 'Reset your password'); ?></h2>
<?php
	echo $this->Form->create($model, array(
		'inputDefaults' => array(
			'class'=>'form-control',
			'label'=>false
			),
		'url' => array(
			'action' => 'reset_password',
			$token)));
	echo $this->Form->input('new_password', array(
		'placeholder' => __d('users', 'New Password'),
		'type' => 'password'));
	echo $this->Form->input('confirm_password', array(
		'placeholder' => __d('users', 'Confirm'),
		'type' => 'password'));
?>
		<button type="submit" class = "btn btn-primary btn-block">
			<?php echo __d('users', 'Submit');
			?>
		</button>
		<a href="/login" class = "btn btn-link btn-block">
			<?php echo __d('users', 'Back to login');
			?>
		</a>
		<?php
			echo $this->Form->end();
		?>
</div>
<?php //echo $this->element('Users.Users/sidebar'); ?>