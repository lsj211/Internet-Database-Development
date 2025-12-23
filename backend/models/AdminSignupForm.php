<?php
/**
 * Team: 抗战纪念队, NKU
 * Coding by LuoShijie 2313965
 * Form model for updating an admin user's profile data,including optional password changes and avatar upload.
 */

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;


class AdminSignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_confirm;
    public $emailVerifyCode;
    public $student_id;

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
            ['student_id', 'string', 'max' => 50],
            ['emailVerifyCode', 'required', 'message' => '请输入邮箱验证码'],
            ['emailVerifyCode', 'validateEmailCode'],
        ];
    }

    public function validateEmailCode($attribute, $params)
    {
        $session = Yii::$app->session;
        $savedCode = $session->get('admin_email_verify_code_' . $this->email);
        $expireTime = $session->get('admin_email_verify_code_time_' . $this->email);

        if (!$savedCode || !$expireTime) {
            $this->addError($attribute, '请先获取邮箱验证码');
            return;
        }

        if (time() - $expireTime > 600) {
            $this->addError($attribute, '验证码已过期，请重新获取');
            return;
        }

        if ($this->$attribute !== $savedCode) {
            $this->addError($attribute, '邮箱验证码不正确');
        }
    }

    public function sendEmailCode()
    {
        if (!$this->email) {
            return false;
        }

        $code = sprintf('%06d', mt_rand(0, 999999));
        $session = Yii::$app->session;
        $session->set('admin_email_verify_code_' . $this->email, $code);
        $session->set('admin_email_verify_code_time_' . $this->email, time());

        return Yii::$app->mailer->compose()
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
            ->setTo($this->email)
            ->setSubject('管理员注册验证码')
            ->setHtmlBody(
                "<h3>管理员注册验证码</h3>" .
                "<p>验证码：<strong style='font-size:24px;color:#ff0000;'>" . $code . "</strong></p>" .
                "<p>验证码有效期为10分钟，请及时使用。</p>"
            )
            ->send();
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->student_id = $this->student_id;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->status = User::STATUS_ACTIVE;
        return $user->save();
    }
}
