<?php
/**
 * Copyright 2010 - 2013, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2013, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<div class="users user-form">
<h2><?php echo __d('users', 'Forgot your password?'); ?></h2>
<p><?php echo __d('users', 'Please enter the email you used for registration and you\'ll get an email with further instructions.'); ?></p>
<?php
	echo $this->Form->create($model, array(
		'inputDefaults' => array(
			'class'=>'form-control',
			'label'=>false
			),
		'url' => array(
			'admin' => false,
			'action' => 'reset_password')));
	echo $this->Form->input('email', array(
		'placeholder' => __d('users', 'Your Email')));
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