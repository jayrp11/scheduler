<?php

class Resource extends CActiveRecord 
{
	
	public function rules()
	{
		return array(
			array('type, name', 'required'),
		);
	}
	
	public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
 
    public function tableName()
    {
        return 'resources';
    }
}