<?php
defined('YII DEBUG') or define('YII DEBUG',true);
// change the following paths if necessary
$yii=dirname(__FILE__).'/../../framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following line when in production mode
// defined('YII_DEBUG') or define('YII_DEBUG',true);

//git@github.com:mryuhancai/z_phemu.git  
//https://github.com/mryuhancai/z_phemu.git
//   mryuhancai
//   loveyougithub464135111    GIT_CURL_VERBOSE=1 git clone https:<URL>

require_once($yii);
Yii::beginProfile('blockID');
Yii::createWebApplication($config)->run();
Yii::endProfile('blockID');

