<?php

namespace backend\controllers;

use Yii;
use common\models\Zoomed;
use common\models\ZoomedSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\ProductImages;

/**
 * ZoomedController implements the CRUD actions for Zoomed model.
 */
class ZoomedController extends Controller
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
     * Lists all Zoomed models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ZoomedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Zoomed model.
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
     * Creates a new Zoomed model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Zoomed();

        if ($model->load(Yii::$app->request->post())) 
        {
            
            $model->image = UploadedFile::getInstance($model, 'image');

            if($model->image)
                $model->upload();

            $model->save();            

            return $this->redirect(['products/index']);
        }
        else 
        {
            return $this->render('create', ['model' => $model]);
        }
    }

    /**
     * Updates an existing Zoomed model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) 
        {
            $model->image = UploadedFile::getInstance($model, 'image');

            if($model->image)
                $model->upload();

            $model->save();            

            return $this->redirect(['index']);
        } 
        else 
        {
            return $this->render('update', ['model' => $model,]);
        }
    }

    /**
     * Deletes an existing Zoomed model.
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
     * Finds the Zoomed model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Zoomed the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Zoomed::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
