<div class="view">
	<div class="heading">
		<h1 class="title"><?php echo CHtml::encode($model->theme) ?></h3>
		<span><span class="glyphicon glyphicon-calendar"></span><span id="date"><?php echo date('d M Y', strtotime($model->s_date)) ?></span></span>
	</div>
	<?php
		foreach($model->sub_schedules as $subs)
		{
	?>
		<div class="row schedule">
			<div class="col-md-1 col-xs-3 time-frame">
				<div class="from"><?php echo date('H:i', strtotime($subs->start_time)) ?></div>
				<div class="to"><?php echo date('H:i', strtotime($subs->end_time)) ?></div>
			</div>
			<div class="col-md-11 col-xs-9 details">
				<div class="sub-title"></span> <?php echo CHtml::encode($subs->title) ?></div>
				<div class="duration"><i class="icon-time"></i> <?php echo date_diff(new DateTime($subs->start_time), new DateTime($subs->end_time))->format('%i mins') ?></div>
				<div class="presenter"><i class="icon-user"></i> <?php echo CHtml::encode($subs->presenter) ?></div>
				<div class="leaded-by">Leaded by <span><?php echo CHtml::encode($subs->lead) ?></span></div>
				<div>
				<?php 
					foreach($subs->resources as $resource)
					{
				?>
					<span class="label label-primary"><?php echo CHtml::encode($resource->name) ?></span>
				<?php
					}
				?>
				</div>
			</div>
		</div>
	<?php
		}
	?>
</div>
<div class="buttons"> 
	<?php echo CHtml::link('<span class="glyphicon glyphicon-edit"></span> Edit',array('site/update', 'id'=>$model->id), array('class'=>'btn btn-default')); ?>
	<?php echo CHtml::link('<span class="glyphicon glyphicon-home"></span> Home',array('site/index'), array('class'=>'btn btn-default')); ?>
</div>