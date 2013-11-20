<?php
/* @var SubSchedule $subs */
/* @var int $counter */
?>
<div style="display: <?php echo!empty($display) ? $display : 'none'; ?>;" class="sub-form">
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<?php echo CHtml::activeTextField(
					$model, 
					'[' . $index . ']start_time', 
					array('size' => 20, 
						'maxlength' => 255, 
						'class'=>'form-control',
						'placeholder'=>'From')); ?>
			</div>
		</div>
		
		<div class="col-md-8">
			<div class="form-group">
				<?php echo CHtml::activeTextField(
					$model, 
					'[' . $index . ']title', 
					array('size' => 20, 
						'maxlength' => 255, 
						'class'=>'form-control',
						'placeholder'=>'Activty title')); ?>
			</div>
		</div>
	</div>
 
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<?php echo CHtml::activeTextField(
					$model, 
					'[' . $index . ']end_time', 
					array('size' => 20, 
						'maxlength' => 255, 
						'class'=>'form-control',
						'placeholder'=>'To')); ?>
			</div>
		</div>
		
		<div class="col-md-8">
			<div class="form-group">
				<?php echo CHtml::activeTextField(
					$model, 
					'[' . $index . ']lead', 
					array('size' => 20, 
						'maxlength' => 255, 
						'class'=>'form-control',
						'placeholder'=>'Lead Name')); ?>
			</div>
			
			<div class="form-group">
				<?php echo CHtml::activeTextField(
					$model, 
					'[' . $index . ']presenter', 
					array('size' => 20, 
						'maxlength' => 255, 
						'class'=>'form-control',
						'placeholder'=>'Presenter')); ?>
			</div>
		</div>
	</div>
</div>