<?php
class DocumentBehavior extends CActiveRecordBehavior
{
	/**
	 * @var string the attribute name of tree node id
	 */
	public $id='id';
	/**
	 * @var string the attribute name of tree node parent id
	 */
	public $tid='tid';
	/**
	 * @var string the attribute name of tree node label
	 */
	public $title='title';
	/**
	 * @var string the attribute name to order tree nodes by
	 */
	public $sort='tid';
	/**
	 * @var mixed the with method parameter of owner model
	 */
	public $with=array();
	/**
	 * @var string the name of owner model method to format path label
	 */
	public $pathLabelMethod=null;
	/**
	 * @var string the name of owner model method to format breadcrumbs label
	 */
	public $breadcrumbsLabelMethod=null;
	/**
	 * @var string the name of owner model method to format breadcrumbs url
	 */
	public $breadcrumbsUrlMethod=null;
	/**
	 * @var string the name of owner model method to format menu label
	 */
	public $menuLabelMethod=null;
	/**
	 * @var string the name of owner model method to format menu url
	 */
	public $menuUrlMethod=null;
	/**
	 * @var string the name of owner model method to format tree label
	 */
	public $treeLabelMethod=null;
	/**
	 * @var string the name of owner model method to format tree url
	 */
	public $treeUrlMethod=null;

	/**
	 * @return int id of the absolute root node
	 */
	public function getRootId()
	{
		$owner=$this->getOwner();
		$root=$owner->find($this->tid.'=0');
		return $root->tid;
	}

	/**
	 * @param model the instance of ActiveRecord
	 * @param bool $showRoot wether the absolute root node should be returned
	 * @return array of parent models
	 */
	public function getParents($model,$showRoot=false)
	{
		$parents=array();
		if ($showRoot===false && $model->parent->{$this->tid} > 0)
		{
			$parents[]=$model->parent;
			$parents=array_merge($this->getParents($model->parent,false), $parents);
		}
		if($showRoot===true && $model->parent)
		{
			$parents[]=$model->parent;
			$parents=array_merge($this->getParents($model->parent,true), $parents);
		}
		return $parents;
	}
	
	/**
	 * @param model the instance of ActiveRecord
	 * @return array of all children models
	 */
	public function getAllChildren($model)
	{
		$children=array();
		if($model->children)
		{
			foreach($model->children as $child)
			{
				$children[]=$child;
				$children=array_merge($this->getAllChildren($child), $children);
			}
		}
		return $children;
	}
	/**
	 * @param int $id the id of the relative root node
	 * @param bool $showRoot wether the relative root node should be displayed
	 * @return array of items for CMenu widget
	 */
	public function getMenuItems($id=null,$showRoot=true)
	{
		$owner=$this->getOwner();
		$rootId=($id===null) ? $this->getRootId() : $id;
		$items=array();
		if ($showRoot===false)
		{
			$models=$owner->findAll(array(
				'condition'=>$this->tid.'='.$rootId,
				'order'=>$this->sort
			));
			if($models===null)
				throw new CException('The requested menu does not exist.');
			foreach($models as $model)
				$items[]=$model->getMenuSubItems();
		}
		else
		{
			$model=$owner->findByPk($rootId);
			if($model===null)
				throw new CException('The requested menu does not exist.');
			else
				$items[]=$model->getMenuSubItems();
		}
		return $items;
	}
	/**
	 * @return subarray of items for CMenu widget
	 */
	protected function getMenuSubItems()
	{
		$owner=$this->getOwner();
		$subItems=array();
		if($owner->children)
		{
			foreach($owner->children as $child)
				$subItems[]=$child->getMenuSubItems();
		}
		$items=$this->formatMenuItem($owner);
		if($subItems!=array())
			$items=array_merge($items, array('items'=>$subItems));
		return $items;
	}
	/**
	 * @param model the instance of ActiveRecord
	 * @return array of menu item formatted for CMenu widget
	 */
	protected function formatMenuItem($model)
	{
		if($this->menuLabelMethod!==null)
			$label=$model->{$this->menuLabelMethod}();
		else
			$label=$model->getAttribute($this->title);

		if($this->menuUrlMethod!==null)
			$url=$model->{$this->menuUrlMethod}();
		else
			$url=array('', 'id'=>$model->getAttribute($this->tid));

		return array('label'=>$label, 'url'=>$url);
	}
	/**
	 * @return mixed with method parameters
	 */
	protected function getWidth()
	{
		return $this->with===array() ? 'childCount' : CMap::mergeArray(array('childCount'),$this->with);
	}
}