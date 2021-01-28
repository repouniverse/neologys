<?php

use yii\helpers\Html;
use lo\widgets\modal\ModalAjax;

if (class_exists('frontend\assets\AppAsset')) {
    //var_dump($this);die();
    frontend\assets\AppAsset::register($this);
    // echo "salio";
    //die();
} else {
    frontend\assets\AppAsset::register($this);
}



?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="<?= \dmstr\helpers\AdminLteHelper::skinClass() ?>" style="overflow-y: scroll;">

    <?php $this->beginBody() ?>
    <?php 
    
    \shifrin\noty\NotyWidget::widget([
        'options' => [ // you can add js options here, see noty plugin page for available options
            'dismissQueue' => true,
            'layout' => 'center',
            'theme' => 'relax',
            'animation' => [
                'open' => 'animated flipInX',
                'close' => 'animated flipOutX',
            ],
            'timeout' => false,
        ],
        'enableSessionFlash' => true,
        'enableIcon' => true,
        'registerAnimateCss' => true,
        'registerButtonsCss' => true,
        'registerFontAwesomeCss' => true,
    ]); ?>

<?php 

echo ModalAjax::widget([
    'id' => 'buscarvalor',
    'header' => 'Buscar Valor',
    'toggleButton' => false,
    //'mode'=>ModalAjax::MODE_MULTI,
    'size'=>\yii\bootstrap\Modal::SIZE_LARGE,    
    'selector'=>'.botonAbre',
   // 'url' => $url, // Ajax view with form to load
    'ajaxSubmit' => true, // Submit the contained form as ajax, true by default
    //para que no se esconda la ventana cuando presionas una tecla fuera del marco
    'clientOptions' => ['tabindex'=>'','backdrop' => 'static', 'keyboard' => FALSE]
    // ... any other yii2 bootstrap modal option you need
]);
 ?>  


    <?= $content ?>



    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>