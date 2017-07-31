<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use common\models\Products;
use common\models\ProductImages;

/* @var $this yii\web\View */
/* @var $model common\models\Recommended */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
    // find product codes
    $codes = Recommended::find()->all();
    
    // map product codes into list
    $listData = ArrayHelper::map($codes, 'product_code', 'product_name');

    // map product names into list
    $listNames = ArrayHelper::map($codes, 'product_name', 'product_name');
?>

<div class="recommended-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_code')->dropDownList($listData, ['prompt' => 'Select']) ?>

    <?= $form->field($model, 'product_name')->dropDownList($listNames, ['prompt' => 'Select']) ?>

    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
        'pluginOptions' => ['showUpload' => false],
        'options' => ['accept' => 'image/*'],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
