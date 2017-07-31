<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProductCharacteristicsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-characteristics-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'product_code') ?>

    <?= $form->field($model, 'material') ?>

    <?= $form->field($model, 'dimension') ?>

    <?= $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'size') ?>

    <?php // echo $form->field($model, 'type_of_stone') ?>

    <?php // echo $form->field($model, 'unit_of_measure') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
