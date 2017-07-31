<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-md-6">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <div class="form-group col-md-12">
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                </div>
        
                <div class="form-group col-md-12">
                    <?= $form->field($model, 'email') ?>
                </div>

                <div class="form-group col-md-12">
                    <?= $form->field($model, 'password')->passwordInput() ?>
                </div>
                         
        </div>

        <div class="col-md-6">
            <div class="form-group col-md-6">
                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>                   
            </div>

            <div class="form-group col-md-6">
                <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="form-group col-md-8">
                <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="form-group col-md-4">
                <?= $form->field($model, 'postal_code')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="form-group col-md-6">
                <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="form-group col-md-6">
                <?= $form->field($model, 'contact_number')->textInput(['maxlength' => true]) ?>
            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
