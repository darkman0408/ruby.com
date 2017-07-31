<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\bootstrap;
    use yii\bootstrap\ActiveForm;
    use yii\bootstrap\Carousel;
    use kartik\tabs\TabsX;
    use kartik\icons\Icon;
    use yii\web\View;

    Icon::map($this, Icon::FA);

    $this->registerJsFile("@web/js/jquery.elevateZoom-3.0.8.min.js", ['position' => View::POS_BEGIN]);
?>

<?php
    /*print Carousel::widget([
        'items' => [ 
            'content' => $this->render('_items', ['images' => $images,])
        ],
    ]);*/
    //print $this->render('_items', ['images' => $images,]);
?>

<div class="row">
    
    <div class="panel panel-default">
        
        <div class="col-md-4">
            <?= $this->render('_items', ['images' => $images, 'zooms' => $zooms]) ?>
        </div>

        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <span><?= Html::encode($data['product_name']) ?></span>
                </div>
                <div class="col-md-12">
                    <span><?= Html::encode($data['product_subcategory']) ?></span>
                </div>
            </div>
            <?= $this->render('_product', ['data' => $data, 'desc' => $desc]); ?>
            <div class="row">
                <div class="col-md-12">
                    <?php 
                        $form = ActiveForm::begin(['class' => 'form-horizontal', 'action' => Url::toRoute([
                            'site/add-to-cart', 'product_code' => $data['product_code'], 'id' => $data['id'], 
                        ])]); 
                    ?>
                    <?php 
                        $button = Icon::show('shopping-cart', ['class' => 'fa-2x'], Icon::FA);

                        print Html::submitButton($button . 'Dodaj u košaricu', [
                            'class' => 'button add',
                            'name' => 'cart_submit',
                        ]);

                    ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

</div>