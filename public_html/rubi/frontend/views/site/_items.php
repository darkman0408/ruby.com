<?php 
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\bootstrap\ActiveForm;
    use yii\bootstrap;
    use yii\bootstrap\Carousel;
    use amilna\elevatezoom\ElevateZoom;
?>

<?php
    $image_url = []; // regular image

    $data_image = []; // zoom image

    $data_image_items = []; // store zoom images

    $items = []; // store regular images

    // function to remove dots in image url
    function removeDots($string)
    {
        $string = str_replace('..', '', $string);

        return $string;
    }
?>

<?php
    // zoom image loop
    foreach($zooms as $zoom)
    {
        // remove dots for zoom image
        $data_image[] = removeDots($zoom['zoomed_url']);
        /*$data_image = explode("..", $data_image);
        unset($data_image[0]);
        $data_image[] = implode("", $data_image);*/

        
     }
     $data_image_items = $data_image;

    // regular image loop
    foreach($images as $key => $image)
    {
        // remove dots for regular image
        $image_url = removeDots($image['image_url']);
        /*$image_url = explode("..", $image_url);
        unset($image_url[0]);
        $image_url = implode("", $image_url);*/
    
        $items[] = [
            Html::img($image_url, ['id' => 'zoomLens', 'alt' => 'ruby', 'data-zoom-image' => $data_image_items[$key]])
        ];
    }
?>

<div id="carousel-product" class="carousel slide" data-interval="false" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <!-- number of items is number of indicators -->
        <?php for($i = 0, $n = count($items); $i < $n; $i++): ?>

            <?php
                $active_class = ($i == 0) ? 'active' : '';
            ?>

            <li data-target="#carousel-product" data-slide-to="<?= $i ?>" class="<?= $active_class ?>"></li>
          
        <?php endfor; ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <?php $i = 1; // counter for item div ?>
        <?php foreach($items as $item): ?>
            <?php        
                $counter = 0; // count item arrays
                $item_class = '';       
                $item_class = ($i == 1) ? 'item active' : 'item'; // first item div is active
            ?>
            <div class="<?= $item_class ?>">
                <a href="#">
                    <?= $item[$counter] ?>
                </a>
            </div>

            <?php 
                $i++;
                $counter++; 
            ?>
        <?php endforeach; ?>
    </div>
</div>

<script>
    $('#carousel-product').on('slid.bs.carousel', function () {
        $(".carousel").carousel("pause");
    });
</script>

<script>
    $("#zoomLens").elevateZoom({
        zoomType: "lens",
        lensShape: "round",
        lensSize: 250
    });
</script>