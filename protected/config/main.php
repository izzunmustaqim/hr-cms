<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
error_reporting(0);
@ini_set('display_errors', 0);

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Billing Reminder Management System',
    'defaultController' => 'default',

    // preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        //'application.modules.srbac.controllers.SBaseController',
        'ext.YiiMailer.YiiMailer'
	),

	'modules'=>array(

        // modules
        'dashboard',
        'recruitment',
        'applications',
        'report',
        'offerletter',
        'attendance',
        'training',
        'permit',
        'claim',
        'staff',
        'setting',
        // MVC Generator
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'password',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),

        /*'srbac' => array(
            'userclass' 	=> 'Users',
            'userid' 		=> 'user_id',
            'username' 		=> 'user_login',
            'delimeter' 	=> '@',
            'debug' 		=> false,
            'pageSize' 		=> 50,
            'superUser' 	=> 'Administrator',
            'css' 		=> 'srbac.css',
            'layout' 		=> 'application.views.layouts.main',
            'notAuthorizedView' => 'srbac.views.authitem.unauthorized',
            'userActions' 	=> array('Show', 'View', 'List'),
            'listBoxNumberOfLines' => 15,
            'alwaysAllowedPath' => 'srbac.components',
        ),*/

	),

	// application components
	'components'=>array(

        // Allow cookie based login
        'user'=>array(
            'allowAutoLogin'=>false,
        ),

        // Friendly URL
        'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName' => false,
            'rules'=>array(
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ),
        ),

        // database settings are configured in database.php
        'db'=>require(dirname(__FILE__).'/database.php'),

        // Srbac Auth Manager
        'authManager'=>array(
            'class'=>'application.modules.srbac.components.SDbAuthManager',
            'connectionID'=>'db',
            'itemTable'=>'items',
            'assignmentTable'=>'assignments',
            'itemChildTable'=>'itemchildren',
        ),

        // use 'site/error' action to display errors
        'errorHandler'=>array(
			//'errorAction'=>YII_DEBUG ? null : 'site/error',
            'errorAction' => 'site/error'
		),
        'request' => array(
            'enableCsrfValidation' => true
        ),
        /*'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CProfileLogRoute',
                    'levels'=>'profile',
                    'enabled'=>true,
                ),
            ),
        ),*/

        /*'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CProfileLogRoute',
                    'levels'=>'profile',
                    'enabled'=>true,
                ),
            ),
        ),*/

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'azam.muhamadamin@city.edu.my',
	),
);
