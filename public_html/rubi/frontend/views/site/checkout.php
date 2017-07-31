<?php
    use Yii;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\BaseHtml;

    $this->registerJsFile("@web/js/payment.js");
?>

<?php
    print $this->render('_payment-options', [
        'user' => $user,
        'clientToken' => $clientToken,
    ]);
?>