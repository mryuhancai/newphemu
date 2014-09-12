<?php
class WidgetMenu extends XPortlet
{
	public $title='Widgetsttt';

	public function getMenuData()
	{
		return array(
					array('items'=>array(
						array('label'=>Yii::t('ui','Draggable'), 'url'=>array('/site/widget', 'view'=>'draggable')),
						array('label'=>Yii::t('ui','Droppable'), 'url'=>array('/site/widget', 'view'=>'droppable')),
						array('label'=>Yii::t('ui','Resizable'), 'url'=>array('/site/widget', 'view'=>'resizable')),
						array('label'=>Yii::t('ui','Selectable'), 'url'=>array('/site/widget', 'view'=>'selectable')),
						array('label'=>Yii::t('ui','Sortable'), 'url'=>array('/site/widget', 'view'=>'sortable')),
					)),
		);
	}

	protected function renderContent()
	{
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->getMenuData(),
		));
	}
}