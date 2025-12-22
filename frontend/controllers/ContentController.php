<?php

/**
 * Team: DBIS, NKU
 * Coding by chengna 2311828
 * This file is part of the frontend controllers for content management.
 */

namespace frontend\controllers;

use Yii;
use common\models\Hero;
use common\models\HistoricalMaterial;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * ContentController handles content management in frontend
 */
class ContentController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * 编辑英雄
     */
    public function actionEditHero($id = null)
    {
        if ($id) {
            $model = Hero::findOne($id);
            if (!$model) {
                throw new NotFoundHttpException('英雄不存在');
            }
        } else {
            $model = new Hero();
            $model->status = Hero::STATUS_ACTIVE;
            $model->sort_order = 0;
        }

        if ($model->load(Yii::$app->request->post())) {
            // 处理图片上传
            $imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($imageFile) {
                $fileName = 'hero_' . time() . '_' . uniqid() . '.' . $imageFile->extension;
                $uploadPath = Yii::getAlias('@webroot/uploads/heroes/');
                
                // 创建目录
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                
                if ($imageFile->saveAs($uploadPath . $fileName)) {
                    $model->image_url = '@web/uploads/heroes/' . $fileName;
                }
            }
            
            if ($model->save()) {
                Yii::$app->session->setFlash('success', '保存成功！');
                return $this->redirect(['/site/history']);
            }
        }

        return $this->render('edit-hero', [
            'model' => $model,
        ]);
    }

    /**
     * 编辑史料
     */
    public function actionEditMaterial($id = null)
    {
        if ($id) {
            $model = HistoricalMaterial::findOne($id);
            if (!$model) {
                throw new NotFoundHttpException('史料不存在');
            }
        } else {
            $model = new HistoricalMaterial();
            $model->status = HistoricalMaterial::STATUS_ACTIVE;
            $model->sort_order = 0;
        }

        if ($model->load(Yii::$app->request->post())) {
            // 处理图片上传
            $imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($imageFile) {
                $fileName = 'material_' . time() . '_' . uniqid() . '.' . $imageFile->extension;
                $uploadPath = Yii::getAlias('@webroot/uploads/materials/');
                
                // 创建目录
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                
                if ($imageFile->saveAs($uploadPath . $fileName)) {
                    $model->image_url = '@web/uploads/materials/' . $fileName;
                }
            }
            
            if ($model->save()) {
                Yii::$app->session->setFlash('success', '保存成功！');
                return $this->redirect(['/site/history']);
            }
        }

        return $this->render('edit-material', [
            'model' => $model,
        ]);
    }

    /**
     * 删除英雄
     */
    public function actionDeleteHero($id)
    {
        $model = Hero::findOne($id);
        if ($model) {
            $model->delete();
            Yii::$app->session->setFlash('success', '删除成功！');
        }
        return $this->redirect(['/site/history']);
    }

    /**
     * 删除史料
     */
    public function actionDeleteMaterial($id)
    {
        $model = HistoricalMaterial::findOne($id);
        if ($model) {
            $model->delete();
            Yii::$app->session->setFlash('success', '删除成功！');
        }
        return $this->redirect(['/site/history']);
    }
}
