<?php
namespace app\modules\console\models;

use yii\base\Model;

class LoginForm extends Model
{
  public $username;
  public $password_hash;
  public $verifyCode;
  private $_user = false;
  public $rememberMe;

  public function rules()
  {
    return array_merge(parent::rules(), [
      [['username', 'password_hash', 'verifyCode'], 'required'],
      ['password_hash', 'validatePassword'],
      ['verifyCode', 'captcha', 'captchaAction' => '/console/site/captcha']
    ]);
  }

  public function attributeLabels()
  {
    return [
      'username' => '用户名',
      'password_hash' => '密码',
      'verifyCode' => '验证码'
    ];
  }


  /**
   * Logs in a user using the provided username and password.
   * @return bool whether the user is logged in successfully
   */
  public function login()
  {
    if ($this->validate()) {
      return \Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
    }
    return false;
  }

  /**
   * Finds user by [[username]]
   *
   * @return Admin|null
   */
  public function getUser()
  {
    if ($this->_user === false) {
      $this->_user = Admin::findByUsername($this->username);
    }
    return $this->_user;
  }

  /**
   * Validates the password.
   * This method serves as the inline validation for password.
   *
   * @param string $attribute the attribute currently being validated
   * @param array $params the additional name-value pairs given in the rule
   */
  public function validatePassword($attribute, $params)
  {
    if (!$this->hasErrors()) {
      $user = $this->getUser();

      if (!$user || !$user->validatePassword($this->password_hash)) {
        $this->addError($attribute, '用户名或密码错误.');
      }
    }
  }

  public function updateUserLoginInfo()
  {
    $user = Admin::findOne(\Yii::$app->user->getId());
    if ($user)
    {
      $user->login_ip = \Yii::$app->request->getRemoteIP();
      $user->updated_at = time();
      return $user->save();
    }
    return false;
  }
}