<?php

/**
 * Team: DBIS, NKU
 * Coding by chengna 2311828
 * This file is part of the backend controllers for site management.
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\AdminSignupForm;
use backend\models\AdminProfileForm;

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
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'captcha'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'profile', 'send-email-code'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['register-admin'],
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
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect(['site/profile']);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Admin profile page (view/edit).
     *
     * @return string|\yii\web\Response
     */
    public function actionProfile()
    {
        $user = Yii::$app->user->identity;
        $model = new AdminProfileForm($user);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '管理员信息已更新');
            return $this->redirect(['site/profile']);
        }

        return $this->render('profile', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    /**
     * Register admin account (backend only).
     *
     * @return string|\yii\web\Response
     */
    public function actionRegisterAdmin()
    {
        $model = new AdminSignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', '管理员账号创建成功');
            return $this->redirect(['site/index']);
        }

        $model->password = '';
        $model->password_confirm = '';

        return $this->render('register-admin', [
            'model' => $model,
        ]);
    }

    /**
     * Send admin email verification code.
     *
     * @return array
     */
    public function actionSendEmailCode()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $email = Yii::$app->request->post('email');
        if (!$email) {
            return ['success' => false, 'message' => '请输入邮箱地址'];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => '邮箱格式不正确'];
        }

        if (\common\models\User::findOne(['email' => $email])) {
            return ['success' => false, 'message' => '该邮箱已被注册'];
        }

        $model = new AdminSignupForm();
        $model->email = $email;
        if ($model->sendEmailCode()) {
            return ['success' => true, 'message' => '验证码已发送到您的邮箱，请查收'];
        }

        return ['success' => false, 'message' => '验证码发送失败，请检查邮件配置'];
    }
}
