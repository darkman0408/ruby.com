<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'email:email',
            [
                'label' => 'User Role',
                'attribute' => 'role',
                'filter' => ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name'),
            ],
            [
                'attribute' => 'status',
                'format' => 'text',
                'value' => function($model) { return $model->getStatusLabel(); }
            ],
            [
                'attribute' => 'created_at',
                'label' => 'Created at',
                'format' => 'datetime'
            ],
            [
                'attribute' => 'updated_at',
                'label' => 'Updated at',
                'format' => 'datetime'
            ],
            // 'auth_key',
            // 'status',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
