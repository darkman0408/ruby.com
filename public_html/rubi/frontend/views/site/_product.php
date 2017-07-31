<?php 
    use yii\helpers\Html;
    use yii\helpers\Url;
    use kartik\tabs\TabsX;
?>

<?php
    //var_dump($data);

    $name = $data['product_name'];
    $collection = $data['product_subcategory'];
    $product_description = $data['product_description'];

    $description = $desc['subcategory_description'];
?>

<?php
    $content = '<div class="row"><div class="col-md-12">' . '<span>' . $product_description . '</span>' . '</div>';
    $content .= '<div class="col-md-12">' . '<strong><span>O kolekciji:</span></strong>' . '</div>';
    $content .= '<div class="col-md-12">' .$description. '</div>';
    $content .= '</div>';

    //print $content;

    // make items variable which will be used as tabs
    $items = [
        [
            'label' => 'Opis',
            'content' => $content,
            'active' => true
        ],
        [
            'label' => 'Detalji',
            'content' => 'Detalji...',
        ],
    ];
?>

<!-- tab widget -->
<?= 
    TabsX::widget([
        'items' => $items,
        'position' => TabsX::POS_ABOVE,
        'bordered' => true,
    ])
?>