<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductCharacteristicsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Characteristics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-characteristics-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product Characteristics', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'product_code',
            'material',
            'dimension',
            'weight',
            'size',
            'type_of_stone',
            'unit_of_measure',
            'sex',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
