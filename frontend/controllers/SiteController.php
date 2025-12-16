<?php

/**
 * Team: DBIS, NKU
 * Coding by chengna 2311828
 * This file is used to manage the site's actions.
 */

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'send-email-code' => ['post'],
                ],
            ],
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
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'sb-admin-2';
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Displays admin page.
     *
     * @return mixed
     */
    public function actionAdmin()
    {
        $this->layout = 'admin';
        return $this->render('admin');
    }

    /**
     * Displays history page.
     *
     * @return mixed
     */
    public function actionHistory()
    {
        $this->layout = 'sb-admin-2';
        return $this->render('history');
    }

    /**
     * Displays document1 page.
     *
     * @return mixed
     */
    public function actionDocument1()
    {
        $this->layout = 'sb-admin-2';
        return $this->render('document1');
    }

    /**
     * Displays document2 page.
     *
     * @return mixed
     */
    public function actionDocument2()
    {
        $this->layout = 'sb-admin-2';
        return $this->render('document2');
    }

    /**
     * Displays document3 page.
     *
     * @return mixed
     */
    public function actionDocument3()
    {
        $this->layout = 'sb-admin-2';
        return $this->render('document3');
    }

    /**
     * Displays download page.
     *
     * @return mixed
     */
    public function actionDownload()
    {
        $this->layout = 'sb-admin-2';
        return $this->render('download');
    }

    /**
     * Displays team page.
     *
     * @return mixed
     */
    public function actionTeam()
    {
        $this->layout = 'sb-admin-2';
        return $this->render('team');
    }

    /**
     * Displays memorial page.
     *
     * @return mixed
     */
    public function actionMemorial()
    {
        $this->layout = 'sb-admin-2';
        return $this->render('memorial');
    }

    /**
     * Displays parade page.
     *
     * @return mixed
     */
    public function actionParade()
    {
        $this->layout = 'sb-admin-2';
        return $this->render('parade');
    }

    /**
     * Returns memorial video URL as JSON so frontend can plug in a real video link.
     */
    public function actionMemorialVideo()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $url = Yii::$app->params['memorialVideoUrl'] ?? 'https://example.com/videos/memorial.mp4';
        return ['success' => true, 'url' => $url];
    }

    /**
     * Serve personal download files from web/downloads/personal safely.
     * Usage: /site/download-personal?file=zhang_san_frontend.zip
     */
    public function actionDownloadPersonal($file)
    {
        $this->layout = false;
        $file = basename($file);
        $basePath = Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . 'downloads' . DIRECTORY_SEPARATOR . 'personal' . DIRECTORY_SEPARATOR;
        $fullPath = $basePath . $file;
        if (!is_file($fullPath)) {
            throw new \yii\web\NotFoundHttpException('文件未找到');
        }
        return Yii::$app->response->sendFile($fullPath, $file, ['inline' => false]);
    }

    /**
     * Returns anthem (anthem audio/video) URL for parade page.
     */
    public function actionAnthem()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $url = Yii::$app->params['anthemUrl'] ?? 'https://example.com/media/anthem.mp3';
        return ['success' => true, 'url' => $url];
    }

    /**
     * Displays formation page for a given type (infantry, airforce, navy, equipment)
     */
    public function actionFormation($type = 'infantry')
    {
        $this->layout = 'sb-admin-2';
        $allowed = ['infantry','airforce','navy','equipment'];
        if (!in_array($type, $allowed)) {
            throw new \yii\web\BadRequestHttpException('Invalid formation type');
        }
        return $this->render('formation', ['type' => $type]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * 发送邮箱验证码
     */
    public function actionSendEmailCode()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $email = Yii::$app->request->post('email');
        
        if (!$email) {
            return ['success' => false, 'message' => '请输入邮箱地址'];
        }
        
        // 验证邮箱格式
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => '邮箱格式不正确'];
        }
        
        // 检查邮箱是否已被注册
        if (User::findOne(['email' => $email])) {
            return ['success' => false, 'message' => '该邮箱已被注册'];
        }
        
        // 发送验证码
        try {
            $model = new SignupForm();
            $model->email = $email;
            
            if ($model->sendEmailCode()) {
                return ['success' => true, 'message' => '验证码已发送到您的邮箱，请查收'];
            } else {
                return ['success' => false, 'message' => '验证码发送失败，请检查邮件配置'];
            }
        } catch (\Exception $e) {
            Yii::error('发送邮件错误: ' . $e->getMessage());
            return ['success' => false, 'message' => '发送失败: ' . $e->getMessage()];
        }
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
