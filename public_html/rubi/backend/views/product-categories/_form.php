<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProductCategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_category_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_category_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_subcategory')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subcategory_description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
