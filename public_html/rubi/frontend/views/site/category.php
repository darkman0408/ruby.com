<?php
    use yii\bootstrap\Collapse;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\ArrayHelper;
    use yii\bootstrap\ActiveForm;

    $this->registerJsFile("@web/js/checkboxes.js");
?>

<?php
    
?>

<div class="row">
    <?php $form = ActiveForm::begin([
        'action' => ['site/filter-images'],
        'id' => 'form1'
        ]); ?>
    <div class="col-sm-2 col-md-2">
    
        <div class="accordion" id="accordion">
            <!-- Briljantin checkboxes -->
            <div class="accordion-group">
                <div class="accordion-heading">
                    
                    <a class="accordion-toggle " data-toggle="collapse" data-target="#collapseOne" href="#">
                        Briljantin
                    </a>
                    
                </div>
                <div id="collapseOne" class="collapse in">
                    <div class="accordion-inner list-group">
                        <?= $this->render('_briliant_checkbox', ['items' => $items]) ?>
                        
                    </div>
                </div>
            </div>
            <!-- Nakit checkboxes -->
            <div class="accordion-group">
                <div class="accordion-heading">
                    
                    <a role="button" class="accordion-toggle" data-toggle="collapse" data-target="#collapseTwo" href="#">
                        Nakit
                    </a>
                    
                </div>
                <div id="collapseTwo" class="collapse">
                    <div class="accordion-inner list-group">
                        <?= $this->render('_jewelry_checkbox', ['items' => $jewelry_items]); ?>
                    </div>
                </div>
            </div>
            <!-- Metal checkboxes -->
            <div class="accordion-group">
                <div class="accordion-heading">
                    
                    <a role="button" class="accordion-toggle" data-toggle="collapse" data-target="#collapseThree" href="#">
                        Metal
                    </a>
                    
                </div>
                <div id="collapseTwo" class="collapse">
                    <div class="accordion-inner list-group">
                        <?= $this->render('_metal_checkbox', ['items' => $metal_items]); ?>
                    </div>
                </div>
            </div>
            <!-- Investicije checkboxes -->
            <div class="accordion-group">
                <div class="accordion-heading">
                    
                    <a role="button" class="accordion-toggle" data-toggle="collapse" data-target="#collapseFour" href="#">
                        Investicije
                    </a>
                    
                </div>
                <div id="collapseTwo" class="collapse">
                    <div class="accordion-inner list-group">
                        <?= $this->render('_investment_checkbox', ['items' => $investment_items]); ?>
                    </div>
                </div>
            </div>
            <!-- Charact begin -->
            <div class="accordion-group">
                <div class="accordion-heading">
                    
                    <a role="button" class="accordion-toggle" data-toggle="collapse" data-target="#collapseFour" href="#">
                        Timepeace
                    </a>
                    
                </div>
                <div id="collapseTwo" class="collapse">
                    <div class="accordion-inner list-group">
                        
                    </div>
                </div>
            </div>
            <!-- Charact end -->
        </div>
       
    </div>
    <?php ActiveForm::end(); ?>
    <div class="col-sm-10 col-md-10">
        <div class="row">
            <div id="data-container">

                <?php 
                    switch($category_code['category'])
                    {
                        case 'BRI001':
                            print $this->render('_thumbnail', ['thumbs' => $thumbs]);
                            break;
                        case 'NAK001':
                            print $this->render('_thumbnail', ['thumbs' => $thumbs]);
                            break;
                        case 'MET001':
                            print $this->render('_thumbnail', ['thumbs' => $thumbs]);
                            break;
                        case 'INV001':
                            print $this->render('_thumbnail', ['thumbs' => $thumbs]);
                            break;
                    } 
                ?>

                </div>
        </div>
    </div>
</div>