<?php

Yii::app()->setTimeZone(APP_TIMEZONE);
Yii::setPathOfAlias('common',COMMON_FOLDER);
Yii::setPathOfAlias('cms',CMS_FOLDER);
Yii::setPathOfAlias('cmswidgets',CMS_WIDGETS);


return array(
	
	'id'=> SITE_NAME,
	//Edit more information for your site here
	'name'=> SITE_NAME ,        
    'sourceLanguage'=>'en',
    
	
	// preloading 'log' component
	'preload'=>array('log','translate'),

	// autoloading model and component classes
        // autoloading from the CMS and Common Folder
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'cms.components.*',
        'cms.extensions.*',
    
        //Import Specific CMS classes for CMS 
        'cms.components.user.*',
        'cmswidgets.*',                 
            
        //Import Common Classes                    
        'common.components.*',                                      
        'common.extensions.*',
        'common.models.*',                      
        'common.modules.*',
        'common.storages.*',
		          
		'common.models.user.*',
        'common.models.settings.*',
		        
        //Translate Module
        'common.modules.translate.TranslateModule',
        'common.modules.translate.controllers.*',
        'common.modules.translate.models.*',
        
		//Yii Mail Extensions
		'common.extensions.yii-mail.*',
		
        //Import Rights Modules
        'common.modules.rights.*',
        'common.modules.rights.models.*',
        'common.modules.rights.components.*',
        'common.modules.rights.RightsModule',                            
	),
	'modules'=>array(


		
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'admin',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),*/
		               
    //Import Translate Module
    'translate'=>array(
            'class'=>'common.modules.translate.TranslateModule',
    ),
        
	
    //Modules Rights
    'rights'=>array(
            'class'=>'common.modules.rights.RightsModule',
            'install'=>false,	// Enables the installer.
            'appLayout'=>'application.views.layouts.main',
            'superuserName'=>'Admin'
        ),               
                    
	),

	// application components
	'components'=>array(
	
			'file'=>array(
        		'class'=>'common.extensions.file.CFile',
   			 	),
	                 
			//Edit your Database Connection here	
			//Use MySQL database		
			'db'=>array(
	                'connectionString' => 'mysql:host=localhost;dbname=ds-db',
	                'schemaCachingDuration' => 3600,
	                'emulatePrepare' => true,
	                'username' => 'root',
	                'password' => '',
	                'charset' => 'utf8',
	                'tablePrefix' => 'tbl_'
	            ),
                 
	        //User Componenets
			'user'=>array(
	            'class'=>'cms.components.user.GxcUser',
				// enable cookie-based authentication
				'allowAutoLogin'=>true,
	            'loginUrl'=>FRONT_SITE_URL.'/sign-in',                        
	            'stateKeyPrefix'=>'tbl_system_user_front',
			),
			
			'mail' => array(
        		'class' => 'common.extensions.yii-mail.YiiMail',
        		'transportType'=>'php',
        		'viewPath' => '',
				'logging' => true,
	 			'dryRun' => false        		
			),
	        
	        //Auth Manager
	        'authManager'=>array(
	                'class'=>'common.modules.rights.components.RDbAuthManager',
	                'defaultRoles'=>array('Guest','Authenticated')
	        ),
	            
            //Use Cache System by File
            'cache'=>array(
                'class'=>'system.caching.CFileCache',
            ),
                
            //Use the Settings Extension and Store value in Database
            'settings'=>array(
                'class'     => 'cms.extensions.settings.CmsSettings',
                'cacheId'   => 'global_website_settings',
                'cacheTime' => 84000,
            ),
		   
		   'phpThumb'=>array(
    			'class'=>'common.extensions.EPhpThumb.EPhpThumb',
    			'options'=>array(),
		   ),
                			
		 
		/* 
        //Use Session Handle in Database
        'session' => array(
                'class' => 'CDbHttpSession',
                'connectionID' => 'db',
                'autoCreateSessionTable'=>true,
                'sessionTableName'=>'tbl_session',
        ),
		 * 
		 */
            

        //Error Action when having Errors
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
                
        //Log the Site Error, Warning and Store into File
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				 * 
				 */
				
			),
		),
                
        // Use Message in Database and Translate Components
        'messages'=>array(
            'class'=>'CDbMessageSource',
            'sourceMessageTable'=>'tbl_source_message',
            'translatedMessageTable'=>'tbl_translated_message',
            'onMissingTranslation' => array('TranslateModule', 'missingTranslation'),
        ),
                
        'translate'=>array(
            'class'=>'common.modules.translate.components.MPTranslate',
            //any avaliable options here
            'acceptedLanguages'=>array(
                'en'=>'English'                                                                          
            ),
        ),
                
        //Enable Cookie Validation and Csrf Validation
        'request'=>array(
            'class'=>'HttpRequest',
            'enableCookieValidation'=>true,
            'enableCsrfValidation'=> true,
            'noCsrfValidationRoutes'=>array('site/caching')
        ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
    // Don't use this, use the settings Components
	'params'=>array(
		'page_url'=>'',
		'adminEmail'=>'info@google.com',
	),
);