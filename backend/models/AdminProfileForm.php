<?php

/**
 * Team: 抗战纪念队, NKU
 * Coding by LuoShijie 2313965
 *  Form model for updating an admin user's profile data,including optional password changes and avatar upload.
*/

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use yii\web\UploadedFile;

class AdminProfileForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_confirm;
    public $student_id;
    public $major;
    public $role;
    public $signature;
    public $bio;
    public $age;
    public $avatarFile;

    private $user;

    public function __construct(User $user, $config = [])
    {
        $this->user = $user;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->student_id = $user->student_id;
        $this->major = $user->major;
        $this->role = $user->role;
        $this->signature = $user->signature;
        $this->bio = $user->bio;
        $this->age = $user->age;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'filter' => function($query) {
                $query->andWhere(['<>', 'id', $this->user->id]);
            }, 'message' => '此用户名已被使用。'],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'filter' => function($query) {
                $query->andWhere(['<>', 'id', $this->user->id]);
            }, 'message' => '此邮箱已被使用。'],
            ['password', 'string', 'min' => 8, 'max' => 128],
            ['password_confirm', 'compare', 'compareAttribute' => 'password', 'message' => '两次密码输入不一致'],
            [['student_id', 'major', 'role', 'signature'], 'string', 'max' => 255],
            ['bio', 'string', 'max' => 1000],
            ['age', 'integer', 'min' => 1, 'max' => 150],
            ['avatarFile', 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif'],
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }

        $this->user->username = $this->username;
        $this->user->email = $this->email;
        $this->user->student_id = $this->student_id;
        $this->user->major = $this->major;
        $this->user->role = $this->role;
        $this->user->signature = $this->signature;
        $this->user->bio = $this->bio;
        $this->user->age = $this->age;

        $this->handleAvatarUpload();

        if (!empty($this->password)) {
            $this->user->setPassword($this->password);
        }

        return $this->user->save(false);
    }

    private function handleAvatarUpload()
    {
        $avatarFile = UploadedFile::getInstance($this, 'avatarFile');
        if (!$avatarFile) {
            return;
        }

        $fileName = 'admin_' . $this->user->id . '_' . time() . '.' . $avatarFile->extension;
        $uploadPath = Yii::getAlias('@frontend/web/uploads/avatars/');
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        if ($avatarFile->saveAs($uploadPath . $fileName)) {
            $this->user->avatar = '/uploads/avatars/' . $fileName;
        }
    }
}
