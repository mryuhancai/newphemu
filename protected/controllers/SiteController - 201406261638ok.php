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
    public function actionAbout($sort = null)
    {   
        $this->render('about');
    }
      public function actionProduct($sort = null)
    {
	    $this->layout='onlyproduct';
        $this->render('products/index');
    }
    
    
    public function actionView()
    {
		$about=$this->loadModel();
    	$this->render('view',array(
    			'model'=>$about,
				'gettopid'=>$_GET['topid'],
    			 
    	));
    }
     
    public function loadModel()
    {
    	$tid=$_GET['tid'];
    	$this->islink=$_GET['islink'];
    	$criteria = new CDbCriteria(array('order'=>'did DESC'));
    	if($this->islink){
    		$this->_model=DocumentContent::model()->findByAttributes(array('did'=>$_GET['tid']));
    		if($this->_model===null)
    			throw new CHttpException(404,'The requested page does not exist.');
    	}
    	else{
    		$this->_model=Document::model()->findAllByAttributes(array('tid'=>$_GET['tid']),$criteria);
    	}
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

