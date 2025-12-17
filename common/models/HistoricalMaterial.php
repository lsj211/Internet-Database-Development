<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "historical_material".
 *
 * @property int $id
 * @property string $title 标题
 * @property string|null $category 分类：战役/宣言/文献等
 * @property string|null $image_url 图片URL
 * @property string|null $summary 摘要
 * @property string|null $content 详细内容
 * @property string|null $event_date 事件日期
 * @property string|null $source 来源
 * @property int|null $sort_order 排序
 * @property int|null $status 状态 1启用 0禁用
 * @property int $created_at
 * @property int $updated_at
 */
class HistoricalMaterial extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%historical_material}}';
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
            [['title'], 'required'],
            [['summary', 'content'], 'string'],
            [['event_date'], 'safe'],
            [['sort_order', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'source'], 'string', 'max' => 200],
            [['category'], 'string', 'max' => 50],
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
            'title' => '标题',
            'category' => '分类',
            'image_url' => '图片URL',
            'summary' => '摘要',
            'content' => '详细内容',
            'event_date' => '事件日期',
            'source' => '来源',
            'sort_order' => '排序',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    /**
     * 获取启用的史料列表
     * @param string|null $category 分类筛选
     * @return \yii\db\ActiveQuery
     */
    public static function getActiveMaterials($category = null)
    {
        $query = self::find()
            ->where(['status' => self::STATUS_ACTIVE]);
        
        if ($category) {
            $query->andWhere(['category' => $category]);
        }
        
        return $query->orderBy(['sort_order' => SORT_ASC, 'id' => SORT_ASC])
            ->all();
    }
}
