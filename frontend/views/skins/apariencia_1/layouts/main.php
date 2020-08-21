<?php
use yii\helpers\Html;
use lo\widgets\modal\ModalAjax;
/* @var $this \yii\web\View */
/* @var $content string */

$accion=Yii::$app->controller->action->id ;

if ($accion=== 'login') { 
   
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
}
elseif($accion=='request-password-reset'){
   
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
}
elseif($accion=='reset-password'){
   
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
}
elseif($accion=='signup'){
   
    echo $this->render(
        'main-login',
        ['content' => $content]
    );

}elseif($accion=='base-auth'){
   
    echo $this->render(
        'main-login',
        ['content' => $content]
    );

}elseif($accion=='aditional-auth'){
   
    echo $this->render(
        'main-login',
        ['content' => $content]
    );

}elseif($accion=='auth-end-first'){
   
    echo $this->render(
        'main-login',
        ['content' => $content]
    );

    
    
}elseif($accion=='verify-email-token-auth'){
   
    echo $this->render(
        'main-login',
        ['content' => $content]
    );

  
    
}else{


    if (class_exists('frontend\assets\AppAsset')) {
        
        frontend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    \frontend\views\skins\apariencia_1\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    //$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@frontend/views/skins/apariencia_1/');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
     <body class="hold-transition <?= \frontend\views\skins\apariencia_1\AdminLteHelper::skinClass() ?>" sidebar-mini">

    <?php $this->beginBody() ?>
    <div class="wrapper">
        

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
        
        
        
        <?php \shifrin\noty\NotyWidget::widget([
    'options' => [ // you can add js options here, see noty plugin page for available options
        'dismissQueue' => true,
        'layout' => 'center',
        'theme' => 'metroui',
        'animation' => [
            'open' => 'animated flipInX',
            'close' => 'animated flipOutX',
        ],
        'timeout' =>1000, //false para que no se borre
        'progressBar'=>true,
    ],
    'enableSessionFlash' => true,
    'enableIcon' => true,
    'registerAnimateCss' => true,
    'registerButtonsCss' => true,
    'registerFontAwesomeCss' => true,
]); ?>
        
        
        
        
        
        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
