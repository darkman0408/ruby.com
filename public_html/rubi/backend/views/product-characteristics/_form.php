<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Products;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\ProductCharacteristics */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
    // find product codes
    $codes = Products::find()->all();
    
    // map product codes into list
    $listData = ArrayHelper::map($codes, 'product_code', 'product_code');
?>

<div class="product-characteristics-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_code')->dropDownList($listData, ['prompt' => 'Select']) ?>

    <?= $form->field($model, 'material')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dimension')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_of_stone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit_of_measure')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sex')->dropDownList(['m' => 'Male', 'f' => 'Female', 'u' => 'Unisex'], ['prompt' => 'Select']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
