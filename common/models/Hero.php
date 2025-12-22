<?php

/**
 * Team: DBIS, NKU
 * Coding by chengna 2311828
 * This file is part of the hero model.
 */

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "hero".
 *
 * @property int $id
 * @property string $name 英雄姓名
 * @property string|null $title 职务/头衔
 * @property string|null $image_url 照片URL
 * @property string|null $brief 简介
 * @property string|null $deeds 事迹
 * @property string|null $contribution 贡献
 * @property int|null $birth_year 出生年份
 * @property int|null $death_year 牺牲年份
 * @property int|null $sort_order 排序
 * @property int|null $status 状态 1启用 0禁用
 * @property int $created_at
 * @property int $updated_at
 */
class Hero extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%hero}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['brief', 'deeds', 'contribution'], 'string'],
            [['birth_year', 'death_year', 'sort_order', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['title'], 'string', 'max' => 200],
            [['image_url'], 'string', 'max' => 500],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['sort_order'], 'default', 'value' => 0],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '英雄姓名',
            'title' => '职务/头衔',
            'image_url' => '照片URL',
            'brief' => '简介',
            'deeds' => '事迹',
            'contribution' => '贡献',
            'birth_year' => '出生年份',
            'death_year' => '牺牲年份',
            'sort_order' => '排序',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    /**
     * 获取启用的英雄列表
     * @return \yii\db\ActiveQuery
     */
    public static function getActiveHeroes()
    {
        return self::find()
            ->where(['status' => self::STATUS_ACTIVE])
            ->orderBy(['sort_order' => SORT_ASC, 'id' => SORT_ASC])
            ->all();
    }
}
