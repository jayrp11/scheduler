<div style="display: <?php echo!empty($display) ? $display : 'none'; ?>;" class="sub-form">
	<div class="form-group">
		<?php echo CHtml::ativeDropDownList(
			$model, 
			'[' . $index . ']resources',  
			CHtml::listData( Resource::model()->findAll(), 'id', 'name' )); ?>
	</div>
</div>