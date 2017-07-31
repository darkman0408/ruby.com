<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Recommended */

$this->title = 'Create Recommended';
$this->params['breadcrumbs'][] = ['label' => 'Recommendeds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recommended-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
