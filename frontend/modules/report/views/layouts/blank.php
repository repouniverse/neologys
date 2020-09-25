<?php
use yii\helpers\Html;
use frontend\modules\report\assets\ReportAsset;
      ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <?php  ReportAsset::register($this);   ?>
         <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
   <body style="overflow-y: scroll;">
   <?php $this->beginBody(); ?>
        <?= $content ?>
   <?php $this->endBody(); ?>
    </body>
    </html>
    <?php $this->endPage() ?>



       
       
       
       
       
       