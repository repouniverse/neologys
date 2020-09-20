<?php
use yii\helpers\Html;
use frontend\modules\maestros\MaestrosModule as m;

$this->title = m::t('labels', 'Create Student');
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Students'), 'url' => ['index-alumnos']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentos-create">
    <h4><?= Html::encode($this->title) ?></h4>
    <?php 
    $VISTAFORMULARIO=(!($scenario==$model::SCE_EXTRANJERO))?'_form_alumno_basico':'_form_alumno_extranjero_basico';
   // var_dump($scenario,$VISTAFORMULARIO);die();
    ?>
    <?= $this->render($VISTAFORMULARIO, ['model' => $model,]) ?>
</div>
