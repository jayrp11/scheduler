<?php
/* @var SubSchedule $subs */
/* @var int $counter */
?>
<div style="margin-bottom: 20px; display: <?php echo!empty($display) ? $display : 'none'; ?>; width:100%; clear:left;" class="crow">
 
     <div class="row" style="width:200px;float: left;">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']start_time'); ?>
        <?php echo CHtml::activeTextField($model, '[' . $index . ']start_time', array('size' => 20, 'maxlength' => 255)); ?>
        <?php echo CHtml::error($model, '[' . $index . ']start_time'); ?>
    </div>
	
	<div class="row" style="width:200px;float: left;">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']end_time'); ?>
        <?php echo CHtml::activeTextField($model, '[' . $index . ']end_time', array('size' => 20, 'maxlength' => 255)); ?>
        <?php echo CHtml::error($model, '[' . $index . ']end_time'); ?>
    </div>
 
    <div class="row" style="width:200px;float: left;">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']title'); ?>
        <?php echo CHtml::activeTextField($model, '[' . $index . ']title', array('size' => 20, 'maxlength' => 255)); ?>
        <?php echo CHtml::error($model, '[' . $index . ']title'); ?>
    </div>
	
	<div class="row" style="width:200px;float: left;">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']presenter'); ?>
        <?php echo CHtml::activeTextField($model, '[' . $index . ']presenter', array('size' => 20, 'maxlength' => 255)); ?>
        <?php echo CHtml::error($model, '[' . $index . ']presenter'); ?>
    </div>
	
	<div class="row" style="width:200px;float: left;">
        <?php echo CHtml::activeLabelEx($model, '[' . $index . ']lead'); ?>
        <?php echo CHtml::activeTextField($model, '[' . $index . ']lead', array('size' => 20, 'maxlength' => 255)); ?>
        <?php echo CHtml::error($model, '[' . $index . ']lead'); ?>
    </div>
</div>