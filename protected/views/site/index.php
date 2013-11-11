

<h3 class="table-header">Future</h3>
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
					<td><?php echo CHtml::encode($record->theme); ?></td>
					<td>1:40</td>
				</tr>
		<?php
			}
		?>
	<tbody>
</table>