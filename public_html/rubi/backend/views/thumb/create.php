<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Thumb */

$this->title = 'Create Thumb';
$this->params['breadcrumbs'][] = ['label' => 'Thumbs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thumb-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model,]) ?>

</div>
