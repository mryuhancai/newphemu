<?php
class ProductMenu extends XPortlet
{
	public $title='Products';
  
	public function getMenuData()
	{
		return array(
		//'panel 1'=>$this->renderPartial('products/pages/_content1',null,true),
		'panel 2'=>'Content for panel 2',
		'panel 3'=>'Content for panel 1',
		'panel 4'=>'Content for panel 2',
		);
	}

	protected function renderContent()
	{   

		Yii::import ('zii.*');
		$this->widget('zii.widgets.jui.CJuiAccordion', array(
			'panels'=>$this->getMenuData(),
			'options'=>array(
				'collapsible'=>true,
				'active'=>0,
				'animated'=>'bounceslide',
				'navigation'=>true,
			 ),
			'htmlOptions'=>array(
				'style'=>'width:153px;'
			 ),
		));
		
	}
}
