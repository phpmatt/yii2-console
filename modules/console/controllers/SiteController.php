<?php

namespace app\modules\console\controllers;

use Yii;
use app\modules\console\models\LoginForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Default controller for the `console` module
 */
class SiteController extends Controller
{


    public function behaviors()
    {
      return [
        'access' => [
          'class' => AccessControl::class,
          'only' => ['index', 'logout'],
          'rules' => [
            [
              'actions' => ['index', 'logout'],
              'allow' => true,
              'roles' => ['@']
            ]
          ]
        ]
      ];
    }

  /**
     * {@inheritdoc}
     */
    public function actions()
    {
      return [
        'error' => [
          'class' => 'yii\web\ErrorAction',
        ],
        'captcha' => [
          'class' => 'yii\captcha\CaptchaAction',
          'minLength' => 4,
          'maxLength' => 5,
          'width' => 150,
          'height' => 34,
          'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
        ],
      ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

  /**
   * Login action.
   *
   * @return Response|string
   */
  public function actionLogin()
  {
    if (!Yii::$app->user->isGuest) {
      return $this->goHome();
    }

    $model = new LoginForm();
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
      return $this->goBack();
    }

    $model->password_hash = '';
    return $this->render('login', [
      'model' => $model,
    ]);
  }

  /**
   * Logout action.
   *
   * @return Response
   */
  public function actionLogout()
  {
    Yii::$app->user->logout();

    return $this->redirect(['/console/site/login']);
  }
}
