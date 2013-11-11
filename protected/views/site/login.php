<div class="loginform highlight">
  <?php /* error messages should be here */ ?>

  <?php $form=$this->beginWidget('CActiveForm', array(
    'method'=>'post',
  )); ?>
  
  <fieldset>
    <legend>Please Sign in</legend>
    <div class="form-group">
	    <?php echo $form->textField($model,'username', array('placeholder'=>'Username', 'class'=>'form-control input-lg')); ?>
	</div>
	
	<div class="form-group">
	    <?php echo $form->passwordField($model,'password', array('placeholder'=>'Password', 'class'=>'form-control input-lg')); ?>
	</div>
	
	<div class="form-group">
        <?php echo CHtml::submitButton('Sign in', array('class'=>'btn btn-primary btn-lg btn-block')); ?>
  </div>
  </fieldset>
  
  <?php $this->endWidget(); ?>
</div>