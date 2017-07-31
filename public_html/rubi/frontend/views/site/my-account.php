<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
?>

<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Prijava</h3>
            </div>
            <div class="panel-body">
                <p>Prijavite se svojim korisničkim imenom</p>
                <p><?= Html::a('Prijava', Url::toRoute('site/login'), [
                    'class' => 'btn btn-default'
                ]) ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Registracija</h3>
            </div>
            <div class="panel-body">
                <p>Nemate korisničko ime. Učlanite se.</p>
                <p><?= Html::a('Registracija', Url::toRoute('site/signup'), [
                    'class' => 'btn btn-default'
                ]) ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Društvene mreže</h3>
            </div>
            <div class="panel-body">
                <p>Društvene mreže</p>
            </div>
        </div>
    </div>
</div>