<?php
/*
  if (!empty($user['SocialAccount'])) {
  echo $this->Html->tag('h3', __('My associated accounts are:'));
  ?>
  <ul class="list-unstyled">
  <?php
  foreach ($user['SocialAccount'] as $sa) {
  $data = json_decode($sa['data'], 1);
  echo $this->Html->tag('li', $sa['provider'] . $this->Html->image($data['auth']['info']['image'], array('alt' => '')));
  }
  ?>
  </ul>
  <?php
  }
 * 
 */
?>
<div class="col-sm-6">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">
				<?php echo __('My teams') ?>
			</h3>
		</div>
<!--		<div class="panel-body">
			<p>
				<?php //echo __('You are member of these teams'); ?>
			</p>
		</div>-->
		<ul class="list-unstyled list-group">
			<?php foreach ($teams as $team) { ?>
				<li class="list-group-item">
					<?php
					if (!empty($team['Team']['id'])) {
						echo $this->Html->link($team['Team']['name'], Router::url('/teams/view/' . $team['Team']['id']), array('class' => 'button'));
						if ($team['TeamMembership']['is_admin']) :
							?>
							<span class="pull-right label label-primary" title="<?php echo __('You are admin of %s', $team['Team']['name']); ?>">admin</span>
							<?php
						endif;
						
						if ($team['TeamMembership']['is_captain']) :
							?>
							<span class="pull-right label label-info" title="<?php echo __('You are captain of %s', $team['Team']['name']); ?>">captain</span>
							<?php
						endif;

						if (!$team['TeamMembership']['approved']) :
							?>
							<span class="pull-right label label-warning">
							<?php echo __('Waiting approval'); ?>
							</span>
							<?php
						endif;
					}
					?>
				</li>
			<?php } ?>
		</ul>
		<div class="panel-footer">
			<a href="/teams/add" class="btn btn-primary btn-xs" >
				<?php echo __('Add team'); ?>
			</a>
			<a href="/teams" class="btn btn-default btn-xs" >
				<?php echo __('View all teams'); ?>
			</a>
		</div>
	</div>
</div>