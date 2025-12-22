<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;

class AdminProfileForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_confirm;

    private $user;

    public function __construct(User $user, $config = [])
    {
        $this->user = $user;
        $this->username = $user->username;
        $this->email = $user->email;
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
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }

        $this->user->username = $this->username;
        $this->user->email = $this->email;

        if (!empty($this->password)) {
            $this->user->setPassword($this->password);
        }

        return $this->user->save(false);
    }
}
