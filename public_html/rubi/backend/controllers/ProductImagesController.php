<?php

namespace backend\controllers;

use Yii;
use common\models\ProductImages;
use common\models\ProductImagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\Products;

/**
 * ProductImagesController implements the CRUD actions for ProductImages model.
 */
class ProductImagesController extends Controller
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
     * Lists all ProductImages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductImagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductImages model.
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
     * Creates a new ProductImages model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductImages();
        
        //$products = new Products();
        
        //$hello = $model->getProductCode()->link['product_code'];
        //$hello = Products::findOne($model->product_code);

        if ($model->load(Yii::$app->request->post())) 
        {
            $model->image = UploadedFile::getInstance($model, 'image');

            if($model->image)
                $model->upload();

            $model->save();            

            return $this->redirect(['thumb/create',]);
        } 
        else 
        {
            return $this->render('create', ['model' => $model,]);
        }
    }

    /**
     * Updates an existing ProductImages model.
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
     * Deletes an existing ProductImages model.
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
     * Finds the ProductImages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductImages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductImages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
