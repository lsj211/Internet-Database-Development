<?php

/**
 * Team: 抗战纪念队, NKU
 * Coding by chengna 2311828
 * This file is part of the page visit model.
 */

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "page_visit".
 *
 * @property int $id
 * @property string $page_name
 * @property int $visit_count
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class PageVisit extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    
    public static function tableName()
    {
        return '{{%page_visit}}';
    }

    public function rules()
    {
        return [
            [['page_name', 'created_at', 'updated_at'], 'required'],
            [['visit_count', 'status', 'created_at', 'updated_at'], 'integer'],
            [['page_name'], 'string', 'max' => 100],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_name' => '页面名称',
            'visit_count' => '访问次数',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
    
    /**
     * 增加页面访问计数
     */
    public static function incrementVisit($pageName)
    {
        $visit = self::findOne(['page_name' => $pageName, 'status' => self::STATUS_ACTIVE]);
        if ($visit) {
            $visit->visit_count += 1;
            $visit->updated_at = time();
            $visit->save(false);
        } else {
            $visit = new self();
            $visit->page_name = $pageName;
            $visit->visit_count = 1;
            $visit->status = self::STATUS_ACTIVE;
            $visit->created_at = time();
            $visit->updated_at = time();
            $visit->save(false);
        }
        return $visit->visit_count;
    }
    
    /**
     * 获取页面访问次数
     */
    public static function getVisitCount($pageName)
    {
        $visit = self::findOne(['page_name' => $pageName, 'status' => self::STATUS_ACTIVE]);
        return $visit ? $visit->visit_count : 0;
    }
    
    /**
     * 获取所有页面的总访问次数
     */
    public static function getTotalVisits()
    {
        return (int) self::find()->where(['status' => self::STATUS_ACTIVE])->sum('visit_count');
    }
    
    /**
     * 获取所有页面的访问统计列表
     */
    public static function getAllPageStats()
    {
        return self::find()
            ->where(['status' => self::STATUS_ACTIVE])
            ->orderBy(['visit_count' => SORT_DESC])
            ->all();
    }
    
    /**
     * 获取页面中文名称映射
     */
    public static function getPageNameMap()
    {
        return [
            'index' => '首页',
            'memorial' => '烈士纪念馆',
            'parade' => '阅兵仪式',
            'history' => '抗战历史',
            'team' => '团队介绍',
            'profile' => '个人主页',
        ];
    }
}
