<!DOCTYPE html>
<html>
<head>
  <meta charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title><?php echo CHtml::encode($this->pageTitle); ?></title>
  
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" media="screen, projection" />
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-theme.css" media="screen, projection" />
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-and-overrides.css" media="screen, projection" />
</head>

<body>

  <div class="container body">
    <div class="row header">
		BAPS
	</div>
  
  
    <div class="row content">
      <?php echo $content; ?>
	</div>
	
	<div class="row footer text-center">
      &copy; 1999-2013 Bochasanwasi Shri Akshar Purushottam Swaminarayan Sanstha (BAPS Swaminarayan Sanstha), Swaminarayan Aksharpith
		| <a title="Privacy Policy " href="http://baps.org/Privacy-Policy.aspx">Privacy Policy</a> 
		| <a title="Terms & Conditions" href="http://baps.org/Terms-and-Conditions.aspx">Terms & Conditions</a>
	</div>
	
  </div><!-- page -->

  <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.10.2.js"></script>
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js"></script>

</body>
</html>
