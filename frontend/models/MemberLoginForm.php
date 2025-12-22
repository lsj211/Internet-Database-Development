<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Member;

/**
 * Member login form
 */
class MemberLoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    public $verifyCode;

    private $_user;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
            ['verifyCode', 'captcha'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if ($this->hasErrors()) {
            return;
        }

        $user = $this->getUser();
        if (!$user || !$user->validatePassword($this->password)) {
            $this->addError($attribute, 'Incorrect username or password.');
        }
    }

    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }

        return false;
    }

    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Member::findByUsername($this->username);
        }

        return $this->_user;
    }
}
