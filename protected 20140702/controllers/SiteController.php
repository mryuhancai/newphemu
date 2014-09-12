<?php

/**
 * Frontend WordController class file.
 */
class SiteController extends Controller
{   
    public $topid;
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
			'contactus'=>array(
				'class'=>'CViewAction',
				'basePath'=>'contactus',
			),
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
    public function actionIndex($sort = null)
    {
        $this->render('index');
    }
	 public function actionInfo()
    {   
			$criteria=new CDbCriteria(array(
			'condition'=>'tid=52',
			'order'=>'did desc',
		));		
		$dataProvider=new CActiveDataProvider('Document',array(
			'criteria'=>$criteria,
			));
		$this->render('Info/index',array(
			'dataProvider'=>$dataProvider,
		));
    }
    public function actionAbout()
    {   
		$this->render('about',array(
			//'dataProvider'=>$dataProvider,
		));
    }
      public function actionProduct($sort = null)
    {
	    $this->layout='onlyproduct';
        $this->render('products/index');
    }
    
    
    public function actionView()
    {
    	$tid=isset($_GET['tid']) ? $_GET['tid']:NULL;
		$lay=isset($_GET['topid'])? $_GET['topid']:NULL;
		$did=isset($_GET['did']) ? $_GET['did']:NULL;
		$title=isset($_GET['title'])?$_GET['title']:NULL;
		$id=isset($tid)?$tid:$did;
		$islink=isset($_GET['islink'])? TRUE:FALSE;
		IF($islink){
		$dataProvider=Document::model()->findByPk($id);
		}
		else{
		$dataProvider=Document::model()->findByAttributes(array('did'=>$id));
		}
    	$this->render('view',array(
				'model'=>$dataProvider,
				'lay'=>$lay,
    			 
    	));
    }
     
	    public function actionViewarticle()
    {
    	$tid=isset($_GET['tid']) ? $_GET['tid']:NULL;
		$lay=isset($_GET['topid'])? $_GET['topid']:NULL;
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
    			 
    	));
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

