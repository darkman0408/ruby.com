<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    //['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    //['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
                    //['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
                    ['label' => 'Kategorije', 'icon' => 'fa fa-folder', 'url' => ['/product-categories/index']],
                    ['label' => 'Proizvodi', 'icon' => 'fa fa-folder', 'url' => ['/products/index']],
                    ['label' => 'Opis Proizvoda', 'icon' => 'fa fa-folder', 'url' => ['/product-characteristics/index']],
                    ['label' => 'Slika Proizvoda', 'icon' => 'fa fa-folder', 'url' => ['/product-images/index']],
                    ['label' => 'Thumbnail Slika', 'icon' => 'fa fa-folder', 'url' => ['/thumb/index']],
                    ['label' => 'Slika za Zoom', 'icon' => 'fa fa-folder', 'url' => ['/zoomed/index']],
                ],
            ]
        ) ?>

    </section>

</aside>