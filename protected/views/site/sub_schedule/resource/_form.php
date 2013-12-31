<?php /* <div style="display: <?php echo!empty($display) ? $display : 'none'; ?>;" class="sub-form"> */ ?>
	<div class="row-fluid">
		<div class="span4">
			<?php echo CHtml::activeDropDownList(
				$model, 
				'[' . $index . ']resources[' . $rindex .']',  
				CHtml::listData( Resource::model()->findAll(), 'id', 'name' ),
				array(
					'class'=>'select-box',
				)); ?><i class="icon-remove del-res"></i>
		</div>
	</div>
<?php /* </div> */ ?>