<?php

/**
 * Team: DBIS, NKU
 * Coding by chengna 2311828
 * This file is part of the flower offering model.
 */

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "flower_offering".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $ip_address
 * @property int $created_at
 *
 * @property User $user
 */
class FlowerOffering extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%flower_offering}}';
    }

    public function rules()
    {
        return [
            [['ip_address', 'created_at'], 'required'],
            [['user_id', 'created_at'], 'integer'],
            [['ip_address'], 'string', 'max' => 45],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户ID',
            'ip_address' => 'IP地址',
            'created_at' => '献花时间',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
    
    /**
     * 获取总献花数
     */
    public static function getTotalCount()
    {
        return self::find()->count();
    }
    
    /**
     * 检查IP今日是否已献花
     */
    public static function hasOfferedToday($ip)
    {
        $todayStart = strtotime('today');
        return self::find()
            ->where(['ip_address' => $ip])
            ->andWhere(['>=', 'created_at', $todayStart])
            ->exists();
    }
}
