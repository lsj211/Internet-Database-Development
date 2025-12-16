<?php

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
                    <div class="col-md-6 mb-3">
                        <div class="card border-left-primary">
                            <div class="card-body">
                                <h6>需求文档</h6>
                                <p>项目需求分析和功能规格说明</p>
                                <a href="<?= Url::to('@web/downloads/requirements.pdf') ?>" class="btn btn-primary btn-sm" download>
                                    <i class="fas fa-download fa-sm"></i> 下载
                                </a>
                                <small class="text-muted d-block mt-1">更新时间：2023-12-15</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card border-left-success">
                            <div class="card-body">
                                <h6>设计文档</h6>
                                <p>系统设计和数据库设计文档</p>
                                <a href="<?= Url::to('@web/downloads/design.pdf') ?>" class="btn btn-success btn-sm" download>
                                    <i class="fas fa-download fa-sm"></i> 下载
                                </a>
                                <small class="text-muted d-block mt-1">更新时间：2023-12-14</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card border-left-info">
                            <div class="card-body">
                                <h6>测试文档</h6>
                                <p>系统测试用例和测试报告</p>
                                <a href="<?= Url::to('@web/downloads/testing.pdf') ?>" class="btn btn-info btn-sm" download>
                                    <i class="fas fa-download fa-sm"></i> 下载
                                </a>
                                <small class="text-muted d-block mt-1">更新时间：2023-12-13</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card border-left-warning">
                            <div class="card-body">
                                <h6>用户手册</h6>
                                <p>系统使用说明和操作指南</p>
                                <a href="<?= Url::to('@web/downloads/manual.pdf') ?>" class="btn btn-warning btn-sm" download>
                                    <i class="fas fa-download fa-sm"></i> 下载
                                </a>
                                <small class="text-muted d-block mt-1">更新时间：2023-12-12</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card border-left-danger">
                            <div class="card-body">
                                <h6>项目总结</h6>
                                <p>项目开发总结和经验分享</p>
                                <a href="<?= Url::to('@web/downloads/summary.pdf') ?>" class="btn btn-danger btn-sm" download>
                                    <i class="fas fa-download fa-sm"></i> 下载
                                </a>
                                <small class="text-muted d-block mt-1">更新时间：2023-12-11</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card border-left-secondary">
                            <div class="card-body">
                                <h6>源码包</h6>
                                <p>完整项目源码压缩包</p>
                                <a href="<?= Url::to('@web/downloads/source.zip') ?>" class="btn btn-secondary btn-sm" download>
                                    <i class="fas fa-download fa-sm"></i> 下载
                                </a>
                                <small class="text-muted d-block mt-1">更新时间：2023-12-10</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card border-left-dark">
                            <div class="card-body">
                                <h6>演示视频</h6>
                                <p>系统功能演示视频</p>
                                <a href="<?= Url::to('@web/downloads/demo.mp4') ?>" class="btn btn-dark btn-sm" download>
                                    <i class="fas fa-download fa-sm"></i> 下载
                                </a>
                                <small class="text-muted d-block mt-1">更新时间：2023-12-09</small>
                            </div>
                        </div>
                    </div>
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
                                <th>姓名</th>
                                <th>学号</th>
                                <th>文件名</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>刘越帅</td>
                                <td>2313752</td>
                                <td>liu_yue_shuai_frontend.zip</td>
                                <td>
                                    <a href="<?= Url::to(['site/download-personal','file'=>'liu_yue_shuai_homework.zip']) ?>" class="btn btn-primary btn-sm">
                                        <i class="fas fa-download fa-sm"></i> 下载
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>杨竣羽</td>
                                <td>2313043</td>
                                <td>yang_jun_yu_research.pdf</td>
                                <td>
                                    <a href="<?= Url::to(['site/download-personal','file'=>'yang_jun_yu_homework.zip']) ?>" class="btn btn-success btn-sm">
                                        <i class="fas fa-download fa-sm"></i> 下载
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>程娜</td>
                                <td>2311828</td>
                                <td>cheng_na_design.psd</td>
                                <td>
                                    <a href="<?= Url::to(['site/download-personal','file'=>'cheng_na_homework.zip']) ?>" class="btn btn-info btn-sm">
                                        <i class="fas fa-download fa-sm"></i> 下载
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>罗仕杰</td>
                                <td>2313965</td>
                                <td>luo_shi_jie_prototype.pdf</td>
                                <td>
                                    <a href="<?= Url::to(['site/download-personal','file'=>'luo_shi_jie_homework.zip']) ?>" class="btn btn-info btn-sm">
                                        <i class="fas fa-download fa-sm"></i> 下载
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJsFile('@web/vendor/datatables/jquery.dataTables.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('@web/vendor/datatables/dataTables.bootstrap4.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$js = <<<JS
$(document).ready(function() {
    $('#personalWorkTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Chinese.json"
        }
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>
