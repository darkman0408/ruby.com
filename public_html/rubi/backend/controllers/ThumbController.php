<?php

namespace backend\controllers;

use Yii;
use common\models\Thumb;
use common\models\ThumbSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\ProductImages;

/**
 * ThumbController implements the CRUD actions for Thumb model.
 */
class ThumbController extends Controller
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
     * Lists all Thumb models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ThumbSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Thumb model.
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
     * Creates a new Thumb model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Thumb();

        if ($model->load(Yii::$app->request->post())) 
        {
            $model->thumb = UploadedFile::getInstance($model, 'thumb');

            if($model->thumb)
                $model->uploadThumb();

            $model->save();            

            return $this->redirect(['zoomed/create',]);
        } 
        else 
        {
            return $this->render('create', ['model' => $model]);
        }
    }

    /**
     * Updates an existing Thumb model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) 
        {
            $model->thumb = UploadedFile::getInstance($model, 'thumb');

            if($model->thumb)
                $model->uploadThumb();

            $model->save();            

            return $this->redirect(['index']);
        } 
        else 
        {
            return $this->render('update', ['model' => $model,]);
        }
    }

    /**
     * Deletes an existing Thumb model.
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
     * Finds the Thumb model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Thumb the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Thumb::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
