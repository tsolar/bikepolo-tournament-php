<div class="teams index">
	<div class="col-lg-12">
		<h2><?php echo __('Teams'); ?></h2>
	</div>
	<?php foreach ($teams as $team): ?>
		<div class="team col-sm-6 col-md-3">
			<div class="thumbnail">
				<a href="/teams/view/<?php echo $team['Team']['id']; ?>">
					<?php if (!empty($team['Team']['logo'])) : ?>
						<img class="img-responsive" alt="<?php echo $team['Team']['name']; ?>" src="<?php echo $team['Team']['logo'] ?>">
					<?php else: ?>
						<img alt="<?php echo $team['Team']['name']; ?>" src="holder.js/100%x200/auto/">
					<?php endif; ?>
					<div class="caption">
						<h3><?php echo $team['Team']['name']; ?></h3>
						<!--<p><a href="#" class="btn btn-primary">Button</a> <a href="#" class="btn btn-default">Button</a></p>-->
					</div>
				</a>
			</div>
		</div>
	<?php endforeach; ?>
</div>