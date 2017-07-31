<?php
    use yii\bootstrap\Collapse;
    use kartik\checkbox\CheckboxX;
?>

<?php
    foreach($items as $item)
    {
        print '<p>' . CheckboxX::widget([
            'name' => 'ruby[]',
            //$model => $model,
            'attribute' => 'status',
            'autoLabel' => true,
            'value' => $item['code'],
            'pluginOptions' => [
                'threeState' => false,
                'inline' => true,
                'size' => 'xs'
            ],
            'labelSettings' => [
                'encodeLabels' => true,
                'label' => $item['label'],
                'position' => CheckboxX::LABEL_RIGHT,
                //'options' => [],
            ],
            'options' => [
                'id' => $item['code'],
                'type' => 'checkbox',
                //'checked' => 'checked',
                'class' => 'getValue',
                //'onchange' => 'this.form.submit();',
            ],
        ]) . '</p>';       
    }
?>

