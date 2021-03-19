<?php

use yii\helpers\Html;
use common\helpers\h;

/* @var $this yii\web\View */
/* @var $model frontend\modules\encuesta\models\EncuestaTipoEncuesta */

$this->title = Yii::t('app', 'CREAR TIPO DE ENCUESTA');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', ' Tipo de Encuestas - Paso 1'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="encuesta-tipo-encuesta-create">

<h4><?=h::space(10).Html::encode($this->title) ?></h4>
<div class="box box-success">
    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div> 
