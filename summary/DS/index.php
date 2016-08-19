<?php
set_time_limit(300);
// remove the following lines when in production mode
//defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
// defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
// Set the constant for the FRONT_STORE Directory
// Don't change if you are not sure
//You need to specify the path to CORE FOLDER CORRECTLY

define('COMMON_FOLDER',dirname(__FILE__).DIRECTORY_SEPARATOR.'common');
define('RESOURCES_FOLDER',dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'resources');
define('THUMBS_FOLDER',dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'resources');
define('AVATAR_FOLDER',dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'avatar');
define('CMS_FOLDER',dirname(__FILE__).DIRECTORY_SEPARATOR.'protected');
define('CMS_WIDGETS',CMS_FOLDER.DIRECTORY_SEPARATOR.'widgets');
define('BACK_END',dirname(__FILE__).DIRECTORY_SEPARATOR.'protected');
define('BACK_STORE',dirname(__FILE__));
define('OP_PREFIX','MR');
define('IP_PREFIX','IP');


// change the following paths if necessary
$yii = dirname(__FILE__).'/yii/framework/yii.php';
$globals = COMMON_FOLDER.'/globals.php';
$define = COMMON_FOLDER.'/define.php';
$config = BACK_END.'/config/main.php';

require_once($yii);
require_once($globals);
require_once($define);

Yii::createWebApplication($config)->run();



