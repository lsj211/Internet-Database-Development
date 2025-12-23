<?php

/**
 * Team: 抗战纪念队, NKU
 * Coding by chengna 2311828
 * This file is used to display the user's profile page.
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $user common\models\Member */
/* @var $comments array */
/* @var $commentModel common\models\ProfileComment */

$this->title = $user->username . ' 的个人主页';
$isOwner = !Yii::$app->user->isGuest && Yii::$app->user->id == $user->id;
?>

<div class="container-fluid py-4">
    <?php if (Yii::$app->session->hasFlash('profile_success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>成功！</strong> <?= Yii::$app->session->getFlash('profile_success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- 用户信息卡片 -->
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <?php 
                    $avatarUrl = $user->avatar 
                        ? (strpos($user->avatar, 'http') === 0 ? $user->avatar : Url::to('@web' . $user->avatar)) 
                        : Url::to('@web/img/undraw_profile.svg');
                    ?>
                    <img src="<?= $avatarUrl ?>" 
                         class="rounded-circle mb-3" 
                         style="width: 150px; height: 150px; object-fit: cover;" 
                         alt="头像">
                    <h4 class="mb-2"><?= Html::encode($user->username) ?></h4>
                    <?php if ($user->signature): ?>
                        <p class="text-muted mb-3"><em>"<?= Html::encode($user->signature) ?>"</em></p>
                    <?php endif; ?>
                    
                    <?php if ($isOwner): ?>
                        <a href="<?= Url::to(['/site/edit-profile']) ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> 编辑资料
                        </a>
                    <?php endif; ?>
                </div>
                
                <div class="card-body border-top">
                    <h6 class="text-primary font-weight-bold mb-3">基本信息</h6>
                    
                    <?php if ($user->student_id): ?>
                    <div class="mb-2">
                        <i class="fas fa-id-card text-gray-400 mr-2"></i>
                        <strong>学号：</strong><?= Html::encode($user->student_id) ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($user->major): ?>
                    <div class="mb-2">
                        <i class="fas fa-graduation-cap text-gray-400 mr-2"></i>
                        <strong>专业：</strong><?= Html::encode($user->major) ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($user->role): ?>
                    <div class="mb-2">
                        <i class="fas fa-briefcase text-gray-400 mr-2"></i>
                        <strong>分工：</strong><?= Html::encode($user->role) ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($user->age): ?>
                    <div class="mb-2">
                        <i class="fas fa-birthday-cake text-gray-400 mr-2"></i>
                        <strong>年龄：</strong><?= Html::encode($user->age) ?> 岁
                    </div>
                    <?php endif; ?>
                    
                    <div class="mb-2">
                        <i class="fas fa-envelope text-gray-400 mr-2"></i>
                        <strong>邮箱：</strong><?= Html::encode($user->email) ?>
                    </div>
                    
                    <?php if ($user->homework_link): ?>
                    <div class="mb-2">
                        <i class="fas fa-link text-gray-400 mr-2"></i>
                        <strong>作业链接：</strong>
                        <a href="<?= Html::encode($user->homework_link) ?>" target="_blank">查看作业</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="col-lg-8 mb-4">
            <!-- 个人简介 -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">个人简介</h6>
                </div>
                <div class="card-body">
                    <?php if ($user->bio): ?>
                        <p><?= nl2br(Html::encode($user->bio)) ?></p>
                    <?php else: ?>
                        <p class="text-muted">该用户还没有填写个人简介。</p>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- 评论区 -->
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">留言板</h6>
                    <span class="badge badge-primary"><?= count($comments) ?> 条留言</span>
                </div>
                <div class="card-body">
                    <!-- 发表评论表单 -->
                    <?php if (!Yii::$app->user->isGuest): ?>
                        <form class="mb-4" id="comment-form">
                            <input type="hidden" name="profile_user_id" value="<?= $user->id ?>">
                            <input type="hidden" name="parent_id" value="">
                            
                            <div class="form-group">
                                <textarea name="content" class="form-control" rows="3" placeholder="写下你的留言..." required></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> 发表留言
                            </button>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <a href="<?= Url::to(['/site/login']) ?>">登录</a> 后可以留言
                        </div>
                    <?php endif; ?>
                    
                    <hr>
                    
                    <!-- 评论列表 -->
                    <div id="comments-list">
                        <?php if (empty($comments)): ?>
                            <p class="text-muted text-center">还没有留言，快来抢沙发吧！</p>
                        <?php else: ?>
                            <?php foreach ($comments as $comment): ?>
                                <div class="comment-item mb-4 pb-3 border-bottom">
                                    <div class="d-flex">
                                        <?php 
                                        $commentAvatarUrl = $comment->commentUser->avatar 
                                            ? (strpos($comment->commentUser->avatar, 'http') === 0 ? $comment->commentUser->avatar : Url::to('@web' . $comment->commentUser->avatar)) 
                                            : Url::to('@web/img/undraw_profile.svg');
                                        ?>
                                        <img src="<?= $commentAvatarUrl ?>" 
                                             class="rounded-circle mr-3" 
                                             style="width: 40px; height: 40px; object-fit: cover;" 
                                             alt="头像">
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <h6 class="mb-0">
                                                    <a href="<?= Url::to(['/site/profile', 'id' => $comment->comment_user_id]) ?>">
                                                        <?= Html::encode($comment->commentUser->username) ?>
                                                    </a>
                                                </h6>
                                                <small class="text-muted">
                                                    <?= Yii::$app->formatter->asRelativeTime($comment->created_at) ?>
                                                </small>
                                            </div>
                                            <p class="mb-2"><?= nl2br(Html::encode($comment->content)) ?></p>
                                            
                                            <?php if (!Yii::$app->user->isGuest): ?>
                                                <button class="btn btn-sm btn-outline-secondary reply-btn" data-comment-id="<?= $comment->id ?>">
                                                    <i class="fas fa-reply"></i> 回复
                                                </button>
                                            <?php endif; ?>
                                            
                                            <!-- 回复列表 -->
                                            <?php if (!empty($comment->replies)): ?>
                                                <div class="replies mt-3 pl-4 border-left">
                                                    <?php foreach ($comment->replies as $reply): ?>
                                                        <div class="reply-item mb-3">
                                                            <div class="d-flex">
                                                                <?php 
                                                                $replyAvatarUrl = $reply->commentUser->avatar 
                                                                    ? (strpos($reply->commentUser->avatar, 'http') === 0 ? $reply->commentUser->avatar : Url::to('@web' . $reply->commentUser->avatar)) 
                                                                    : Url::to('@web/img/undraw_profile.svg');
                                                                ?>
                                                                <img src="<?= $replyAvatarUrl ?>" 
                                                                     class="rounded-circle mr-2" 
                                                                     style="width: 30px; height: 30px; object-fit: cover;" 
                                                                     alt="头像">
                                                                <div>
                                                                    <div class="mb-1">
                                                                        <a href="<?= Url::to(['/site/profile', 'id' => $reply->comment_user_id]) ?>" class="font-weight-bold">
                                                                            <?= Html::encode($reply->commentUser->username) ?>
                                                                        </a>
                                                                        <small class="text-muted ml-2">
                                                                            <?= Yii::$app->formatter->asRelativeTime($reply->created_at) ?>
                                                                        </small>
                                                                    </div>
                                                                    <p class="mb-0 small"><?= nl2br(Html::encode($reply->content)) ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <!-- 回复表单（隐藏） -->
                                            <div class="reply-form mt-2" id="reply-form-<?= $comment->id ?>" style="display: none;">
                                                <form class="reply-submit-form" data-parent-id="<?= $comment->id ?>">
                                                    <textarea name="reply_content" class="form-control form-control-sm mb-2" rows="2" placeholder="写下你的回复..." required></textarea>
                                                    <button type="submit" class="btn btn-sm btn-primary">发表回复</button>
                                                    <button type="button" class="btn btn-sm btn-secondary cancel-reply">取消</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$postCommentUrl = Url::to(['/site/post-comment']);
$csrfParam = Yii::$app->request->csrfParam;
$csrfToken = Yii::$app->request->csrfToken;
$profileUserId = $user->id;

$js = <<<JS
jQuery(document).ready(function($) {
// 评论表单提交
$('#comment-form').on('submit', function(e) {
    e.preventDefault();
    e.stopPropagation(); // 阻止事件冒泡
    
    var form = $(this);
    var submitBtn = form.find('button[type="submit"]');
    var content = form.find('textarea[name="content"]').val().trim();
    
    // 验证内容
    if (content === '') {
        alert('请输入留言内容');
        return false;
    }
    
    // 禁用提交按钮，防止重复提交
    submitBtn.prop('disabled', true);
    
    $.ajax({
        url: '{$postCommentUrl}',
        type: 'POST',
        data: {
            profile_user_id: {$profileUserId},
            content: content,
            '{$csrfParam}': '{$csrfToken}'
        },
        success: function(data) {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message);
                submitBtn.prop('disabled', false);
            }
        },
        error: function() {
            alert('提交失败，请重试');
            submitBtn.prop('disabled', false);
        }
    });
    
    return false;
});

// 显示回复表单
$('.reply-btn').on('click', function() {
    var commentId = $(this).data('comment-id');
    $('#reply-form-' + commentId).slideToggle();
});

// 取消回复
$('.cancel-reply').on('click', function() {
    $(this).closest('.reply-form').slideUp();
});

// 提交回复
$('.reply-submit-form').on('submit', function(e) {
    e.preventDefault();
    e.stopPropagation(); // 阻止事件冒泡
    
    var form = $(this);
    var submitBtn = form.find('button[type="submit"]');
    var parentId = form.data('parent-id');
    var content = form.find('textarea[name="reply_content"]').val().trim();
    
    // 验证内容
    if (content === '') {
        alert('请输入回复内容');
        return false;
    }
    
    // 禁用提交按钮，防止重复提交
    submitBtn.prop('disabled', true);
    
    $.ajax({
        url: '{$postCommentUrl}',
        type: 'POST',
        data: {
            profile_user_id: {$profileUserId},
            parent_id: parentId,
            content: content,
            '{$csrfParam}': '{$csrfToken}'
        },
        success: function(data) {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message);
                submitBtn.prop('disabled', false);
            }
        },
        error: function() {
            alert('提交失败，请重试');
            submitBtn.prop('disabled', false);
        }
    });
    
    return false;
});
});
JS;

$this->registerJs($js, \yii\web\View::POS_END);
?>
