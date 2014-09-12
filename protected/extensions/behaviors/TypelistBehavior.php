<?php
class TypelistBehavior extends CActiveRecordBehavior
{
	/**
	 * @var string the attribute name of tree node id
	 */
	public $id='id';
	public $tid='id';
	/**
	 * @var string the attribute name of tree node parent id
	 */
	public $upid='upid';
	/**
	 * @var string the attribute name of tree node label
	 */
	public $typename='typename';
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
		$root=$owner->find($this->upid.'=0');
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
		if ($showRoot===false && $model->parent->{$this->upid} > 0)
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
	 * @param int $id the id of the tree node
	 * @param bool $showRoot wether the root node should be displayed
	 * @param bool $showRoot wether the current node should be displayed
	 * @return sting of path
	 */
	public function getPathText($id=null,$showRoot=true,$showNode=true)
	{
		$owner=$this->getOwner();
		$childId=($id===null) ? $owner->getAttribute($this->tid) : $id;
		$model=$owner->findByPk($childId);
		if($model===null)
			return null;
		$items=array();
		foreach($this->getParents($model,$showRoot) as $parent)
			$items[]=$this->formatPathText($parent);
		if($showNode===true)
			$items[]=$this->formatPathText($model);
		return implode(' / ', $items);
	}

	/**
	 * @param int $id the id of the tree node
	 * @param bool $showRoot wether the root node should be displayed
	 * @return string of breadcrumbs
	 */
	public function getBreadcrumbs($id=null,$showRoot=true)
	{
		$owner=$this->getOwner();
		$childId=($id===null) ? $owner->getAttribute($this->tid) : $id;
		$model=$owner->findByPk($childId);
		if($model===null)
			return null;
		$items=array();
		foreach($this->getParents($model,$showRoot) as $parent)
			$items[]=$this->formatBreadcrumbsLink($parent);
		if($items!==array())
			$items[]=$this->formatBreadcrumbsLabel($model);
		return implode(' &raquo; ', $items);
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
				'condition'=>$this->upid.'='.$rootId,
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
////////////////////////////
	public function getAccordionMenuItems($id=null,$showRoot=true)
	{
		$owner=$this->getOwner();
		$rootId=($id===null) ? $this->getRootId() : $id;
		//$items=array();
		if ($showRoot===false)
		{
			$models=$owner->findAll(array(
				'condition'=>$this->upid.'='.$rootId,
				'order'=>$this->sort
			));
			if($models===null)
				throw new CException('The requested menu does not exist.');
			foreach($models as $model)
			{   
			    $owner=$model->getOwner();
				$items[]=$this->formatAccordionMenuItem($owner);
				$subItems[]=$model->getAccordionMenuSubItems();
				$items=array_merge($items,$subItems);
			}
							
		}
		else
		{
			$model=$owner->findByPk($rootId);
			if($model===null)
				throw new CException('The requested menu does not exist.');
			else
				$items[]=$model->getAccordionMenuSubItems();
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

	protected function getAccordionMenuSubItems()
	{
		$owner=$this->getOwner();
		$subItems=array();
		if($owner->children)
		{
			foreach($owner->children as $child)
				$subItems[]=$child->getMenuSubItems();
		}
		$items[]=$subItems;
		return $items;
	}	
	
	/**
	 * @param model the instance of ActiveRecord
	 * @return string label for path text
	 */
	protected function formatPathText($model)
	{
		if($this->pathLabelMethod!==null)
			$label=$model->{$this->pathLabelMethod}();
		else
			$label=$model->getAttribute($this->typename);

		return $label;
	}

	/**
	 * @param model the instance of ActiveRecord
	 * @return string link for CBreadcrumbs widget
	 */
	protected function formatBreadcrumbsLink($model)
	{
		$label=$this->formatBreadcrumbsLabel($model);

		if($this->breadcrumbsUrlMethod!==null)
			$url=$model->{$this->breadcrumbsUrlMethod}();
		else
			$url=array('', 'id'=>$model->getAttribute($this->tid));

		return CHtml::link(CHtml::encode($label), $url);
	}

	/**
	 * @param model the instance of ActiveRecord
	 * @return string label for CBreadcrumbs widget
	 */
	protected function formatBreadcrumbsLabel($model)
	{
		if($this->breadcrumbsLabelMethod!==null)
			$label=$model->{$this->breadcrumbsLabelMethod}();
		else
			$label=$model->getAttribute($this->typename);
		return $label;
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
			$label=$model->getAttribute($this->typename);

		if($this->menuUrlMethod!==null)
			$url=$model->{$this->menuUrlMethod}();
		else
			$url=array('', 'id'=>$model->getAttribute($this->tid));

		return array('label'=>$label, 'url'=>$url);
	}
	
	
	protected function formatAccordionMenuItem($model)
	{
		if($this->menuLabelMethod!==null)
			$label=$model->{$this->menuLabelMethod}();
		else
			$label=$model->getAttribute($this->typename);

		if($this->menuUrlMethod!==null)
			$url=$model->{$this->menuUrlMethod}();
		else
			$url=array('', 'id'=>$model->getAttribute($this->tid));

		return $label;
	}
	/**
	 * @return mixed with method parameters
	 */
	protected function getWidth()
	{
		return $this->with===array() ? 'childCount' : CMap::mergeArray(array('childCount'),$this->with);
	}
}