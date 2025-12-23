<?php

/**
 * Team: 抗战纪念队, NKU
 * Coding by chengna 2311828
 * This file is used to display the download page for team and individual homework files.
 */

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = '作业下载';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">作业下载</h1>
</div>

<!-- 团队作业下载区 -->
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">团队作业下载区</h6>
            </div>
            <div class="card-body">
                <p>以下是团队完成的各类文档，按类别整理提供下载：</p>
                <div class="row">
                    <?php 
                    $colors = ['primary', 'success', 'info', 'warning', 'danger', 'secondary', 'dark'];
                    $colorIndex = 0;
                    foreach ($teamFiles as $file): 
                        $color = $colors[$colorIndex % count($colors)];
                        $colorIndex++;
                    ?>
                    <div class="col-md-6 mb-3">
                        <div class="card border-left-<?= $color ?>">
                            <div class="card-body">
                                <h6><?= \yii\helpers\Html::encode($file->file_name) ?></h6>
                                <?php if (strpos($file->file_url, 'local:') === 0): ?>
                                    <!-- 本地文件 -->
                                    <a href="<?= Url::to(['site/download-file', 'id' => $file->id]) ?>" 
                                       class="btn btn-<?= $color ?> btn-sm">
                                        <i class="fas fa-download fa-sm"></i> 下载
                                    </a>
                                <?php else: ?>
                                    <!-- 外部链接 -->
                                    <a href="<?= $file->file_url ?>" 
                                       class="btn btn-<?= $color ?> btn-sm download-link" 
                                       data-id="<?= $file->id ?>"
                                       target="_blank">
                                        <i class="fas fa-download fa-sm"></i> 下载
                                    </a>
                                <?php endif; ?>
                                <small class="text-muted d-block mt-1">
                                    已下载：<span id="count-<?= $file->id ?>"><?= $file->download_count ?></span> 次
                                </small>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 个人作业下载区 -->
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">个人作业下载区</h6>
            </div>
            <div class="card-body">
                <p>以下是团队成员的个人作业，按成员姓名/学号整理：</p>
                <div class="table-responsive">
                    <table class="table table-bordered" id="personalWorkTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>文件名</th>
                                <th>下载次数</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($personalFiles as $file): ?>
                            <tr>
                                <td><?= \yii\helpers\Html::encode($file->file_name) ?></td>
                                <td><span id="count-<?= $file->id ?>"><?= $file->download_count ?></span></td>
                                <td>
                                    <?php if (strpos($file->file_url, 'local:') === 0): ?>
                                        <!-- 本地文件，使用download-file action -->
                                        <a href="<?= Url::to(['site/download-file', 'id' => $file->id]) ?>" 
                                           class="btn btn-primary btn-sm">
                                            <i class="fas fa-download fa-sm"></i> 下载
                                        </a>
                                    <?php else: ?>
                                        <!-- 外部链接，使用原来的方式 -->
                                        <a href="<?= $file->file_url ?>" 
                                           class="btn btn-primary btn-sm download-link" 
                                           data-id="<?= $file->id ?>"
                                           target="_blank">
                                            <i class="fas fa-download fa-sm"></i> 下载
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$csrfParam = Yii::$app->request->csrfParam;
$csrfToken = Yii::$app->request->csrfToken;
$recordDownloadUrl = Url::to(['site/record-download']);

$this->registerJsFile('@web/vendor/datatables/jquery.dataTables.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('@web/vendor/datatables/dataTables.bootstrap4.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);

$js = <<<JS
console.log('页面加载完成，jQuery版本:', $.fn.jquery);

// 初始化DataTable
$('#personalWorkTable').DataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Chinese.json"
    },
    "lengthMenu": [[3, 6, 9, 12], [3, 6, 9, 12]],
    "pageLength": 3
});

// 下载链接点击事件
$(document).on('click', '.download-link', function(e) {
    e.preventDefault(); // 阻止默认跳转
    console.log('===== 下载链接被点击 =====');
    
    var link = $(this);
    var id = link.data('id');
    var url = link.attr('href');
    
    console.log('文件ID:', id);
    console.log('文件URL:', url);
    console.log('统计接口:', '{$recordDownloadUrl}');
    
    // 先记录下载统计，然后再打开文件
    $.ajax({
        url: '{$recordDownloadUrl}',
        type: 'GET',
        data: { id: id },
        dataType: 'json',
        timeout: 5000,
        success: function(data) {
            console.log('AJAX成功，返回:', data);
            if (data.success) {
                $('#count-' + id).text(data.count);
                console.log('更新计数为:', data.count);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX失败:', status, error);
        },
        complete: function() {
            console.log('打开文件:', url);
            window.open(url, '_blank');
        }
    });
    
    return false;
});
JS;

$this->registerJs($js, \yii\web\View::POS_READY);
?>
</script>