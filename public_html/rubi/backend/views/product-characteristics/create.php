<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProductCharacteristics */

$this->title = 'Create Product Characteristics';
$this->params['breadcrumbs'][] = ['label' => 'Product Characteristics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-characteristics-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
