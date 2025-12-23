<?php

/**
 * Team: 抗战纪念队, NKU
 * Coding by chengna 2311828
 * This file is part of the profile comment model.
 */

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "profile_comment".
 *
 * @property int $id
 * @property int $profile_user_id 被评论的用户ID
 * @property int $comment_user_id 评论者ID
 * @property int|null $parent_id 父评论ID（用于回复）
 * @property string $content 评论内容
 * @property int|null $status 状态 1正常 0删除
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $profileUser
 * @property User $commentUser
 * @property ProfileComment $parent
 * @property ProfileComment[] $replies
 */
class ProfileComment extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%profile_comment}}';
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
            [['profile_user_id', 'comment_user_id', 'content'], 'required'],
            [['profile_user_id', 'comment_user_id', 'parent_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['profile_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::class, 'targetAttribute' => ['profile_user_id' => 'id']],
            [['comment_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::class, 'targetAttribute' => ['comment_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'profile_user_id' => '被评论的用户',
            'comment_user_id' => '评论者',
            'parent_id' => '回复',
            'content' => '评论内容',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    /**
     * 获取被评论的用户
     */
    public function getProfileUser()
    {
        return $this->hasOne(Member::class, ['id' => 'profile_user_id']);
    }

    /**
     * 获取评论者
     */
    public function getCommentUser()
    {
        return $this->hasOne(Member::class, ['id' => 'comment_user_id']);
    }

    /**
     * 获取父评论
     */
    public function getParent()
    {
        return $this->hasOne(ProfileComment::class, ['id' => 'parent_id']);
    }

    /**
     * 获取回复列表
     */
    public function getReplies()
    {
        return $this->hasMany(ProfileComment::class, ['parent_id' => 'id'])
            ->where(['status' => self::STATUS_ACTIVE])
            ->orderBy(['created_at' => SORT_ASC]);
    }

    /**
     * 获取用户主页的评论列表
     */
    public static function getProfileComments($userId, $limit = 20)
    {
        return self::find()
            ->where(['profile_user_id' => $userId, 'status' => self::STATUS_ACTIVE])
            ->andWhere(['parent_id' => null]) // 只获取顶级评论
            ->with(['commentUser', 'replies.commentUser'])
            ->orderBy(['created_at' => SORT_DESC])
            ->limit($limit)
            ->all();
    }
}
