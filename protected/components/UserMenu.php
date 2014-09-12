<?php

Yii::import('zii.widgets.CPortlet');

class UserMenu extends XPortlet
{
	public $title='资讯中心';
	public function getMenuData()
	{
		return Typelist::model()->getMenuItems(51,false);
	}
	protected function renderContent()
	{
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->getMenuData(),
		));
	}
}