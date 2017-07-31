<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\ProductCategories;

/* @var $this yii\web\View */
/* @var $model common\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
    // find product codes
    $codes = ProductCategories::find()->all();
    
    // map product category codes into list
    $listData = ArrayHelper::map($codes, 'product_category_code', 'product_category_name');

    // map product subcategory names
    $listSub = ArrayHelper::map($codes, 'product_subcategory', 'product_subcategory');
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_category_code')->dropDownList($listData, ['prompt' => 'Select']) ?>

    <?= $form->field($model, 'product_subcategory')->dropDownList($listSub, ['prompt' => 'Select']) ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'buying_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'selling_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
