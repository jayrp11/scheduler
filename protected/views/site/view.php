<div class="view">
	<h1><?php echo CHtml::encode($model->theme) ?></h3>
	<h2><?php echo CHtml::encode($model->s_date) ?></h2>

	<?php 
		foreach($model->sub_schedules as $subs)
		{
	?>
			<h3><?php echo CHtml::encode($subs->title) ?></h3>
			<div>
				<span><?php echo CHtml::encode($subs->start_time) ?></span> to <span><?php echo CHtml::encode($subs->end_time) ?></span>
			</div>
			
			<div><?php echo CHtml::encode($subs->presenter) ?></div>
			<div><?php echo CHtml::encode($subs->lead) ?></div>
	<?php
		}
	?>
</div>