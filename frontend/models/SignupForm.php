<?php

/**
 * Team: DBIS, NKU
 * Coding by chengna 2311828
 * This file is used to handle user signup.
 */
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_confirm;
    public $verifyCode;        // 图片验证码
    public $emailVerifyCode;   // 邮箱验证码


    /**
     * {@inheritdoc}
     */
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
            ['password', 'validatePasswordStrength'],

            ['password_confirm', 'required'],
            ['password_confirm', 'compare', 'compareAttribute' => 'password', 'message' => '两次密码输入不一致'],

            ['verifyCode', 'required'],
            ['verifyCode', 'captcha'],

            ['emailVerifyCode', 'required', 'message' => '请输入邮箱验证码'],
            ['emailVerifyCode', 'validateEmailCode'],
        ];
    }

    /**
     * 验证密码强度（必须包含大小写字母、数字，达到中等强度）
     */
    public function validatePasswordStrength($attribute, $params)
    {
        $password = $this->$attribute;
        
        $hasLower = preg_match('/[a-z]/', $password);
        $hasUpper = preg_match('/[A-Z]/', $password);
        $hasNumber = preg_match('/[0-9]/', $password);
        
        $strength = $hasLower + $hasUpper + $hasNumber;
        
        if ($strength < 3) {
            $this->addError($attribute, '密码强度不足！密码必须同时包含大写字母、小写字母和数字');
        }
    }

    /**
     * 验证邮箱验证码
     */
    public function validateEmailCode($attribute, $params)
    {
        $session = Yii::$app->session;
        $savedCode = $session->get('email_verify_code_' . $this->email);
        $expireTime = $session->get('email_verify_code_time_' . $this->email);
        
        if (!$savedCode || !$expireTime) {
            $this->addError($attribute, '请先获取邮箱验证码');
            return;
        }
        
        // 验证码10分钟有效
        if (time() - $expireTime > 600) {
            $this->addError($attribute, '验证码已过期，请重新获取');
            return;
        }
        
        if ($this->$attribute !== $savedCode) {
            $this->addError($attribute, '邮箱验证码不正确');
        }
    }

    /**
     * 发送邮箱验证码
     * @return bool
     */
    public function sendEmailCode()
    {
        if (!$this->email) {
            return false;
        }
        
        // 生成6位数字验证码
        $code = sprintf('%06d', mt_rand(0, 999999));
        
        // 保存到session，10分钟有效
        $session = Yii::$app->session;
        $session->set('email_verify_code_' . $this->email, $code);
        $session->set('email_verify_code_time_' . $this->email, time());
        
        // 发送邮件
        return Yii::$app->mailer->compose()
            ->setFrom(['1461167893@qq.com' => 'Internet Database System'])
            ->setTo($this->email)
            ->setSubject('注册验证码')
            ->setHtmlBody(
                "<h3>您的注册验证码</h3>" .
                "<p>验证码：<strong style='font-size:24px;color:#ff0000;'>" . $code . "</strong></p>" .
                "<p>验证码有效期为10分钟，请及时使用。</p>" .
                "<p>如果这不是您的操作，请忽略此邮件。</p>"
            )
            ->send();
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful
     */
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
        $user->generateEmailVerificationToken();
        $user->status = User::STATUS_ACTIVE; // 直接激活用户，跳过邮件验证
        return $user->save();
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
