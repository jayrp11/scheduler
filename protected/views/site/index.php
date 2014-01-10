<h3 class="table-header">Future schedules</h3>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Date</th>
			<th>Theme</th>
			<th>Duration</th>
		</tr>
	<thead>
	
	<tbody>
	    <?php 
			foreach($dataProvider->getData() as $record)
			{
		?>
				<tr>
					<td><?php echo CHtml::encode($record->s_date); ?></td>
					<td><?php echo CHtml::link(CHtml::encode($record->theme), array('view', 'id'=>$record->id)); ?></td>
					<td>1:40</td>
				</tr>
		<?php
			}
		?>
	<tbody>
</table>

<div>
	<?php echo CHtml::link('<span class="glyphicon glyphicon-list"></span> New Schedule',array('site/create'), array('class'=>'btn btn-default')); ?>
</div>