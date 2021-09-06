<?php
date_default_timezone_set('UTC');
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
Yii::setAlias('api', dirname(dirname(__DIR__)) . '/api'); // add api alias
$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'modules' => [
        'v1' => [
            'class' => 'app\modules\v1\Module'   // here is our v1 modules
        ]
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'UnB23LcooFdbgSdcKN20todzJ7wwLKe3',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/users',
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                    ],
                    'extraPatterns' => [
                        'GET {id}' => 'find-one',
                        'POST signin' => 'signin',
                        'PUT {id}' => 'update',
                        'DELETE {id}' => 'delete',
                        'GET getAllData/{id}' => 'get-all-data',
                        'GET findList' => 'find-list',
                        'GET findListByToken' => 'find-list-by-token',
                        'DELETE forms/{id}' => 'delete-forms'
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/basicshoes',
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                    ],
                    'extraPatterns' => [
                        'GET {id}' => 'find-one',
                        'POST {id}' => 'create',
                        'PUT {id}' => 'update',
                        'DELETE {id}' => 'delete'
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/advshoes',
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                    ],
                    'extraPatterns' => [
                        'GET {id}' => 'find-one',
                        'POST {id}' => 'create',
                        'PUT {id}' => 'update',
                        'DELETE {id}' => 'delete'
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/medicals',
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                    ],
                    'extraPatterns' => [
                        'GET {id}' => 'find-one',
                        'GET single/{id}' => 'find-one-by-mh-id',
                        'POST {id}' => 'create',
                        'PUT {id}' => 'update',
                        'PUT byMhId/{id}' => 'update-by-mh-id',
                        'DELETE {id}' => 'delete'
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/museva',
                    'pluralize' => false,    // 設置為 false 即可去除複數型態
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                    ],
                    'extraPatterns' => [
                        'GET {id}' => 'find-one',
                        'POST {id}' => 'create',
                        'PUT {id}' => 'update',
                        'DELETE {id}' => 'delete'
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/funceva',
                    'pluralize' => false,    // 設置為 false 即可去除複數型態
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                    ],
                    'extraPatterns' => [
                        'GET {id}' => 'find-one',
                        'POST {id}' => 'create',
                        'PUT {id}' => 'update',
                        'DELETE {id}' => 'delete'
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/forms',
                    'except' => ['index', 'create', 'delete', 'update'],
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                    ],
                    'extraPatterns' => [
                        'GET brands' => 'brand',
                        'POST brand' => 'brand-create',
                        'PUT brand/{id}' => 'brand-update',
                        'DELETE brand/{id}' => 'brand-delete',
                        'GET bottomDesign' => 'bottom-design',
                        'POST bottomDesign' => 'bottom-design-create',
                        'PUT bottomDesign/{id}' => 'bottom-design-update',
                        'DELETE bottomDesign/{id}' => 'bottom-design-delete',
                        'GET injuredCodes/beg' => 'injured-codes-beg',
                        'POST injuredCodes/beg' => 'injured-codes-beg-create',
                        'PUT injuredCodes/beg/{id}' => 'injured-codes-beg-update',
                        'DELETE injuredCodes/beg/{id}' => 'injured-codes-beg-delete',
                        'GET injuredCodes/mid' => 'injured-codes-mid',
                        'POST injuredCodes/mid' => 'injured-codes-mid-create',
                        'PUT injuredCodes/mid/{id}' => 'injured-codes-mid-update',
                        'DELETE injuredCodes/mid/{id}' => 'injured-codes-mid-delete',
                        'GET injuredCodes/end' => 'injured-codes-end',
                        'POST injuredCodes/end' => 'injured-codes-end-create',
                        'PUT injuredCodes/end/{id}' => 'injured-codes-end-update',
                        'DELETE injuredCodes/end/{id}' => 'injured-codes-end-delete',
                        'GET diagCodes' => 'diag-codes',
                        'POST diagCodes' => 'diag-codes-create',
                        'PUT diagCodes/{id}' => 'diag-codes-update',
                        'DELETE diagCodes/{id}' => 'diag-codes-delete'
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/psycho',
                    'pluralize' => false,    // 設置為 false 即可去除複數型態
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                    ],
                    'extraPatterns' => [
                        'GET {id}' => 'find-one',
                        'POST {id}' => 'create',
                        'PUT {id}' => 'update',
                        'DELETE {id}' => 'delete'
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/extra',
                    'pluralize' => false,    // 設置為 false 即可去除複數型態
                    'tokens' => [
                        '{id}' => '<id:\\d+>',
                    ],
                    'extraPatterns' => [
                        'GET {id}' => 'find-one',
                        'POST {id}' => 'create',
                        'PUT {id}' => 'update',
                        'DELETE {id}' => 'delete'
                    ],
                ]
            ],
        ],
        'jwt' => [
            'class' => 'sizeg\jwt\Jwt',
            'key'   => 'c3n5d7t9c5h6m3y9p2i0d1e7a',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\modules\v1\models\Users',
            'enableAutoLogin' => true,
            'enableSession' => false,
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
    ],
    'params' => $params,
];

if (!YII_ENV_DEV) {
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
        'allowedIPs' => ['*'],
    ];
}

return $config;
