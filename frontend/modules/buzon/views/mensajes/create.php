<div class="contenedor-form">
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\buzon\models\BuzonMensajes */

echo Html::img('http://www.fcctp.usmp.edu.pe/fcctpforms/solicitudbuzon2/images/cabecera_solicitud.jpg',
 [
     'style' =>  ['width' => '100%', 'margin-top' => '33px', 'margin-left' => '0%']
 ]
);

$this->title = Yii::t('app', 'Create Buzon Mensajes');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Buzon Mensajes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buzon-mensajes-create">

    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>