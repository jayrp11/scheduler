<?php
class RequireLogin extends CBehavior
{
	public function attach($owner)
	{
		$owner->attachEventHandler('onBeginRequest', array($this, 'handleBeginRequest'));
	}
	
	public function handleBeginRequest($event)
	{
	    $r = isset($_GET['r']) ? $_GET['r'] : null;
		
		if (Yii::app()->user->isGuest && !in_array($r, array('site/login'))) {
			Yii::app()->user->loginRequired();
		}
	}
}
?>