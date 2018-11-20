<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'vendorPath' => '../vendor',
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'assetManager' => [
            'linkAssets' => true,
            'forceCopy' => false,
            'appendTimestamp' => true,
            'bundles' => [
                /*  'yii\web\JqueryAsset' => [
                      'js' => [
                          YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js'
                      ]
                  ],
                  'yii\bootstrap\BootstrapAsset' => [
                      'css' => [
                          YII_ENV_DEV ? 'css/bootstrap.css' :         'css/bootstrap.min.css',
                      ]
                  ],
                  'yii\bootstrap\BootstrapPluginAsset' => [
                      'js' => [
                          YII_ENV_DEV ? 'js/bootstrap.js' : 'js/bootstrap.min.js',
                      ]
                  ]*/
            ],

        ],


        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '15kAg6f#AdfLn8k@h',
        ],
        'cache' => [
            //'class' => 'yii\caching\DummyCache',
            'class' => 'yii\caching\FileCache',
            //'class' => 'yii\caching\DbCache',
            //'db' => 'db',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            'on beforeLogin' => function ($event) {
                Yii::info("Before login");
                Yii::$app->db->createCommand()->delete('session', ['user_id' => $event->identity->id])->execute();

            },
            'on afterLogin' => function ($event) {
                Yii::info("After login");

            },
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
            'enableSwiftMailerLogging' => true,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'server1.arabspages.com',
                'username' => 'info@arabspages.com',
                'password' => 'Asdasdasd1!',
                'port' => '587',
                'encryption' => 'tls',
            ],
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
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'defaultRoles' => ['admin', 'standard', 'entry'],
        ],
        'session' => [
            'class' => 'yii\web\DbSession',

            // Set the following if you want to use DB component other than
            // default 'db'.
            //'db' => 'db',

            // To override default session table, set the following
            //'sessionTable' => 'session',
            'writeCallback' => function ($session) {
                return [
                    'user_id' => Yii::$app->user->id,
                    'last_write' => time(),
                ];
            },
        ],

    ],
    'params' => $params,
    'modules' => [
        'gridview' => [
            'class' => 'kartik\grid\Module',
            // other module settings
        ]
    ]
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '45.242.210.185', '45.242.80.38', '45.242.9.121', '45.242.75.220', '45.242.7.37', '45.242.219.247', '45.242.112.175'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;