<?php
class PhemuUrlManager extends CUrlManager
{
   // public $connectionID = 'db';

	public function parseUrl($pathInfo)
	{
		$result=parent::parseUrl($pathInfo);


		return $result;
	}

	public function createUrl($route,$params=array(),$ampersand='&')
	{

	
		if(!isset($params['language']))
		{
			$params['language']=Yii::app()->language;
			}
		return parent::createUrl($route,$params,$ampersand);
	}
}