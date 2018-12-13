<?php

$db     = require(dirname(dirname(__DIR__)) . '/config/db.php');
$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name' => 'TimeTracker',
    // Need to get one level up:
    'basePath' => dirname(dirname(__DIR__)),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // Enable JSON Input:
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'cookieValidationKey' => 'gatcoa7tawuS7QfScBh3Rm_tBb3u851-',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    // Create API log in the standard log dir
                    // But in file 'api.log':
                    'logFile' => '@app/runtime/logs/api.log',
                ]
                /*, [
                    'class' => 'yii\log\FileTarget',
                    'logFile' => '@runtime/logs/profile.log',
                    'logVars' => [],
                    'levels' => ['profile'],
//                    'categories' => ['yii\db\Command::execute'],
                    'categories' => ['yii\db\*'],
                ]*/
                ,
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule',
                    'controller' => ['v1/cuser','v1/request', 'v1/offer'],
                    'pluralize' => false,
                    'tokens' => [
                        '{id}' => '<id:\\w+>',
                        '{cur_lat}' => '<cur_lat:\\w+>',
                        '{cur_lng}' => '<cur_lng:\\w+>'
                    ],
                    'extraPatterns' => [
                        'GET query' => 'query',//todob this is cuser query
                        'GET random' => 'random',//todob this is cuser query
                        'GET testpush' => 'testpush',//todob this is cuser query
                        'GET testpushdirect' => 'testpushdirect',//todob this is cuser query
                        'POST reset' => 'reset',//todob this is cuser query
                    ],

                ],

            ]
        ],
        'db' => $db,
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],

    ],
    'modules' => [
        'v1' => [
            'class' => 'app\api\modules\v1\Module',
            'basePath' => '@app/api/modules/v1',
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module',
        ]
    ],
    'params' => $params,
];

return $config;
