<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        [
            'class' => 'yii2mod\braintree\BraintreeBootstrap',
            'environment' => 'sandbox',
            'merchantId' => '79dnq2885xjssg4h',
            'publicKey' => '3d7cf6bnt8xtgjd7',
            'privateKey' => '6d78c9dfde15d2b3ca1da1097a150f11',
        ],
    ],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'cart' => [
            'class' => 'yz\shoppingcart\ShoppingCart',
            'cartId' => 'rubi_cart',
        ],
        'braintree' => [
            'class' => 'tuyakhov\braintree\Braintree',
            'merchantId' => '79dnq2885xjssg4h',
            'publicKey' => '3d7cf6bnt8xtgjd7',
            'privateKey' => '6d78c9dfde15d2b3ca1da1097a150f11',
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];
