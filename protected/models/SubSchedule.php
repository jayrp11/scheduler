<?php

class SubSchedule extends CActiveRecord 
{
	
	public function rules()
	{
		return array(
			// TODO: remove presenter it can not be required
			array('start_time, end_time, title, lead, presenter', 'required'),
		);
	}
	
	public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
 
    public function tableName()
    {
        return 'sub_schedules';
    }
	
	public function relations()
	{
		return array(
			'schedules'=>array(self::BELONGS_TO, 'Schedule', 'schedule_id'),
		);
	}

}