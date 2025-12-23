<?php

/**
 * Team: 抗战纪念队, NKU
 * Coding by chengna 2311828
 * This file is part of the download counter model.
 */

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "download_counter".
 *
 * @property int $id
 * @property string $file_name 文件名
 * @property string $file_type 文件类型：team团队作业/personal个人作业
 * @property string|null $file_url 文件URL
 * @property int|null $download_count 下载次数
 * @property int $created_at
 * @property int $updated_at
 */
class DownloadCounter extends \yii\db\ActiveRecord
{
    const TYPE_TEAM = 'team';
    const TYPE_PERSONAL = 'personal';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%download_counter}}';
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
            [['file_name', 'file_type'], 'required'],
            [['download_count', 'created_at', 'updated_at'], 'integer'],
            [['file_name'], 'string', 'max' => 255],
            [['file_type'], 'string', 'max' => 50],
            [['file_url'], 'string', 'max' => 500],
            [['download_count'], 'default', 'value' => 0],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_name' => '文件名',
            'file_type' => '文件类型',
            'file_url' => '文件URL',
            'download_count' => '下载次数',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    /**
     * 增加下载次数
     * @param int $id 文件ID
     * @return bool
     */
    public static function incrementDownload($id)
    {
        $model = self::findOne($id);
        if ($model) {
            $model->download_count++;
            $model->updated_at = time();
            return $model->save(false);
        }
        return false;
    }

    /**
     * 获取指定类型的文件列表
     * @param string $type 'team' or 'personal'
     * @return array
     */
    public static function getFilesByType($type)
    {
        return self::find()
            ->where(['file_type' => $type])
            ->orderBy(['id' => SORT_ASC])
            ->all();
    }

    /**
     * 获取总下载次数
     * @param string|null $type 文件类型筛选
     * @return int
     */
    public static function getTotalDownloads($type = null)
    {
        $query = self::find();
        if ($type) {
            $query->where(['file_type' => $type]);
        }
        return $query->sum('download_count') ?: 0;
    }
}
