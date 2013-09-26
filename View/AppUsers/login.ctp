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
<div class="users login">
	<h2><?php echo __d('users', 'Login'); ?></h2>
	<?php
	echo $this->Form->create($model, array(
		'inputDefaults' => array(
			'label' => false,
		),
		'action' => 'login',
		'id' => 'LoginForm'));
	echo $this->Form->input('email', array(
		'placeholder' => __d('users', 'Email'),
		'class' => 'form-control'
	));
	echo $this->Form->input('password', array(
		'placeholder' => __d('users', 'Password'),
		'class' => 'form-control'
	));

	echo '<p>' . $this->Form->input('remember_me', array('type' => 'checkbox', 'label' => __d('users', 'Remember Me'))) . '</p>';
	echo '<p>' . $this->Html->link(__d('users', 'I forgot my password'), array('action' => 'reset_password')) . '</p>';
	echo '<p>' . $this->Html->link(__d('users', 'Do not have an account'), '/register') . '</p>';

	echo $this->Form->hidden('User.return_to', array(
		'value' => $return_to));
	?>
	<button type="submit" class="btn btn-primary btn-block">
		<?php echo __d('users', 'Submit'); ?>
	</button>
	<?php
	echo $this->Form->end();
	?>
	
	<div class="social-auth">
		<div class="or-statement">
			&#8213;&#8213;
			<?php echo __('Or, if you prefer'); ?>
			&#8213;&#8213;
		</div>
		<a href="/auth/facebook" class="btn btn-primary btn-block">
			<i class="icon-facebook"></i>
			<?php echo __('Login with Facebook');?>
		</a>
	</div>
</div>
<?php
//echo $this->element('Users.Users/sidebar'); ?>