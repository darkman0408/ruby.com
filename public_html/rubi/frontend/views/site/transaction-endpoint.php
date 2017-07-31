<?php
    use Yii;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\BaseHtml;
?>

<?php 
    /*if($nonce_from_client = $_POST["payment_method_nonce"]) 
        print "true";
    else
        print "false";*/

    print $nonce_from_client;
    print '<br />';
    print $itemsCount;
    print '<br />';

    var_dump($result);
?>