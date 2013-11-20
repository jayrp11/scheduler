<?php

class SiteController extends CController
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$dataProvider=new CActiveDataProvider('Schedule');
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
	public function actionCreate()
	{
		$model=new Schedule;
		//$subs=new SubSchedule;
		
		//$enable_add_more_subs = true;

		if(isset($_POST['Schedule']))
		{
			$model->attributes=$_POST['Schedule'];
			
			if (isset($_POST['SubSchedule']))
            {
                $model->sub_schedules = $_POST['SubSchedule'];
            }
            if ($model->saveWithRelated('sub_schedules'))
                $this->redirect(array('view', 'id' => $model->id));
            else
                $model->addError('children', 'Error occured while saving children.');
		}

		$this->render('create',array(
			'model'=>$model,
			//'subs'=>(isset($subs_to_save)) ? $subs_to_save : array(new SubSchedule('insert')),
			//'enable_add_more_subs' => $enable_add_more_subs,
		));
	}
	
	/**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
 
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
 
        if (isset($_POST['Father']))
        {
            $model->attributes = $_POST['Father'];
            if (isset($_POST['Child']))
            {
                $model->children = $_POST['Child'];
            }
            if ($model->saveWithRelated('children'))
                $this->redirect(array('view', 'id' => $model->id));
            else
                $model->addError('children', 'Error occured while saving children.');
        }
 
        $this->render('update', array(
            'model' => $model,
        ));
    }

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function loadModel($id)
	{
		$model=Schedule::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function actionLoadChildByAjax($index)
    {
        $model = new SubSchedule;
		
		// Yii::log('', CLogger::LEVEL_ERROR, 'SubSchedule.endDate' . $model->end_time);
		
		$model->start_time = '';
		$model->end_time = '';
		
        $this->renderPartial('sub_schedule/_form', array(
            'model' => $model,
            'index' => $index,
        ), false, true);
    }
}