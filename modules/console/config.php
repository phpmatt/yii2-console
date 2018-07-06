<?php
return [
  'name' => 'YiiConsole',
  'defaultRoute' => 'site',
  'homeUrl' => '/console/site',
  'components' => [
    'user' => [
      'class' => \yii\web\User::class,
      'identityClass' => 'app\modules\console\models\Admin',
      'enableAutoLogin' => true,
      'loginUrl' => ['/console/site/login']
    ],
    'view' => [
      'class' => \yii\web\View::class,
      'theme' => [
        'pathMap' => [
          '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
        ],
      ],
    ],
  ]
];