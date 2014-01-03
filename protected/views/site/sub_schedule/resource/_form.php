<?php /* <div style="display: <?php echo!empty($display) ? $display : 'none'; ?>;" class="sub-form"> */ ?>
	<div class="resource input-append">
			<?php echo CHtml::activeDropDownList(
				$model, 
				'[' . $index . ']resources[' . $rindex .']',  
				CHtml::listData( Resource::model()->findAll(), 'id', 'name' )); ?>
				<button class="btn del-res" type="button"><i class="icon-remove"></i></button>
	</div>
<?php /* </div> */ ?>