<h3 class="table-header"><?php echo CHtml::encode($model->theme) ?></h3>
<h2 class="table-header"><?php echo CHtml::encode($model->s_date) ?></h2>

<?php 
	foreach($model->sub_schedules as $subs)
	{
?>
		<div><?php echo CHtml::encode($subs->start_time) ?></div>
		<div><?php echo CHtml::encode($subs->end_time) ?></div>
		<div><?php echo CHtml::encode($subs->title) ?></div>
		<div><?php echo CHtml::encode($subs->presenter) ?></div>
		<div><?php echo CHtml::encode($subs->lead) ?></div>
<?php
	}
?>