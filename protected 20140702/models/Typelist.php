<?php

/**
 * This is the model class for table "{{typelist}}".
 *
 * The followings are the available columns in table '{{typelist}}':
 * @property string $tid
 * @property integer $pid
 * @property integer $mid
 * @property integer $topid
 * @property integer $upid
 * @property integer $exmid
 * @property string $linkid
 * @property string $gotoid
 * @property string $lng
 * @property string $typename
 * @property string $content
 * @property string $keywords
 * @property string $description
 * @property string $typepic
 * @property string $dirname
 * @property integer $purview
 * @property integer $ismenu
 * @property integer $isaccessory
 * @property integer $isclass
 * @property integer $ispart
 * @property integer $styleid
 * @property integer $pageclass
 * @property string $indextemplates
 * @property string $template
 * @property string $readtemplate
 * @property string $filenamestyle
 * @property string $readnamestyle
 * @property integer $isline
 * @property string $gotoline
 * @property string $typeurl
 * @property string $dirpath
 * @property integer $iswap
 * @property string $waptempalte
 * @property string $wapreadtemplate
 * @property integer $pagemax
 * @property string $addtime
 * @property integer $isorderby
 * @property integer $ordertype
 */
class Typelist extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	
	private static $_items=array();
	private static $_upid=array();
	private $_id;
	public function tableName()
	{
		return '{{typelist}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('typename, content, description, typepic, indextemplates, template, readtemplate, readnamestyle, typeurl, dirpath, waptempalte, wapreadtemplate', 'required'),
			array('pid, mid, topid, upid, exmid, purview, ismenu, isaccessory, isclass, ispart, styleid, pageclass, isline, iswap, pagemax, isorderby, ordertype', 'numerical', 'integerOnly'=>true),
			array('linkid, gotoid, gotoline', 'length', 'max'=>11),
			array('lng, dirname', 'length', 'max'=>50),
			array('typename, dirpath', 'length', 'max'=>150),
			array('keywords', 'length', 'max'=>80),
			array('description', 'length', 'max'=>180),
			array('typepic, typeurl', 'length', 'max'=>200),
			array('indextemplates, template, readtemplate, filenamestyle, readnamestyle, waptempalte, wapreadtemplate', 'length', 'max'=>100),
			array('addtime', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('tid, pid, mid, topid, upid, exmid, linkid, gotoid, lng, typename, content, keywords, description, typepic, dirname, purview, ismenu, isaccessory, isclass, ispart, styleid, pageclass, indextemplates, template, readtemplate, filenamestyle, readnamestyle, isline, gotoline, typeurl, dirpath, iswap, waptempalte, wapreadtemplate, pagemax, addtime, isorderby, ordertype', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
// 		    'typeid' => array(self::HAS_MANY, 'DocumentContent', 'did'),
			'hm_d_tid' => array(self::HAS_MANY, 'Document', 'tid'),
			'hm_d_did' => array(self::HAS_MANY, 'Document', 'did'),
			'parent' => array(self::BELONGS_TO, 'Typelist', 'topid'),
			'children' => array(self::HAS_MANY, 'Typelist', 'topid', 'order' => 'tid'),
			'childCount' => array(self::STAT, 'Typelist', 'topid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'tid' => 'Tid',
			'pid' => 'Pid',
			'mid' => 'Mid',
			'topid' => 'Topid',
			'upid' => 'Upid',
			'exmid' => 'Exmid',
			'linkid' => 'Linkid',
			'gotoid' => 'Gotoid',
			'lng' => 'Lng',
			'typename' => 'Typename',
			'content' => 'Content',
			'keywords' => 'Keywords',
			'description' => 'Description',
			'typepic' => 'Typepic',
			'dirname' => 'Dirname',
			'purview' => 'Purview',
			'ismenu' => 'Ismenu',
			'isaccessory' => 'Isaccessory',
			'isclass' => 'Isclass',
			'ispart' => 'Ispart',
			'styleid' => 'Styleid',
			'pageclass' => 'Pageclass',
			'indextemplates' => 'Indextemplates',
			'template' => 'Template',
			'readtemplate' => 'Readtemplate',
			'filenamestyle' => 'Filenamestyle',
			'readnamestyle' => 'Readnamestyle',
			'isline' => 'Isline',
			'gotoline' => 'Gotoline',
			'typeurl' => 'Typeurl',
			'dirpath' => 'Dirpath',
			'iswap' => 'Iswap',
			'waptempalte' => 'Waptempalte',
			'wapreadtemplate' => 'Wapreadtemplate',
			'pagemax' => 'Pagemax',
			'addtime' => 'Addtime',
			'isorderby' => 'Isorderby',
			'ordertype' => 'Ordertype',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('tid',$this->tid,true);
		$criteria->compare('pid',$this->pid);
		$criteria->compare('mid',$this->mid);
		$criteria->compare('topid',$this->topid);
		$criteria->compare('upid',$this->upid);
		$criteria->compare('exmid',$this->exmid);
		$criteria->compare('linkid',$this->linkid,true);
		$criteria->compare('gotoid',$this->gotoid,true);
		$criteria->compare('lng',$this->lng,true);
		$criteria->compare('typename',$this->typename,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('keywords',$this->keywords,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('typepic',$this->typepic,true);
		$criteria->compare('dirname',$this->dirname,true);
		$criteria->compare('purview',$this->purview);
		$criteria->compare('ismenu',$this->ismenu);
		$criteria->compare('isaccessory',$this->isaccessory);
		$criteria->compare('isclass',$this->isclass);
		$criteria->compare('ispart',$this->ispart);
		$criteria->compare('styleid',$this->styleid);
		$criteria->compare('pageclass',$this->pageclass);
		$criteria->compare('indextemplates',$this->indextemplates,true);
		$criteria->compare('template',$this->template,true);
		$criteria->compare('readtemplate',$this->readtemplate,true);
		$criteria->compare('filenamestyle',$this->filenamestyle,true);
		$criteria->compare('readnamestyle',$this->readnamestyle,true);
		$criteria->compare('isline',$this->isline);
		$criteria->compare('gotoline',$this->gotoline,true);
		$criteria->compare('typeurl',$this->typeurl,true);
		$criteria->compare('dirpath',$this->dirpath,true);
		$criteria->compare('iswap',$this->iswap);
		$criteria->compare('waptempalte',$this->waptempalte,true);
		$criteria->compare('wapreadtemplate',$this->wapreadtemplate,true);
		$criteria->compare('pagemax',$this->pagemax);
		$criteria->compare('addtime',$this->addtime,true);
		$criteria->compare('isorderby',$this->isorderby);
		$criteria->compare('ordertype',$this->ordertype);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function aboutPhemu($topid=1,$mid=8,$limit=6)
	{
		$newsTitle=$this->findAll(array(
		
		'condition'=>'topid='.$topid,
			//'order'=>'did DESC',
			'limit'=>$limit,
		));
		$names=array();
		foreach($newsTitle as $title)
		
		if (strlen($title->typename)>38){$title->typename=self::cut_str($title->typename,21);;$names[]=$title->typename; }
		else{
		$names[]=$title->typename;}
		
		return $names;
	}
	
	public static function items($topid)
	{
		
		self::loadItems($topid);
		return self::$_items;
	}
	
	private static function loadItems($topid)
	{
			$models=self::model()->findAll(array(
				'condition'=>'topid=:topid',
				'params'=>array(':topid'=>$topid),
				'order'=>'tid',
		));
		foreach($models as $model)
		{
			$model->linkid>0 ? $_id=$model->linkid:$_id=$model->upid;
			self::$_upid=array($_id=>$model->typename);
			self::$_items[]=self::$_upid;
		}
		return self::$_items;
	}
	
	public static function normalizeUrl($url)
	{
		if(is_array($url))
		{
			if(isset($url[0]))
			{
				if(($c=Yii::app()->getController())!==null)
					$url=$c->createUrl($url[0],array_splice($url,1));
				else
					$url=Yii::app()->createUrl($url[0],array_splice($url,1));
			}
			else
				$url='';
		}
		return $url==='' ? Yii::app()->getRequest()->getUrl() : $url;
	}
	//////////////added 20140624//////////////////
	public function behaviors()
	{
		return array(
			'TreeBehavior' => array(
				'class' => 'ext.behaviors.XTreeBehavior',
				'treeLabelMethod'=> 'getTreeLabel',
				'menuUrlMethod'=> 'getMenuUrl',
			),
		);
	}

	public function getTreeLabel()
	{
		return $this->typename . ':' . $this->childCount;
	}

	/**
	 * @return array menu url
	 */
	public function getMenuUrl()
	{
		if(Yii::app()->controller->action->id=='adminMenu')
			return array('admin', 'tid'=>$this->tid);
		else
		if($this->linkid>0)
			{
				$this->tid=$this->linkid;
				return array('site/view','tid'=>$this->tid,'typename'=>$this->typename,'topid'=>$this->topid,'islink'=>true);
			}
		else{
				return array('site/viewarticle','tid'=>$this->tid,'typename'=>$this->typename,'topid'=>$this->topid,'islink'=>false);
			}
	}

	/**
	 * Retrieves a list of child models
	 * @param integer the id of the parent model
	 * @return CActiveDataProvider the data provider
	 */
	public function getDataProvider($id=null)
	{
		if($id===null)
			$id=$this->TreeBehavior->getRootId();
		$criteria=new CDbCriteria(array(
			'condition'=>'topid=:id',
			'params'=>array(':id'=>$id),
			'order'=>'typename',
			'with'=>'childCount',
		));
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			'pagination'=>false,
		));
	}

	/**
	 * Suggests a list of existing values matching the specified keyword.
	 * @param string the keyword to be matched
	 * @param integer maximum number of names to be returned
	 * @return array list of matching lastnames
	 */
	public function suggest($keyword,$limit=20)
	{
		$models=$this->findAll(array(
			'condition'=>'label ILIKE :keyword',
			'limit'=>$limit,
			'params'=>array(':keyword'=>"$keyword%")
		));
		$suggest=array();
		foreach($models as $model) {
			$suggest[] = array(
				'label'=>$model->TreeBehavior->pathText,  // label for dropdown list
				'value'=>$model->label,  // value for input field
				'id'=>$model->id,       // return values from autocomplete
			);
		}
		return $suggest;
	}
	////////////////////////////////

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Typelist the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
