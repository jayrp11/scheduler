<div class="view">
	<div class="row-fluid heading">
		<h1 class="title"><?php echo CHtml::encode($model->theme) ?></h3>
		<span><i class="icon-calendar"></i><span id="date"><?php echo date('d-m-Y', strtotime($model->s_date)) ?></span></span>
	</div>
	<?php
		foreach($model->sub_schedules as $subs)
		{
	?>
		<div class="row-fluid schedule">
			<span class="time-frame">
				<div class="from"><?php echo date('H:i', strtotime($subs->start_time)) ?></div>
				<div class="to"><?php echo date('H:i', strtotime($subs->end_time)) ?></div>
			</span>
			<span class="details">
				<div class="sub-title"></span> <?php echo CHtml::encode($subs->title) ?></div>
				<div class="duration"><i class="icon-time"></i> <?php echo date_diff(new DateTime($subs->start_time), new DateTime($subs->end_time))->format('%i mins') ?></div>
				<div class="presenter"><i class="icon-user"></i> <?php echo CHtml::encode($subs->presenter) ?></div>
				<div class="leaded-by">Leaded by <span><?php echo CHtml::encode($subs->lead) ?></span></div>

				<?php 
					foreach($subs->resources as $resource)
					{
				?>
					<span class="label label-info"><?php echo CHtml::encode($resource->name) ?></span>
				<?php
					}
				?>
			</span>
		</div>
	<?php
		}
	?>
</div>
<div class="row-fluid buttons"> 
	<?php echo CHtml::link('<i class="icon-edit"></i> Edit',array('site/update', 'id'=>$model->id), array('class'=>'btn')); ?>
	<?php echo CHtml::link('<i class="icon-home"></i> Home',array('site/index'), array('class'=>'btn')); ?>
</div>