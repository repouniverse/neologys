<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
     <?php $this->registerCssFile("@web/css/AdminLTE.min.css", [], 'css-install222'); ?>
        
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body style="background-image:url('fondo_azul.png');margin:10px; padding:10px;">
    <?php $this->beginBody() ?>
   
    <?= $content ?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
