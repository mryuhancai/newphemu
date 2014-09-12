<?php

/**
 * Frontend WordController class file.
 */
class SiteController extends Controller
{   
    public $upid;
	public $topid;
	public $menu;
	public $s;
    public $layout='leftbar';
    public $tid;
    public $islink;
    private $_model;
	const PAGE_SIZE = 30;
	function init()
	{
		parent::init();
		
	}
	
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image
			// this is used by the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xf9f9f9,
			),
			// widget action renders "static" pages stored under 'protected/views/site/widgets'
			// They can be accessed via: index.php?r=site/widget&view=FileName
 			'widget'=>array(
				'class'=>'CViewAction',
				'basePath'=>'widgets',
			), 
			'service'=>array(
				'class'=>'CViewAction',
				'basePath'=>'service',
			),
			'info'=>array(
					'class'=>'CViewAction',
					'basePath'=>'info',
			),
			'support'=>array(
				'class'=>'CViewAction',
				'basePath'=>'support',
			),
			'project'=>array(
				'class'=>'CViewAction',
				'basePath'=>'project',
			),
			'module'=>array(
				'class'=>'CViewAction',
				'basePath'=>'modules',
			),
	/* 		'contactus'=>array(
				'class'=>'CViewAction',
				'basePath'=>'contactus',
			), */
			// ajaxContent action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/ajaxContent&view=FileName
			'ajaxContent'=>array(
				'class'=>'ext.actions.XAjaxViewAction',
			),
		);
	}
    /**
     * @see CController::filters()
     */
    public function filters()
    {
        return array_merge(parent::filters(), array(
            'postOnly + delete',
        ));
    }

    /**
     * @see CController::accessRules()
     */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('index','contact','login','logout','error','captcha','widget','extension','module','design','ajaxContent'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('upload','movePersons'),
				'ips'=>$this->ips,
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    /**
     * Lists all words.
     * @param string $sort strings of sort
     */
	public function actionIndex()
	{
		$this->layout='index';
		$tid=isset($_GET['tid']) ? $_GET['tid']:NULL;
		$model=new Document();	  
		$criteria=new CDbCriteria;
		if(!$tid)
			{
			$criteria->condition='tid=:id';		
			$criteria->params=array(':id'=>52);
			$criteria->order='addtime DESC';
			}
		
		$total = $model->count($criteria);
		$pages=new CPagination($total);
		$pages->pageSize=5;
		$pages->applyLimit($criteria);
		$list = $model->with('hm_dc_did')->findAll($criteria);
		$this->render('index',array(
				'list'=>$list,
				'pages'=>$pages,
				//'display'=>$display,
				//'model'=>$dataProvider,	 
    	));
	}
	 public function actionInfo()
    {  	    
		$tid=isset($_GET['tid']) ? $_GET['tid']:NULL;
		$did=isset($_GET['did']) ? $_GET['did']:NULL;
		$display=isset($_GET['display'])?$_GET['display']:NULL;
		$model=new Document();	  
		$criteria=new CDbCriteria;
		if(!$tid)
			{
			$criteria->condition='tid=:id';		
			$criteria->params=array(':id'=>52);
			$criteria->order='addtime DESC';
			}
		else
			{
			$criteria->condition='tid=:id';		
			$criteria->params=array(':id'=>$tid);
			$criteria->order='addtime DESC';
			}
		$total = $model->count($criteria);
		$pages=new CPagination($total);
		$pages->pageSize=5;
		$pages->applyLimit($criteria);
		$list = $model->with('hm_dc_did')->findAll($criteria);
		$dataProvider=Document::model()->findByAttributes(array('did'=>$did));
    	$this->render('info',array(
				'list'=>$list,
				'pages'=>$pages,
				'display'=>$display,
				'model'=>$dataProvider,	 
    	));
    }
	
	public function actionProject()
    {   
	    
		$tid=isset($_GET['tid']) ? $_GET['tid']:NULL;
		$did=isset($_GET['did']) ? $_GET['did']:NULL;
		$display=isset($_GET['display'])?$_GET['display']:NULL;
		$model=new Document();	  
		$criteria=new CDbCriteria;
		if(!$tid)
			{
			$criteria->condition='tid=:id';		
			$criteria->params=array(':id'=>48);
			$criteria->order='addtime DESC';
			}
		else
			{
			$criteria->condition='tid=:id';		
			$criteria->params=array(':id'=>$tid);
			$criteria->order='addtime DESC';
			}
		$total = $model->count($criteria);
		$pages=new CPagination($total);
		$pages->pageSize=5;
		$pages->applyLimit($criteria);
		$list = $model->with('hm_dc_did')->findAll($criteria);
		$dataProvider=Document::model()->findByAttributes(array('did'=>$did));
	   	$this->render('Project',array(
				'list'=>$list,
				'pages'=>$pages,
				'display'=>$display,
				'model'=>$dataProvider,	 
    	));
    }
	
    public function actionAbout()
    {   
	    $tid=isset($_GET['tid']) ? $_GET['tid']:NULL;
		if(!$tid)
		$dataProvider=Document::model()->findByPk(1);	
		else
		$dataProvider=Document::model()->findByPk($tid);
    	$this->render('about',array(
				'model'=>$dataProvider,
				//'lay'=>$lay,    			 
    	));
    }
	 public function actionMemcache()
    {   
    	$this->render('Memcache');
    }	
    public function actionMemcachetest()
    {   
    	$this->render('Memcachetest');
    }
	
	    public function actionContactus()
    {   
	    $tid=isset($_GET['tid']) ? $_GET['tid']:NULL;
		if(!$tid)
		$dataProvider=Document::model()->findByPk(17);	
		else
		$dataProvider=Document::model()->findByPk($tid);
    	$this->render('contactus',array(
				'model'=>$dataProvider,
				//'lay'=>$lay,    			 
    	));
    }
	    public function actionSupport()
    {   
	    $tid=isset($_GET['tid']) ? $_GET['tid']:NULL;
		if(!$tid)
		$dataProvider=Document::model()->with('hm_dc_did')->findByAttributes(array('tid'=>42));	
		else
		$dataProvider=Document::model()->with('hm_dc_did')->findByAttributes(array('tid'=>$tid));
    	$this->render('Support',array(
				'model'=>$dataProvider,
				//'lay'=>$lay,    			 
    	));
    }
	
        public function actionService()
    {   
	    $tid=isset($_GET['tid']) ? $_GET['tid']:NULL;
		if(!$tid)
		$dataProvider=Document::model()->with('hm_dc_did')->findByAttributes(array('tid'=>35));	
		else
		$dataProvider=Document::model()->with('hm_dc_did')->findByAttributes(array('tid'=>$tid));
    	$this->render('Service',array(
				'model'=>$dataProvider,
				//'lay'=>$lay,    			 
    	));
    }
    public function actionProduct($sort = null)
    {
		$tid=isset($_GET['tid']) ? $_GET['tid']:NULL;
		$model=new Document();	  
		$criteria=new CDbCriteria;
		if(!$tid)
			{
			$criteria->condition='tid=:id';		
			$criteria->params=array(':id'=>9);
			$criteria->order='addtime DESC';
			}
		else
			{
			$criteria->condition='tid=:id';		
			$criteria->params=array(':id'=>$tid);
			$criteria->order='addtime DESC';
			}
		$total = $model->count($criteria);
		$pages=new CPagination($total);
		$pages->pageSize=6;
		$pages->applyLimit($criteria);
		$list = $model->with('hm_dc_did')->findAll($criteria);
	   	$this->render('Products',array(
				'list'=>$list,
				'pages'=>$pages,
    	));
    }   
    public function actionView()
    {
    	$tid=isset($_GET['tid']) ? $_GET['tid']:NULL;
		$did=isset($_GET['did']) ? $_GET['did']:NULL;
		$title=isset($_GET['title'])?$_GET['title']:NULL;
		$id=isset($tid)?$tid:$did;
  
		$model=new Document();	  
		$criteria=new CDbCriteria;
	
			$criteria->condition='tid=:id';		
			$criteria->params=array(':id'=>$id);
			$criteria->order='addtime DESC';
		
		$total = $model->count($criteria);
		$pages=new CPagination($total);
		$pages->pageSize=5;
		$pages->applyLimit($criteria);
		$list = $model->with('hm_dc_did')->findAll($criteria);
		
		
		$dataProvider=Document::model()->findByAttributes(array('did'=>$id));
    	$this->render('view',array(
		        'list'=>$list,
				'pages'=>$pages,
				'model'=>$dataProvider,	 
				
    	));
    }
	public function actionViewarticle()
    {
 /*    	$tid=isset($_GET['tid']) ? $_GET['tid']:NULL;
		$lay=isset($_GET['which'])? $_GET['which']:NULL;
		$did=isset($_GET['did']) ? $_GET['did']:NULL;
		$title=isset($_GET['title'])?$_GET['title']:NULL;
		$id=isset($tid)?$tid:$did;
		$islink=isset($_GET['islink'])? TRUE:FALSE;		
			$criteria=new CDbCriteria(array(
			'condition'=>'tid=:tid',
			'params'=>array(':tid'=>$tid),
			'order'=>'did desc',
			));		
		$dataProvider=new CActiveDataProvider('Document',array(
			'criteria'=>$criteria,
			));
    	$this->render('viewarticle',array(
				'model'=>$dataProvider,
				'lay'=>$lay,
                'thisthis'=>$this,				
    	)); */
    }	 
    public function loadModel()
    {
    	return $this->_model;
    }
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
}

