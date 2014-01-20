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

<div class="row-fluid"> 
	<div class="btn-group">
		<?php echo CHtml::link('<i class="icon-th-list"></i> New Schedule',array('site/create'), array('class'=>'btn btn-default')); ?>
		<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			<span class="caret"></span>
			<!--span class="sr-only">Toggle Dropdown</span-->
		</button>
		<ul class="dropdown-menu" role="menu">
			<?php 
				foreach($templates->getData() as $record)
				{
			?>
				<li><?php echo CHtml::link(CHtml::encode($record->theme), array('create', 'template'=>$record->id)); ?></li>
			<?php
				}
			?>
		</ul>
	</div>
</div>