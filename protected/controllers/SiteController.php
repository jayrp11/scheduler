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
	
	public function convertToDate($s_date, $sub_schedules)
	{
		// Yii::log('SubSchedule.endDate', CLogger::LEVEL_ERROR, 'Model');
		// echo('<pre>'); print_r($sub_schedules); echo('</pre>');
		
		//Yii::log($sub_schedules['s_date'], CLogger::LEVEL_ERROR, 'Model');
		//$s_date = $sub_schedules['s_date'];

		$ss = array();
		foreach($sub_schedules as $key => $sub)
		{
			// TODO: improve below logic
			// Yii::log(serialize($sub), CLogger::LEVEL_ERROR, 'sub - before');
			$start_time = new DateTime($s_date);
			$time = explode(':', $sub['start_time']);
			$start_time->setTime(intval($time[0]), intval($time[1]));
			Yii::log($start_time->format('Y-m-d H:i:s'), CLogger::LEVEL_ERROR, 'Model');
			$sub_schedules[$key]['start_time']=$start_time->format('Y-m-d H:i:s');
			
			$end_time = new DateTime($s_date);
			$time = explode(':', $sub['end_time']);
			$end_time->setTime(intval($time[0]), intval($time[1]));
			Yii::log($end_time->format('Y-m-d H:i:s'), CLogger::LEVEL_ERROR, 'Model');
			$sub_schedules[$key]['end_time']=$end_time->format('Y-m-d H:i:s');
			
			//Yii::log(serialize($sub), CLogger::LEVEL_ERROR, 'sub - after');
			
		}
		Yii::log(serialize($sub_schedules), CLogger::LEVEL_ERROR, '$sub_schedules');
		
		return $sub_schedules;
	}
	
	public function actionCreate()
	{
		Yii::log(serialize($_POST), CLogger::LEVEL_ERROR, '$_POST');
		
		$schedule=new Schedule();
		
		if(isset($_POST['Schedule']))
		{
			$schedule->attributes=$_POST['Schedule'];
			
			if(isset($_POST['SubSchedule']))
			{
				$sub_schedules = $this->convertToDate($schedule['s_date'], $_POST['SubSchedule']);
				
				$ss = array();
				foreach($sub_schedules as $sub)
				{
					$sub_model=new SubSchedule();
					$sub_model->attributes=$sub;
					
					if(isset($sub['resources']))
					{
						Yii::log('>>>>>>>>>>>>>>>>>>>>>', CLogger::LEVEL_ERROR, '>>');
						Yii::log(serialize($sub['resources']), CLogger::LEVEL_ERROR, 'resources');
						
						$resources = array();
						foreach($sub['resources'] as $r)
						{
							$resource=Resource::model()->findByPk($r); // TODO: this will change to array
							
							Yii::log(serialize($resource), CLogger::LEVEL_ERROR, '$resource');
							
							array_push($resources, $resource);
						}

						//TODO: exception handling for non existing IDs
						
						$sub_model->resources=$resources;
					}
					
					array_push($ss, $sub_model);
				}

			
				Yii::log(serialize($ss), CLogger::LEVEL_ERROR, '$ss');
			
				$schedule->sub_schedules=$ss;
			}
			
			
			$is_saved=$schedule->withRelated->save(true,array(
				'sub_schedules'=>array(
					'resources',
				),
			));
			
			if($is_saved)
				$this->redirect(array('view', 'id' => $schedule->id));
			else
				$model->addError('children', 'Error occured while saving.');
		}
		
		$this->render('create',array(
			'model'=>$schedule,
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
	
	public function actionLoadResourceByAjax($index, $rindex)
    {
		$model = new SubSchedule;
		Yii::log($index . ' - ' . $rindex, CLogger::LEVEL_ERROR, '$index - $rindex');
				
        $this->renderPartial('sub_schedule/resource/_form', array(
			'model' => $model,
            'index' => $index,
			'rindex' => $rindex,
        ), false, true);
    }
}