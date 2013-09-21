<?php
/**
 *
 * PHP 5
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 */
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$appName = __('Bike Polo Tournament');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
		<?php echo $this->Html->charset(); ?>
        <title>
			<?php echo $appName ?>:
			<?php echo $title_for_layout; ?>
        </title>
		<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('bpt', null, array('ext' => '.scss'));
		echo $this->Html->css('bpt');
		echo $this->Html->css('font-awesome.min');
		?>
		<!--[if IE 7]>
		<?php echo $this->Html->css('font-awesome-ie7.min'); ?>
		<![endif]-->
		<?php
		echo $this->Html->css('bootstrap-theme.min');
		echo $this->Html->css('select2');
		echo $this->Html->css('default');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<?php echo $this->Html->script('html5shiv'); ?>
		<?php echo $this->Html->script('respond.min'); ?>
		<![endif]-->
    </head>
    <body>

		<div class="loading">
			<p>
				<i class="icon-spinner icon-spin"></i>&nbsp;
				<?php echo __('Loading...'); ?>
			</p>
		</div>
		<!-- Wrap all page content here -->
		<div id="wrap">

			<!-- Fixed navbar -->
			<div role="navigation" class="navbar navbar-fixed-top navbar-inverse">
				<div class="container">
					<div class="navbar-header">
						<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a href="/" class="navbar-brand">
							<?php echo $appName; ?>
						</a>
					</div>
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav">
							<li class="<?php echo $this->here == '/' ? 'active' : ''; ?>">
								<a href="/"><?php echo __('Home'); ?></a>
							</li>
							<li class="<?php echo $this->here == '/ubicacion' ? 'active' : ''; ?>"><a href="/ubicacion">Ubicación</a></li>
							<li class="<?php echo $this->here == '/tienda' ? 'active' : ''; ?>"><a href="/tienda">Tienda</a></li>
						</ul>

						<?php if (!empty($current_user['AppUser'])): ?>
							<ul class="nav navbar-nav navbar-right">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<?php
										echo $current_user['AppUser']['username'];
										if ($current_user['AppUser']['is_admin']) {
											echo ' (admin)';
										}
										?>&nbsp;<b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="/users/edit"><?php echo __('My profile'); ?></a></li>
										<li class="divider"></li>
										<li><a href="/logout"><?php echo __('Logout'); ?></a></li>
									</ul>
								</li>
							</ul>
						<?php else: ?>
							<ul class="nav navbar-nav navbar-right">

								<li><a href="/login"><?php echo __('Login'); ?></a></li>
							</ul>
						<?php endif; ?>
					</div> 
				</div>  
			</div>   

			<!-- Begin page content -->
			<div class="container">
				<div id="header" class="page-header hide">
					<h1><?php echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?></h1>
				</div>

				<div id="content">
					<?php echo $this->Session->flash(); ?>
					<?php echo $this->fetch('content'); ?>
				</div>
			</div>
		</div>

		<div id="footer">
			<div class="container">
				<?php
				echo $this->Html->link(
						$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')), 'http://www.cakephp.org/', array('target' => '_blank', 'escape' => false)
				);
				?>
			</div>
		</div>

		<?php
		echo $this->Html->script('jquery-2.0.0');
		echo $this->Html->script('jquery-migrate-1.2.1');
		echo $this->Html->script('jquery.form.min');
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('select2.min');
		echo $this->Html->script('holder');
		echo $this->fetch('script');
		?>
        <script>
			// Avoid `console` errors in browsers that lack a console.
			(function() {
				var method;
				var noop = function() {
				};
				var methods = [
					'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
					'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
					'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
					'timeStamp', 'trace', 'warn'
				];
				var length = methods.length;
				var console = (window.console = window.console || {});

				while (length--) {
					method = methods[length];

					// Only stub undefined methods.
					if (!console[method]) {
						console[method] = noop;
					}
				}
			}());

			$(function() {
				$('td.actions a').on('click', function() {
					$('.loading').css('top', $(document).scrollTop()).show();
				});
				$('button[type="submit"]').on('click', function() {
					$('.loading').css('top', $(document).scrollTop()).show();
				});
				$('a.show-loading').on('click', function() {
					$('.loading').css('top', $(document).scrollTop()).show();
				});

				$('select').select2().removeAttr('required');
				$('.select2-container').removeClass('form-control');
				$('input[type="file"]').removeClass('form-control');
				$('table').addClass('table');
			})

			$(document).ready(function() {
				$('.loading').fadeOut();
			});
        </script>
		<?php echo $this->element('sql_dump'); ?>
    </body>
</html>
