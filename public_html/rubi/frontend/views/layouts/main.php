<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Collapse;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use kartik\nav\NavX;
use kartik\icons\Icon;
use frontend\assets\LocateAsset;
use common\models\Products;
use common\models\ProductCategories;

LocateAsset::register($this);
Icon::map($this, Icon::FA);

$this->registerCssFile("@web/css/demo.css");
$this->registerCssFile("@web/css/yamm.css");

//AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <div class="row">
        <!-- User account -->
        <div class="col-xs-offset-0 col-md-offset-8 col-md-2 col-xs-6">
            <span>
                <?php
                    if(Yii::$app->user->isGuest) 
                    {
                        print '<div class="myAccount">' . Html::a('Moj Račun', Url::toRoute('site/my-account')) . '</div>';
                    }
                    else
                    {
                        print '<ul>';
                            print '<li class="dropdown">';
                                print '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
                                    print '<span class="glyphicon glyphicon-user"></span>';
                                    print '<strong>' . Yii::$app->user->identity->username . '</strong>';
                                    print '<span class="glyphicon glyphicon-chevron-down"></span>';
                                print '</a>';
                                    print '<ul class="dropdown-menu">';
                                        print '<li>';
                                            print '<div class="row">';
                                                print '<div class="col-md-12">' . Html::a('Settings', Url::toRoute('#')) . '</div>';
                                            print '</div>';
                                            print '<div class="row">';
                                                print '<div class="col-md-12">' . Html::beginForm(['/site/logout'], 'post') . Html::submitButton('Sign Out') . Html::endForm() . '</div>';
                                            print '</div>';
                                        print '</li>';
                                    print '</ul>';
                                print '</li>';
                        print '</ul>';
                    } 
                ?>
            </span>
        </div>
        <!-- User account end -->
        <!-- Basket -->
        <div class="col-md-2 col-xs-6">
            <span class="cart">
                <?php
                    $basket = Icon::show('cart-plus', ['class' => 'fa'], Icon::FA);

                    if(Yii::$app->user->isGuest) 
                    {
                        print '<div class="basket">' . Html::a($basket, Url::toRoute('site/login')) . '</div>';
                    }
                    else
                    {
                        print '<div class="basket">' . Html::a($basket, Url::toRoute('site/cart')) . '</div>';
                    }
                ?>
            </span>
            <?php
                $itemsCount = Yii::$app->cart->getCount();
                if($itemsCount < 1)
                {
                    $itemsCount = '';
                }
                else
                {
                    print '<span class="items">' . $itemsCount . '</span>';
                }
            ?>
        </div>
        <!-- Basket end -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1>Ruby</h1>
        </div>
    </div>

    <?php
        /* label for briljantin */
        $lbl_briljantin = '<div class="row"><div class="col-sm-2"><p>Categories</p>';
        foreach(ProductCategories::getCategoryBriliant() as $array)
        {
            $lbl_briljantin .= '<p>' . Html::a($array['label'], $array['url']) . '</p>';
        }
        $lbl_briljantin .= '</div><div class="col-sm-2"><figure><img src="/../imgs/190x150.jpg" /><figcaption>Bouton d\'or</figcaption></figure></div>
        <div class="col-sm-2"><figure><img src="/../imgs/190x150.jpg" /><figcaption>Alhambra</figcaption></figure></div>
        <div class="col-sm-2"><figure><img src="/../imgs/190x150.jpg" /><figcaption>Perlee</figcaption></figure></div>
        <div class="col-sm-2"><figure><img src="/../imgs/190x150.jpg" /><figcaption>Flowers</figcaption></figure></div>
        <div class="col-sm-2"><figure><img src="/../imgs/190x150.jpg" /><figcaption>Flying Beauties</figcaption></figure></div></div>';
        /*end of briljantin label*/

        /* label for nakit */
        $lbl_nakit = '<div class="row"><div class="col-sm-2"><p>Categories</p>';
        foreach(ProductCategories::getCategoryJewelry() as $array)
        {
            $lbl_nakit .= '<p>' . Html::a($array['label'], $array['url']) . '</p>';
        }
        $lbl_nakit .= '</div><div class="col-sm-2"><figure><img src="/../imgs/190x150.jpg" /><figcaption>Bouton d\'or</figcaption></figure></div>
        <div class="col-sm-2"><figure><img src="/../imgs/190x150.jpg" /><figcaption>Alhambra</figcaption></figure></div>
        <div class="col-sm-2"><figure><img src="/../imgs/190x150.jpg" /><figcaption>Perlee</figcaption></figure></div>
        <div class="col-sm-2"><figure><img src="/../imgs/190x150.jpg" /><figcaption>Flowers</figcaption></figure></div>
        <div class="col-sm-2"><figure><img src="/../imgs/190x150.jpg" /><figcaption>Flying Beauties</figcaption></figure></div></div>';
        /*end of nakit label*/

        /* label for metal */
        $lbl_metal = '<div class="row"><div class="col-sm-2"><p>Categories</p>';
        foreach(ProductCategories::getCategoryMetal() as $array)
        {
            $lbl_metal .= '<p>' . Html::a($array['label'], $array['url']) . '</p>';
        }
        $lbl_metal .= '</div><div class="col-sm-2"><figure><img src="/../imgs/190x150.jpg" /><figcaption>Bouton d\'or</figcaption></figure></div>
        <div class="col-sm-2"><figure><img src="/../imgs/190x150.jpg" /><figcaption>Alhambra</figcaption></figure></div>
        <div class="col-sm-2"><figure><img src="/../imgs/190x150.jpg" /><figcaption>Perlee</figcaption></figure></div>
        <div class="col-sm-2"><figure><img src="/../imgs/190x150.jpg" /><figcaption>Flowers</figcaption></figure></div>
        <div class="col-sm-2"><figure><img src="/../imgs/190x150.jpg" /><figcaption>Flying Beauties</figcaption></figure></div></div>';
        /*end of nakit metal*/

        /* label for investment */
        $lbl_investment = '<div class="row"><div class="col-sm-2"><p>Categories</p>';
        foreach(ProductCategories::getCategoryInvestment() as $array)
        {
            $lbl_investment .= '<p>' . Html::a($array['label'], $array['url']) . '</p>';
        }
        $lbl_investment .= '</div><div class="col-sm-2"><figure><img src="/../imgs/190x150.jpg" /><figcaption>Bouton d\'or</figcaption></figure></div>
        <div class="col-sm-2"><figure><img src="/../imgs/190x150.jpg" /><figcaption>Alhambra</figcaption></figure></div>
        <div class="col-sm-2"><figure><img src="/../imgs/190x150.jpg" /><figcaption>Perlee</figcaption></figure></div>
        <div class="col-sm-2"><figure><img src="/../imgs/190x150.jpg" /><figcaption>Flowers</figcaption></figure></div>
        <div class="col-sm-2"><figure><img src="/../imgs/190x150.jpg" /><figcaption>Flying Beauties</figcaption></figure></div></div>';
        /*end of nakit investment*/
    ?>

    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-default navbar-static-top navbar yamm',
        ],
    ]);
    $menuItems = [
        /*['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],*/

        ['label' => 'BRILJANTIN', 'url' => '#', 'options' => ['class' => 'yamm-fw'], 'linkOptions' => [
            'class' => 'dropdown-toggle',
            'data-toggle' => 'dropdown',
            'role' => 'button',
            'aria-haspopup' => 'true',
            'aria-expanded' => 'false'
            ],
            'items' => [
                ['label' => $lbl_briljantin, 'options' => ['class' => 'grid-demo']],
            ],
        ],

        ['label' => 'NAKIT', 'url' => '#', 'options' => ['class' => 'yamm-fw'], 'linkOptions' => [
            'class' => 'dropdown-toggle',
            'data-toggle' => 'dropdown',
            'role' => 'button',
            'aria-haspopup' => 'true',
            'aria-expanded' => 'false'
            ],
            'items' => [
                ['label' => $lbl_nakit, 'options' => ['class' => 'grid-demo']],
            ],
        ],

        ['label' => 'METAL', 'url' => '#', 'options' => ['class' => 'yamm-fw'], 'linkOptions' => [
            'class' => 'dropdown-toggle',
            'data-toggle' => 'dropdown',
            'role' => 'button',
            'aria-haspopup' => 'true',
            'aria-expanded' => 'false'
            ],
            'items' => [
                ['label' => $lbl_metal, 'options' => ['class' => 'grid-demo']],
            ],
        ],

        ['label' => 'INVESTICIJE', 'url' => '#', 'options' => ['class' => 'yamm-fw'], 'linkOptions' => [
            'class' => 'dropdown-toggle',
            'data-toggle' => 'dropdown',
            'role' => 'button',
            'aria-haspopup' => 'true',
            'aria-expanded' => 'false'
            ],
            'items' => [
                ['label' => $lbl_investment, 'options' => ['class' => 'grid-demo']],
            ],
        ],
    ];
    echo NavX::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
        'encodeLabels' => false
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
