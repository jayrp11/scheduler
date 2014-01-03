<div class="view">
	<h1><?php echo CHtml::encode($model->theme) ?></h3>
	<h6><?php echo date('d-m-Y', strtotime($model->s_date)) ?></h6>

	<?php 
		foreach($model->sub_schedules as $subs)
		{
	?>
			<h3><span><?php echo date('H:i', strtotime($subs->start_time)) ?></span> to <span><?php echo date('H:i', strtotime($subs->end_time)) ?></span> <?php echo CHtml::encode($subs->title) ?></h3>
			<div>Lead: <?php echo CHtml::encode($subs->lead) ?></div>
			<div>
				<span>Duration: <?php echo date_diff(new DateTime($subs->start_time), new DateTime($subs->end_time))->format('%i mins') ?></span>
			</div>
			<div>Presenter: <?php echo CHtml::encode($subs->presenter) ?></div>

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
<div class="row-fluid"> 
	<?php echo CHtml::link('<i class="icon-edit"></i> Edit',array('site/update', 'id'=>$model->id), array('class'=>'btn')); ?>
	<?php echo CHtml::link('<i class="icon-home"></i> Home',array('site/index'), array('class'=>'btn')); ?>
</div>