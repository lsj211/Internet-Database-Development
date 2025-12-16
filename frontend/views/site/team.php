<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '团队介绍';
?>

<div class="container-fluid py-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">团队概况</h6>
                </div>
                <div class="card-body">
                    <p>抗战纪念队成立于2025年，是由多位热爱历史、致力于传承抗日战争精神的大学生在互联网数据库开发课上组成的团队。团队成员来自不同专业，包括计算机、信息安全等专业，通过跨学科合作，共同完成这个意义非凡的项目。</p>
                    <p><strong>团队使命：</strong>铭记历史，缅怀先烈，教育后人，让更多人了解抗日战争的伟大历程和英雄事迹。</p>
                    <p><strong>团队目标：</strong>通过现代信息技术手段，打造一个全面、准确、生动的抗日战争数字纪念馆，为爱国主义教育提供优质资源。</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">团队成员</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>姓名</th>
                                    <th>学号</th>
                                    <th>专业</th>
                                    <th>分工</th>
                                    <th>个人简介</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>刘越帅</td><td>2313752</td><td>信息安全</td><td>队长，统筹+部分后端</td><td>负责项目整体规划与协调，使用 Yii2 框架编写 Controller 层文件，处理后台用户交互逻辑。</td></tr>
                                <tr><td>杨竣羽</td><td>2313043</td><td>信息安全</td><td>前端+动态图形</td><td>负责网站前端设计与实现，使用 HTML5、CSS3 和 JavaScript 开发响应式页面和动态图形展示模块。</td></tr>
                                <tr><td>程娜</td><td>2311828</td><td>计算机科学与技术</td><td>数据库设计与管理</td><td>擅长数据库设计与优化，负责项目的数据库架构设计与维护。</td></tr>
                                <tr><td>罗仕杰</td><td>2313965</td><td>计算机科学与技术</td><td>文档撰写与测试</td><td>细心严谨，负责项目文档编写和功能测试，确保项目质量。</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="sticky-footer bg-white mt-4">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; 抗战纪念队 2023</span>
            </div>
        </div>
    </footer>
</div>
