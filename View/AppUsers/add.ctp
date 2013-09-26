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
<div class="users sign-up">
	<h2>
		<?php echo __d('users', 'Sign up'); ?>
	</h2>
	<fieldset>
		<?php
			echo $this->Form->create($model, array(
				'inputDefaults' => array(
					'label' => false,
					'class'=>'form-control'
				),
			));
			echo $this->Form->input('username', array(
				'placeholder' => __d('users', 'Username'),
				));
			echo $this->Form->input('email', array(
				'placeholder' => __d('users', 'E-mail (used as login)'),
				'error' => array('isValid' => __d('users', 'Must be a valid email address'),
				'isUnique' => __d('users', 'An account with that email already exists'))));
			echo $this->Form->input('password', array(
				'placeholder' => __d('users', 'Password'),
				'type' => 'password'));
			echo $this->Form->input('temppassword', array(
				'placeholder' => __d('users', 'Password (confirm)'),
				'type' => 'password'));
			$tosLink = $this->Html->link(__d('users', 'Terms of Service'), array('controller' => 'pages', 'action' => 'tos', 'plugin' => null));
			echo $this->Form->hidden('tos', array(
				'label' => __d('users', 'I have read and agreed to ') . $tosLink,
				'default'=>1, 
				));
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
	</fieldset>
</div>
<?php //echo $this->element('Users.Users/sidebar'); ?>
