<?php
class MainMenu extends CWidget
{
	public function run()
	{
		$this->widget('zii.widgets.CMenu',array(
		    'id' => 'main-menu',
			'items'=>array(
				array(
					'label'=>Yii::t('ui', 'Home'),
					'url'=>array('site/index'),
				),
				array(
					'label'=>Yii::t('ui', 'about'),
					'url'=>array('site/about'),
					'active'=>$this->isMenuItemActive(array(
						'site'=>array('about'),
						//'person'=>array('alpha','batch'),
					)),
				),
/* 			array(
					'label'=>Yii::t('ui', 'widget'),
					'url'=>array('/site/widget'),
							'active'=>$this->isMenuItemActive(array(
						'site'=>array('widgets'),
						
					)),
					
				), */
				array(
					'label'=>Yii::t('ui', 'product'),
					'url'=>array('site/product'),					
					
				),
				array(
					'label'=>Yii::t('ui', 'service'),
					'url'=>array('site/service'),
				),
				array(
					'label'=>Yii::t('ui', 'support'),
					'url'=>array('site/support'),
				),
				array(
					'label'=>Yii::t('ui', 'project'),
					'url'=>array('site/project'),
				),
				array(
					'label'=>Yii::t('ui', 'info'),
					'url'=>array('site/info'),
				),
				array(
					'label'=>Yii::t('ui', 'contactus'),
					'url'=>array('site/contactus'),
				),				

			),
		));
	}

	/**
	 * Checks whether a menu item is active.
	 * This is done by checking if the currently requested URL matches given pattern of the menu item
	 * @param array the pattern to be checked ('controller'=>array('action1','action2') or 'controller'=>array('*'))
	 * @return boolean whether the menu item is active
	 */
	protected function isMenuItemActive($pattern)
	{
		$route=$this->controller->getRoute();
		foreach($pattern as $controller=>$actions)
		{
			foreach($actions as $action)
			{
				if($action=='*' && $this->controller->uniqueID==$controller)
				   return true;
				elseif($route==$controller.'/'.$action)
				   return true;
			}
		}
		return false;
	}
}
?>