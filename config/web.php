<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'language' => 'fr',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'modules' => [
        'ckeditor' => [
            'class' => 'wadeshuler\ckeditor\Module',
            //'controllerNamespace' => 'wadeshuler\ckeditor\controllers\default',    // to override my controller
            //'preset' => 'basic',    // default: basic - options: basic, standard, standard-all, full, full-all
            //'customCdn' => '//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.10/ckeditor.js',    // must point to ckeditor.js
            //'customCdn' => '//cdn.ckeditor.com/4.10.0/full/ckeditor.js',    // must point to ckeditor.js
            'customCdn' => ' ',    // must point to ckeditor.js

            'uploadDir' => '@app/web/uploads',    // must be file path (required when using filebrowser*BrowseUrl below)
            'uploadUrl' => '@web/uploads',        // must be valid URL (required when using filebrowser*BrowseUrl below)

            // how to add external plugins (must also list them in `widgetClientOptions` `extraPlugins` below)
            //'widgetExternalPlugins' => [
            //    ['name' => 'pluginname', 'path' => '/path/to/', 'file' => 'plugin.js'],
            //    ['name' => 'pluginname2', 'path' => '/path/to2/', 'file' => 'plugin.js'],
            //],

            // passes html options to the text area tag itself. Mostly useless as CKEditor hides the <textarea> and uses it's own div
            'widgetOptions' => [
                'rows' => '100',
            ],

            // These are basically passed to the `CKEDITOR.replace()`
            'widgetClientOptions' => [
                //'skin' => 'office2013,@web/ckeditor/skins/office2013/',    // must be in skins directory
                //'skin' => 'kama,http://cdn.ckeditor.com/4.5.10/standard-all/skins/kama/',    // skin from somehwere else - http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-skin
                //'extraPlugins' => 'abbr,inserthtml',     // list of externalPlugins (loaded from `widgetExternalPlugins` above)
                'customConfig' => '@web/ckeditor/myconfig.js',
                'filebrowserBrowseUrl' => '/ckeditor/default/file-browse',
                'filebrowserUploadUrl' => '/ckeditor/default/file-upload',
                'filebrowserImageBrowseUrl' => '/ckeditor/default/image-browse',
                'filebrowserImageUploadUrl' => '/ckeditor/default/image-upload',
            ]
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
    ],

    'components' => [
    'assetManager' => [
        'bundles' => [
            'dosamigos\google\maps\MapAsset' => [
                'options' => [
                    //AIzaSyBzEU5o4tu97TNBEKflPQiDM5OkcB6xX1k
                    'key' => '',
                    'libraries' => 'places',
                    'language'=>'fr',
                    'v' => '3.exp',
                ]
            ]
        ]
    ],
    'view' => [
        'theme' => [
            'pathMap' => [
                '@dosamigos/fileupload/views' => '@app/views/fileupload'
            ]
        ]
    ],
    'request' => [
        // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
        'cookieValidationKey' => 'IAIGL3',
    ],
    'cache' => [
        'class' => 'yii\caching\FileCache',
    ],
    'user' => [
        'identityClass' => 'app\models\Utilisateur',
        'enableAutoLogin' => true,
    ],
    'errorHandler' => [
        'errorAction' => 'site/error',
    ],
    'mailer' => [
        'class' => 'yii\swiftmailer\Mailer',
        // send all mails to a file by default. You have to set
        // 'useFileTransport' to false and configure a transport
        // for the mailer to send real emails.
        'useFileTransport' => true,
    ],
    'log' => [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'targets' => [
            [
                'class' => 'yii\log\FileTarget',
                'levels' => ['error', 'warning'],
            ],
        ],
    ],
    'db' => $db,

    'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => [
            '<alias:\w+>' => 'site/<alias>',
        ],
    ],

    /*'as beforeRequest'=>[
        'class'=>'app\components\CheckIfLoggedIn',
    ],*/

],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
