<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Zoomed */

$this->title = 'Update Zoomed: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Zoomeds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="zoomed-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
