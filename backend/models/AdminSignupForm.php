<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Admin signup form
 */
class AdminSignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_confirm;

    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 8, 'max' => 128],
            ['password_confirm', 'required'],
            ['password_confirm', 'compare', 'compareAttribute' => 'password', 'message' => '两次密码输入不一致'],
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->status = User::STATUS_ACTIVE;
        return $user->save();
    }
}
