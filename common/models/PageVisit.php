<?php


namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "page_visit".
 *
 * @property int $id
 * @property string $page_name
 * @property int $visit_count
 * @property int $updated_at
 */
class PageVisit extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%page_visit}}';
    }

    public function rules()
    {
        return [
            [['page_name', 'updated_at'], 'required'],
            [['visit_count', 'updated_at'], 'integer'],
            [['page_name'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_name' => '页面名称',
            'visit_count' => '访问次数',
            'updated_at' => '更新时间',
        ];
    }
    
    /**
     * 增加页面访问计数
     */
    public static function incrementVisit($pageName)
    {
        $visit = self::findOne(['page_name' => $pageName]);
        if ($visit) {
            $visit->visit_count += 1;
            $visit->updated_at = time();
            $visit->save(false);
        } else {
            $visit = new self();
            $visit->page_name = $pageName;
            $visit->visit_count = 1;
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
        $visit = self::findOne(['page_name' => $pageName]);
        return $visit ? $visit->visit_count : 0;
    }
    
    /**
     * 获取所有页面的总访问次数
     */
    public static function getTotalVisits()
    {
        return (int) self::find()->sum('visit_count');
    }
}
