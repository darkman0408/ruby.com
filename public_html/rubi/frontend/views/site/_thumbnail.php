<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
?>

<?php
    $thumb_url = []; // array variable to store path to thumbnail
    $id = 0; // variable to store id of thumbnail
?>

<?php foreach($thumbs as $thumb): ?>
    
    <?php
        // remove unnecessary '..' in url
        $thumb_url = $thumb['thumb_url'];
        $thumb_url = explode("..", $thumb_url);
        unset($thumb_url[0]);
        $thumb_url = implode("", $thumb_url);

        // store id
        $id = $thumb['product_code'];
    ?>

    <div class="col-xs-12 col-md-3">
        <div class="thumbnail"> 
            <?php
                print Html::a(Html::img($thumb_url, ['alt' => 'rubi']),
                    ['item', 'id' => $id]
                );
            ?>
        </div>
    </div>

<?php endforeach; ?>