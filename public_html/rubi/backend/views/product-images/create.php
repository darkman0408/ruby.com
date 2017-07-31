<?php

use yii\helpers\Html;
use common\models\ProductImages;


/* @var $this yii\web\View */
/* @var $model common\models\ProductImages */

$this->title = 'Create Product Images';
$this->params['breadcrumbs'][] = ['label' => 'Product Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-images-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model,]) ?>

</div>
