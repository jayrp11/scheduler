<?php
/* @var SubSchedule $subs */
/* @var int $counter */
?>
<div style="display: <?php echo!empty($display) ? $display : 'none'; ?>;" class="sub-form">
	<div class="row-fluid">
		<div class="span1">
			<button class="btn del-sub" type="button"><i class="icon-remove"></i></button>
		</div>
		
		<div class="span2">
			<div class="form-group">
				<?php echo CHtml::activeTextField(
					$model, 
					'[' . $index . ']start_time', 
					array('size' => 20, 
						'maxlength' => 255, 
						'class'=>'input-block-level',
						'placeholder'=>'From')); ?>
			</div>
		</div>
		
		<div class="span5">
			<div class="form-group">
				<?php echo CHtml::activeTextField(
					$model, 
					'[' . $index . ']title', 
					array('size' => 20, 
						'maxlength' => 255, 
						'class'=>'input-block-level',
						'placeholder'=>'Activty title')); ?>
			</div>
		</div>
	</div>
 
	<div class="row-fluid">
		<div class="span1"></div>
		<div class="span2">
			<div class="form-group">
				<?php echo CHtml::activeTextField(
					$model, 
					'[' . $index . ']end_time', 
					array('size' => 20, 
						'maxlength' => 255, 
						'class'=>'input-block-level',
						'placeholder'=>'To')); ?>
			</div>
		</div>
		
		<div class="span4">
			<div class="form-group">
				<?php echo CHtml::activeTextField(
					$model, 
					'[' . $index . ']lead', 
					array('size' => 20, 
						'maxlength' => 255, 
						'class'=>'input-block-level',
						'placeholder'=>'Lead Name')); ?>
			</div>
			
			<div class="form-group">
				<?php echo CHtml::activeTextField(
					$model, 
					'[' . $index . ']presenter', 
					array('size' => 20, 
						'maxlength' => 255, 
						'class'=>'input-block-level',
						'placeholder'=>'Presenter')); ?>
			</div>
			
			<div>
				<div id="rchildren<?php echo $index ?>">
					<?php
					$rindex = 0;
					foreach ($model->resources as $id => $child):
						$this->renderPartial('sub_schedule/resource/_form', array(
							'model' => $model,
							'index' => $index,
							'rindex' => $rindex,
							'display' => 'block'
						));
						$rindex++;
					endforeach;
					?>
				</div>
				<a class="btn" href="#" id="loadResourceByAjax<?php echo $index ?>"><i class="icon-tasks"></i> Add Resource</a>
				<?php /* echo CHtml::link('Add Resource', '#', array('id' => 'loadResourceByAjax' . $index));	*/ ?>
			</div>
		</div>
	</div>
</div>
<?php

Yii::app()->clientScript->registerScript('loadresource', '
var _pindex' . $index . ' = ' . $index . ';
var _rindex' . $index . ' = ' . $rindex . ';
$("#loadResourceByAjax'. $index .'").click(function(e){
    e.preventDefault();
    var _url = "' . Yii::app()->controller->createUrl("loadResourceByAjax", array("load_for" => $this->action->id)) . '&index="+_pindex' . $index . '+"&rindex="+_rindex' . $index . ';
    $.ajax({
        url: _url,
        success:function(response){
            $("#rchildren'. $index .'").append(response);
            $("#rchildren'. $index .' .sub-form").last().animate({
                opacity : 1, 
                left: "+50", 
                height: "toggle"
            });
        }
    });
    _rindex' . $index . '++;
});
', CClientScript::POS_END);

?>