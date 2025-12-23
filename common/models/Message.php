<?php
/**
 * Team: 抗战纪念队, NKU
 * Coding by chengna 2311828
 * This is the message model of common.
 */
namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property int $user_id
 * @property string $content
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Member $user
 */
class Message extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    
    public static function tableName()
    {
        return '{{%message}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function () {
                    return time();
                },
            ],
        ];
    }

    public function rules()
    {
        return [
            [['user_id', 'content'], 'required'],
            [['user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户',
            'status' => '状态',
            'content' => '留言内容',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Member::class, ['id' => 'user_id']);
    }
}
