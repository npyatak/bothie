<?php

namespace backend\controllers;

use Yii;
use common\models\IndexAdvice;
use common\models\search\IndexAdviceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * IndexAdviceController implements the CRUD actions for IndexAdvice model.
 */
class IndexAdviceController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all IndexAdvice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IndexAdviceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IndexAdvice model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new IndexAdvice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new IndexAdvice();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->imageFile1 = UploadedFile::getInstance($model, 'imageFile1');
            if(!empty($model->imageFile1)) {
                $this->uploadImage($model->imageFile1, $model, 'image_1');
            }
            $model->imageFile2 = UploadedFile::getInstance($model, 'imageFile2');
            if(!empty($model->imageFile2)) {
                $this->uploadImage($model->imageFile2, $model, 'image_2');
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    private function uploadImage($file, $model, $attribute) {
        $path = $model->imageSrcPath;
        if($model->$attribute && file_exists($path.$model->$attribute)) {
            unlink($path.$model->$attribute);
        }

        $model->$attribute = $model->order.'_'.$attribute.'.'.$file->extension;
        if(!file_exists($path)) {
            mkdir($path, 0775, true);
        }

        $file->saveAs($path.$model->$attribute);

        $model->save(false, [$attribute]);
    }
    /**
     * Updates an existing IndexAdvice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->imageFile1 = UploadedFile::getInstance($model, 'imageFile1');
            if(!empty($model->imageFile1)) {
                $this->uploadImage($model->imageFile1, $model, 'image_1');
            }
            $model->imageFile2 = UploadedFile::getInstance($model, 'imageFile2');
            if(!empty($model->imageFile2)) {
                $this->uploadImage($model->imageFile2, $model, 'image_2');
            }
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing IndexAdvice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the IndexAdvice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return IndexAdvice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IndexAdvice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
