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
use yii\helpers\Url;
use frontend\models\MemberLoginForm;
use common\models\Member;
use common\models\User as AdminUser;
use common\models\Hero;
use common\models\HistoricalMaterial;
use common\models\DownloadCounter;
use common\models\ProfileComment;
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
        
        // 增加页面访问计数
        \common\models\PageVisit::incrementVisit('index');
        
        // 获取统计数据
        $stats = [
            'totalMembers' => AdminUser::find()
                ->where(['in', 'status', [AdminUser::STATUS_ACTIVE, AdminUser::STATUS_INACTIVE]])
                ->andWhere(['not', ['student_id' => null]])
                ->andWhere(['<>', 'student_id', ''])
                ->count(),
            'totalUsers' => Member::find()->where(['status' => Member::STATUS_ACTIVE])->count(),
            'totalDownloads' => DownloadCounter::getTotalDownloads(),
            'totalVisits' => \common\models\PageVisit::getTotalVisits(),
            'totalHeroes' => Hero::find()->count(),
            'totalMaterials' => HistoricalMaterial::find()->count(),
            'indexVisits' => \common\models\PageVisit::getVisitCount('index'),
        ];
        
        return $this->render('index', [
            'stats' => $stats,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout = 'sb-admin-2';
        
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new MemberLoginForm();
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
     * Displays history page.
     *
     * @return mixed
     */
    public function actionHistory()
    {
        $this->layout = 'sb-admin-2';
        
        // 增加页面访问计数
        \common\models\PageVisit::incrementVisit('history');
        
        // 从数据库加载英雄人物和史料
        $heroes = Hero::getActiveHeroes();
        $materials = HistoricalMaterial::getActiveMaterials();
        
        return $this->render('history', [
            'heroes' => $heroes,
            'materials' => $materials,
            'visitCount' => \common\models\PageVisit::getVisitCount('history'),
        ]);
    }

    /**
     * 管理员主页（只读展示）
     * @param int $id
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionAdminProfile($id)
    {
        $this->layout = 'sb-admin-2';

        $admin = AdminUser::findOne($id);
        if (!$admin) {
            throw new \yii\web\NotFoundHttpException('用户不存在');
        }

        return $this->render('admin-profile', [
            'user' => $admin,
        ]);
    }

    /**
     * 英雄详情页面
     * @param int $id
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionHeroDetail($id)
    {
        $this->layout = 'sb-admin-2';

        $hero = Hero::find()
            ->where(['id' => $id, 'status' => Hero::STATUS_ACTIVE])
            ->one();

        if (!$hero) {
            throw new \yii\web\NotFoundHttpException('英雄不存在');
        }

        return $this->render('hero-detail', [
            'model' => $hero,
        ]);
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
     * Displays document4 page.
     *
     * @return mixed
     */
    public function actionDocument4()
    {
        $this->layout = 'sb-admin-2';
        return $this->render('document4');
    }

    /**
     * Displays download page.
     *
     * @return mixed
     */
    public function actionDownload()
    {
        $this->layout = 'sb-admin-2';
        
        // 获取团队和个人作业列表
        $teamFiles = DownloadCounter::getFilesByType(DownloadCounter::TYPE_TEAM);
        $personalFiles = DownloadCounter::getFilesByType(DownloadCounter::TYPE_PERSONAL);
        
        return $this->render('download', [
            'teamFiles' => $teamFiles,
            'personalFiles' => $personalFiles,
        ]);
    }
    
    /**
     * 下载本地文件
     */
    public function actionDownloadFile($id)
    {
        $file = DownloadCounter::findOne($id);
        
        if (!$file) {
            throw new \yii\web\NotFoundHttpException('文件不存在');
        }
        
        // 检查是否为本地文件（以 local: 开头）
        if (strpos($file->file_url, 'local:') === 0) {
            // 提取本地路径
            $localPath = ltrim(substr($file->file_url, 6), '/\\'); // 移除 "local:" 前缀
            $baseDir = $file->file_type === DownloadCounter::TYPE_TEAM ? 'team' : 'personal';
            $filePath = Yii::getAlias('@app') . '/../data/' . $baseDir . '/' . $localPath;
            
            if (!file_exists($filePath)) {
                throw new \yii\web\NotFoundHttpException('文件不存在：' . $localPath);
            }
            
            // 增加下载计数
            DownloadCounter::incrementDownload($id);
            
            // 从实际文件路径中提取原始文件名
            $originalFileName = basename($filePath);
            
            // 发送文件，使用原始文件名
            return Yii::$app->response->sendFile($filePath, $originalFileName);
        } else {
            // 外部链接，重定向
            DownloadCounter::incrementDownload($id);
            return $this->redirect($file->file_url);
        }
    }
    
    /**
     * 下载统计接口
     */
    public function actionRecordDownload()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $id = Yii::$app->request->get('id');
        
        \Yii::info('下载统计请求 - ID: ' . $id, __METHOD__);
        
        if (!$id) {
            \Yii::error('参数错误 - 没有提供ID', __METHOD__);
            return ['success' => false, 'message' => '参数错误'];
        }
        
        $result = DownloadCounter::incrementDownload($id);
        \Yii::info('incrementDownload结果: ' . ($result ? 'true' : 'false'), __METHOD__);
        
        if ($result) {
            $model = DownloadCounter::findOne($id);
            if ($model) {
                \Yii::info('更新成功 - 新计数: ' . $model->download_count, __METHOD__);
                return [
                    'success' => true, 
                    'message' => '下载统计成功',
                    'count' => $model->download_count
                ];
            } else {
                \Yii::error('找不到模型 - ID: ' . $id, __METHOD__);
            }
        }
        
        \Yii::error('统计失败', __METHOD__);
        return ['success' => false, 'message' => '统计失败'];
    }

    /**
     * Displays team page.
     *
     * @return mixed
     */
    public function actionTeam()
    {
        $this->layout = 'sb-admin-2';
        
        // 获取团队统计数据
        $stats = [
            'totalMembers' => AdminUser::find()
                ->where(['in', 'status', [AdminUser::STATUS_ACTIVE, AdminUser::STATUS_INACTIVE]])
                ->andWhere(['not', ['student_id' => null]])
                ->andWhere(['<>', 'student_id', ''])
                ->count(),
            'totalDownloads' => DownloadCounter::getTotalDownloads(),
            'totalVisits' => \common\models\PageVisit::getTotalVisits(),
            'totalComments' => ProfileComment::find()->where(['status' => ProfileComment::STATUS_ACTIVE])->count(),
        ];
        
        return $this->render('team', [
            'stats' => $stats,
        ]);
    }

    /**
     * Edit user profile page.
     *
     * @return mixed
     */
    public function actionEditProfile()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }

        $this->layout = 'sb-admin-2';
        $model = Member::findOne(Yii::$app->user->id);

        if ($model->load(Yii::$app->request->post())) {
            // 保存旧头像路径
            $oldAvatar = $model->avatar;
            
            // 处理头像上传
            $avatarFile = \yii\web\UploadedFile::getInstance($model, 'avatar');
            if ($avatarFile) {
                $uploadPath = Yii::getAlias('@frontend/web/uploads/avatars/');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                $fileName = Yii::$app->user->id . '_' . time() . '.' . $avatarFile->extension;
                if ($avatarFile->saveAs($uploadPath . $fileName)) {
                    $model->avatar = '/uploads/avatars/' . $fileName;
                }
            } else {
                // 如果没有上传新头像，保持原有头像
                $model->avatar = $oldAvatar;
            }

            // 先验证
            if (!$model->validate()) {
                Yii::$app->session->setFlash('profile_error', '验证失败：' . json_encode($model->errors));
                return $this->render('edit-profile', ['model' => $model]);
            }

            if ($model->save(false)) {
                // 清除所有旧的flash消息
                Yii::$app->session->removeAllFlashes();
                // 设置新的成功消息
                Yii::$app->session->setFlash('profile_success', '个人资料更新成功！');
                return $this->redirect(['/site/profile', 'id' => Yii::$app->user->id]);
            } else {
                Yii::$app->session->setFlash('profile_error', '保存失败：' . json_encode($model->errors));
            }
        }

        return $this->render('edit-profile', [
            'model' => $model,
        ]);
    }

    /**     * Displays user profile page.
     *
     * @param int $id 用户ID
     * @return mixed
     */
    public function actionProfile($id = null)
    {
        $this->layout = 'sb-admin-2';
        
        // 如果没有指定ID，显示当前用户的主页
        if ($id === null) {
            if (Yii::$app->user->isGuest) {
                return $this->redirect(['/site/login']);
            }
            $id = Yii::$app->user->id;
        }
        
        $user = Member::findOne($id);
        if (!$user) {
            throw new \yii\web\NotFoundHttpException('用户不存在');
        }
        
        // 获取评论列表
        $comments = ProfileComment::getProfileComments($id);
        
        // 处理评论提交
        $commentModel = new ProfileComment();
        if ($commentModel->load(Yii::$app->request->post())) {
            if (!Yii::$app->user->isGuest) {
                $commentModel->profile_user_id = $id;
                $commentModel->comment_user_id = Yii::$app->user->id;
                if ($commentModel->save()) {
                    Yii::$app->session->setFlash('success', '评论发表成功！');
                    return $this->refresh();
                }
            }
        }
        
        return $this->render('profile', [
            'user' => $user,
            'comments' => $comments,
            'commentModel' => $commentModel,
        ]);
    }

    /**
     * Post a comment or reply
     */
    public function actionPostComment()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        try {
            if (Yii::$app->user->isGuest) {
                return ['success' => false, 'message' => '请先登录'];
            }
            
            $model = new ProfileComment();
            $model->profile_user_id = Yii::$app->request->post('profile_user_id');
            $model->comment_user_id = Yii::$app->user->id;
            $model->parent_id = Yii::$app->request->post('parent_id');
            $model->content = Yii::$app->request->post('content');
            
            if ($model->save()) {
                return [
                    'success' => true,
                    'message' => '评论成功',
                    'comment' => [
                        'id' => $model->id,
                        'content' => $model->content,
                        'username' => Yii::$app->user->identity->username,
                        'created_at' => Yii::$app->formatter->asDatetime($model->created_at),
                    ]
                ];
            }
            
            // 返回详细错误信息
            $errors = $model->getErrors();
            $errorMessages = [];
            foreach ($errors as $field => $fieldErrors) {
                $errorMessages[] = implode(', ', $fieldErrors);
            }
            
            return [
                'success' => false, 
                'message' => '评论失败：' . implode('; ', $errorMessages),
                'errors' => $errors
            ];
        } catch (\Exception $e) {
            Yii::error($e->getMessage() . "\n" . $e->getTraceAsString(), __METHOD__);
            return [
                'success' => false, 
                'message' => '系统错误：' . $e->getMessage()
            ];
        }
    }

    /**
     * Displays memorial page.
     *
     * @return mixed
     */
    public function actionMemorial()
    {
        $this->layout = 'sb-admin-2';
        
        // 增加页面访问计数
        \common\models\PageVisit::incrementVisit('memorial');
        
        // 获取留言列表
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => \common\models\Message::find()->with('user')->orderBy(['created_at' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        // 处理留言提交
        $model = new \common\models\Message();
        if (!Yii::$app->user->isGuest && Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
            if ($model->save()) {
                Yii::$app->session->setFlash('success', '追思已提交');
                return $this->redirect(['memorial']);
            }
        }
        
        // 获取统计数据
        $flowerCount = \common\models\FlowerOffering::getTotalCount();
        $messageCount = \common\models\Message::find()->count();
        $visitCount = \common\models\PageVisit::getVisitCount('memorial');

        return $this->render('memorial', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            'flowerCount' => $flowerCount,
            'messageCount' => $messageCount,
            'visitCount' => $visitCount,
        ]);
    }
    
    /**
     * 献花功能
     */
    public function actionOfferFlower()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $ip = Yii::$app->request->userIP;
        
        // 检查今日是否已献花
        if (\common\models\FlowerOffering::hasOfferedToday($ip)) {
            return ['success' => false, 'message' => '您今天已经献过花了'];
        }
        
        $flower = new \common\models\FlowerOffering();
        $flower->user_id = Yii::$app->user->isGuest ? null : Yii::$app->user->id;
        $flower->ip_address = $ip;
        $flower->created_at = time();
        
        if ($flower->save()) {
            $totalCount = \common\models\FlowerOffering::getTotalCount();
            return ['success' => true, 'message' => '献花成功！', 'count' => $totalCount];
        }
        
        return ['success' => false, 'message' => '献花失败，请稍后重试'];
    }

    /**
     * Displays parade page.
     *
     * @return mixed
     */
    public function actionParade()
    {
        $this->layout = 'sb-admin-2';
        
        // 增加页面访问计数
        \common\models\PageVisit::incrementVisit('parade');
        
        return $this->render('parade', [
            'visitCount' => \common\models\PageVisit::getVisitCount('parade'),
        ]);
    }

    /**
     * Returns memorial video URL as JSON so frontend can plug in a real video link.
     */
    public function actionMemorialVideo()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $url = Yii::$app->params['memorialVideoUrl'] ?? null;
        if (!$url) {
            $url = Url::to('@web/videos/memorial.mp4');
        } elseif (strpos($url, '/') === 0) {
            $url = Yii::$app->request->baseUrl . $url;
        }
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
        // 使用本地音频文件
        $url = Yii::$app->request->baseUrl . '/audio/anthem.mp3';
        return ['success' => true, 'url' => $url];
    }

    /**
     * Displays formation page for a given type (infantry, airforce, navy, equipment)
     * and optional year (null/1949/2025) to show different era equipment & troops.
     *
     * @param string $type
     * @param int|null $year
     * @return string
     * @throws \yii\web\BadRequestHttpException
     */
    public function actionFormation($type = 'infantry', $year = null)
    {
        $this->layout = 'sb-admin-2';
        $allowedTypes = ['infantry','airforce','navy','equipment'];
        if (!in_array($type, $allowedTypes, true)) {
            throw new \yii\web\BadRequestHttpException('Invalid formation type');
        }

        // 将 URL 传入的字符串年份统一转换为整数，便于后续校验
        if ($year !== null) {
            $year = (int)$year;
        }

        $allowedYears = [null, 1949, 2025];
        if (!in_array($year, $allowedYears, true)) {
            throw new \yii\web\BadRequestHttpException('Invalid formation year');
        }

        // 无年份时，显示总览页面；有具体年份时，跳转到对应专门页面
        if ($year === null) {
            return $this->render('formation', [
                'type' => $type,
                'year' => null,
            ]);
        }

        $view = sprintf('formation-%s-%d', $type, $year);
        return $this->render($view, [
            'type' => $type,
            'year' => $year,
        ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $this->layout = 'sb-admin-2';
        
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', '注册成功！请查收邮箱验证邮件。');
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
        if (Member::findOne(['email' => $email])) {
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
        $this->layout = 'sb-admin-2';
        
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', '密码重置链接已发送到您的邮箱，请查收。');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', '抱歉，无法为该邮箱地址重置密码。');
            }
        }

        return $this->render('request-password-reset', [
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
        $this->layout = 'sb-admin-2';
        
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', '新密码已保存，请使用新密码登录。');

            return $this->goHome();
        }

        return $this->render('reset-password', [
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
