<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Recommended */

$this->title = 'Update Recommended: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Recommendeds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="recommended-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
