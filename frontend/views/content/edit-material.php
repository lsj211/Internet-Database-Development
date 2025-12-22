<?php

/**
 * Team: DBIS, NKU
 * Coding by chengna 2311828
 * This file is part of the frontend views for editing historical material content.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\HistoricalMaterial */

$this->title = $model->isNewRecord ? '创建史料' : '编辑史料：' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '抗战历史', 'url' => ['/site/history']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="material-edit">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?= Html::encode($this->title) ?></h6>
                    </div>
                    <div class="card-body">
                        <?php $form = ActiveForm::begin([
                            'options' => ['enctype' => 'multipart/form-data'],
                        ]); ?>

                        <?= $form->field($model, 'title')->textInput([
                            'maxlength' => true,
                            'placeholder' => '请输入史料标题'
                        ]) ?>

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'category')->textInput([
                                    'maxlength' => true,
                                    'placeholder' => '如：战役、宣言、文献'
                                ]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'event_date')->textInput([
                                    'type' => 'date'
                                ]) ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>上传图片 <small class="text-muted">(支持拖拽上传)</small></label>
                            <div class="custom-file-upload" id="dropZone">
                                <div class="upload-area">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                    <p>点击或拖拽图片到这里上传</p>
                                    <input type="file" name="HistoricalMaterial[imageFile]" id="materialImage" accept="image/*" style="display:none;">
                                </div>
                                <?php if ($model->image_url): ?>
                                    <div class="current-image mt-3">
                                        <p>当前图片：</p>
                                        <img src="<?= Url::to($model->image_url) ?>" alt="当前图片" style="max-width: 200px;">
                                    </div>
                                <?php endif; ?>
                                <div id="preview" class="mt-3"></div>
                            </div>
                        </div>

                        <?= $form->field($model, 'summary')->textarea([
                            'rows' => 3,
                            'placeholder' => '简短摘要...'
                        ]) ?>

                        <?= $form->field($model, 'content')->textarea([
                            'rows' => 6,
                            'placeholder' => '详细内容...'
                        ]) ?>

                        <?= $form->field($model, 'source')->textInput([
                            'maxlength' => true,
                            'placeholder' => '如：中共中央、国民革命军'
                        ]) ?>

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'sort_order')->textInput([
                                    'type' => 'number',
                                    'value' => $model->isNewRecord ? 0 : $model->sort_order
                                ])->hint('数字越小越靠前') ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'status')->dropDownList([
                                    1 => '启用',
                                    0 => '禁用'
                                ]) ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?= Html::submitButton(
                                '<i class="fas fa-save"></i> ' . ($model->isNewRecord ? '创建' : '保存'),
                                ['class' => 'btn btn-success btn-lg']
                            ) ?>
                            <?= Html::a(
                                '<i class="fas fa-arrow-left"></i> 返回',
                                ['/site/history'],
                                ['class' => 'btn btn-secondary btn-lg']
                            ) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.custom-file-upload {
    border: 2px dashed #4e73df;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s;
}
.custom-file-upload:hover {
    background: #f8f9fc;
    border-color: #2e59d9;
}
.custom-file-upload.dragover {
    background: #e3f2fd;
    border-color: #1976d2;
}
.upload-area {
    padding: 40px;
}
#preview img {
    max-width: 300px;
    margin-top: 10px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}
</style>

<?php
$js = <<<JS
$(document).ready(function() {
    var dropZone = $('#dropZone');
    var fileInput = $('#materialImage');
    var preview = $('#preview');
    
    dropZone.click(function(e) {
        if (e.target.tagName !== 'INPUT') {
            fileInput.click();
        }
    });
    
    fileInput.change(function() {
        handleFiles(this.files);
    });
    
    dropZone.on('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).addClass('dragover');
    });
    
    dropZone.on('dragleave', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).removeClass('dragover');
    });
    
    dropZone.on('drop', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).removeClass('dragover');
        
        var files = e.originalEvent.dataTransfer.files;
        if (files.length > 0) {
            fileInput[0].files = files;
            handleFiles(files);
        }
    });
    
    function handleFiles(files) {
        preview.empty();
        if (files.length > 0) {
            var file = files[0];
            if (file.type.startsWith('image/')) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.html('<img src="' + e.target.result + '" alt="预览">');
                };
                reader.readAsDataURL(file);
            }
        }
    }
});
JS;
$this->registerJs($js);
?>
