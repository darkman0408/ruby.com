<?php
    use Yii;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\bootstrap\ActiveForm;
    use yii\web\View;
?>

<?php //var_dump (Yii::$app->cart->positions) ?>

<?php foreach(Yii::$app->cart->positions as $position): ?>

    <p>Id: <?= $position->id ?></p>

    <p>Proizvod: <?= $position->product_name ?></p>

    <p>Cijena: <?= $position->selling_price ?> kn</p>

    <p>Količina: <?= $count ?></p>

<?php endforeach; ?>

    <p>Total: <?= $total ?></p>

<?php
    $username = Yii::$app->user->identity->username;
    
    print Html::a('Checkout', ['site/checkout', 'username' => $username, 'total' => $total], [
        'class' => 'btn btn-primary',
    ]); 
?>

<?php
    
?>