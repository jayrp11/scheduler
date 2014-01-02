<div class="view">
	<h1><?php echo CHtml::encode($model->theme) ?></h3>
	<h6><?php echo date('d-m-Y', strtotime($model->s_date)) ?></h6>

	<?php 
		foreach($model->sub_schedules as $subs)
		{
	?>
			<h3><?php echo CHtml::encode($subs->title) ?></h3>
			<div>
				<span><?php echo date('H:i', strtotime($subs->start_time)) ?></span> to <span><?php echo date('H:i', strtotime($subs->end_time)) ?></span>
			</div>
			
			<div><?php echo CHtml::encode($subs->presenter) ?></div>
			<div><?php echo CHtml::encode($subs->lead) ?></div>
			
			<?php 
				foreach($subs->resources as $resource)
				{
			?>
				<span class="label label-info"><?php echo CHtml::encode($resource->name) ?></span>
			<?php
				}
			?>
	<?php
		}
	?>
</div>