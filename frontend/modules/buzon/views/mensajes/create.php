<div class="contenedor-form">
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\buzon\models\BuzonMensajes */

echo Html::img('http://www.fcctp.usmp.edu.pe/fcctpforms/solicitudbuzon2/images/cabecera_solicitud.jpg',
 ['style' => ['width' => '60%', 'margin-top' => '33px', 'margin-left' => '20%']]
);

//$this->title = Yii::t('app', 'Create Buzon Mensajes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Buzon Mensajes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = "$this->title";
?>
<div class="buzon-mensajes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

