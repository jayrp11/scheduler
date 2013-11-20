<?php

class Schedule extends CActiveRecord 
{
	public function rules()
	{
		return array(
			array('theme, s_date', 'required'),
			array('theme', 'length', 'max'=>50),
		);
	}
	
	public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
 
    public function tableName()
    {
        return 'schedules';
    }
	
	public function relations()
	{
		return array(
			'sub_schedules'=>array(self::HAS_MANY, 'SubSchedule', 'schedule_id'),
		);
	}
	
	public function behaviors()
    {
        return array('ESaveRelatedBehavior' => array(
                'class' => 'application.components.ESaveRelatedBehavior')
        );
    }
	
	public function attributeLabels()
    {
        return array(
            'theme' => 'Theme',
            's_date' => 'Date',
        );
    }
}