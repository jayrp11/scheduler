<?php
/* @var $this SiteController */
/* @var $model Schedule */
/* @var $form CActiveForm */
?>

<div>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'schedule-form',
	'htmlOptions'=>array('role'=>'form'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
			<?php echo $form->textField(
				$model,
				'theme',
				array('size'=>50, 
					'maxlength'=>50, 
					'class'=>'form-control',
					'placeholder'=>'Title')); ?>
	</div>

	<div class="form-group">
		<div class="input-group" id="schedule-date">
			<?php echo $form->textField(
				$model,
				's_date',
				array('size'=>50, 
					'maxlength'=>50, 
					'class'=>'form-control',
					'placeholder'=>'Date',
					'autocomplete'=>'off')); ?>
			<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		</div>
	</div>
	
	<div>
		<div id="children">
			<?php
			$index = 0;
			foreach ($model->sub_schedules as $id => $child):
				$this->renderPartial('sub_schedule/_form', array(
					'model' => $child,
					'index' => $id,
					'display' => 'block'
				));
				$index++;
			endforeach;
			?>
		</div>
		<?php /* echo CHtml::link('Add Schedule', '#', array('id' => 'loadChildByAjax')); */ ?>
	</div>

	<div class="row-fluid buttons"> 
		<a class="btn" href="#" id="loadChildByAjax"><i class="icon-list-alt"></i> Add Schedule</a>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-primary')); ?>
		<?php echo CHtml::link('<i class="icon-home"></i> Home',array('site/index'), array('class'=>'btn')); ?>
	</div>
	
<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScript('loadchild', '
var _index = ' . $index . ';
$("#loadChildByAjax").click(function(e){
    e.preventDefault();
    var _url = "' . Yii::app()->controller->createUrl("loadChildByAjax", array("load_for" => $this->action->id)) . '&index="+_index;
    $.ajax({
        url: _url,
        success:function(response){
            $("#children").append(response);
            $("#children .sub-form").last().animate({
                opacity : 1, 
                left: "+50", 
                height: "toggle"
            });
        }
    });
    _index++;
});
', CClientScript::POS_END);
?>