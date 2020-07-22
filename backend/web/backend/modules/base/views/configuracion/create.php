<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\GrupoParametros */

$this->title = Yii::t('backend.base', 'Create Grupo Parametros');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend.base', 'Grupo Parametros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-parametros-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>