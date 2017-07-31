<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php
    use yii\bootstrap;
    use yii\bootstrap\Carousel;
    use yii\helpers\Html;
    use evgeniyrru\yii2slick\Slick;
    use kartik\popover\PopoverX;

    $this->title = 'My Yii Application';

    $this->registerJsFile("@web/js/hover-image.js");
?>
<div class="site-index">

    <div class="row carousel-pos">
        <div class="col-md-12">
            <?php
                print Carousel::widget([
                    'items' => [
                        [
                            'content' => Html::img('imgs/home1.jpg', ['alt' => 'jewelry', 'class' => 'img-responsive']),
                            'caption' => '<h4>This is title</h4><p>This is caption text</p>',
                            'options' => [],
                        ],
                        [
                            'content' => Html::img('imgs/home2.jpg', ['alt' => 'jewelry', 'class' => 'img-responsive']),
                            'caption' => '<h4>This is title</h4><p>This is caption text</p>',
                            'options' => [],
                        ],
                        [
                            'content' => Html::img('imgs/1200x480.jpg', ['alt' => 'jewelry', 'class' => 'img-responsive']),
                            'caption' => '<h4>This is title</h4><p>This is caption text</p>',
                            'options' => [],
                        ],
                    ],
                    'options' => [

                    ],
                    'controls' => [
                        '<span class="glyphicon glyphicon-chevron-left"></span>', '<span class="glyphicon glyphicon-chevron-right"></span>'
                    ],
                ]);
            ?>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-md-12">
            <p class="recommendation"><span>Naša preporuka</span></p>
        </div>
    </div>

 
 <?php
    //slick widget
    print Slick::widget([
        'itemContainer' => 'div',
        'containerOptions' => ['class' => 'myslick row'],
        'items' => [
            PopoverX::widget([
                'id' => 'myPopover',
                'header' => 'Hello World',
                'placement' => PopoverX::ALIGN_RIGHT,
                'content' => 'foo bar',
                //'footer' => Html::img('imgs/150x150.jpg', ['class' => 'img-responsive']),
                'toggleButton' => ['label' => Html::img('imgs/150x150.jpg', ['class' => 'img-responsive']), 'id' => 'btn1', 'class' => 'pop'],
                'options' => ['class' => 'popover-position'],
            ]),
            
            Html::img('imgs/150x150.jpg', ['class' => 'img-responsive']),
            Html::img('imgs/150x150.jpg', ['class' => 'img-responsive']),
            Html::img('imgs/150x150.jpg', ['class' => 'img-responsive']),
            Html::img('imgs/150x150.jpg', ['class' => 'img-responsive']),
            Html::img('imgs/150x150.jpg', ['class' => 'img-responsive']),
            Html::img('imgs/150x150.jpg', ['class' => 'img-responsive']),
        ],
        'itemOptions' => ['class' => 'slick-image'],
        'clientOptions' => [
        'infinite' => false,
        'slidesToShow' => 6,
        'slidesToScroll' => 1,
        'arrows' => true,
        'responsive' => [
            [
                'breakpoint' => 764,
                'settings' => [
                    'slidesToShow' => 4,
                    'slidesToScroll' => 3,
                    'arrows' => false,
                ],
            ],
            [
                'breakpoint' => 576,
                'settings' => [
                    'slidesToShow' => 3,
                    'slidesToScroll' => 2,
                    'arrows' => false,
                    ],
                ],
            ],
        ],
    ]);
?>
  
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="imgs/highlights1.jpg" alt="jewelry" class="img-responsive" />
                <div class="caption">
                    <h3>Thumbnail label</h3>
                    <p>...</p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="imgs/highlights2.jpg" alt="jewelry" class="img-responsive" />
                <div class="caption">
                    <h3>Thumbnail label</h3>
                    <p>...</p>
                </div>
            </div>
            <p>
                Arumluxury ...
            </p>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
            <img src="imgs/highlights3.jpg" alt="jewelry" class="img-responsive" />
                <div class="caption">
                    <h3>Thumbnail label</h3>
                    <p>...</p>
                </div>
            </div>
        </div>
    </div>    

</div>
