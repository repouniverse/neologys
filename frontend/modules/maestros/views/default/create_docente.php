<?php
use yii\helpers\Html;
use frontend\modules\maestros\MaestrosModule as m;

$this->title = m::t('labels', 'Create Teacher');
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Teachers'), 'url' => ['index-docentes']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentos-create">
    <h4><?= Html::encode($this->title) ?></h4>
    <div class="box box-success">   
          <?php 
    $VISTAFORMULARIO=(!($scenario==$model::SCE_EXTRANJERO))?'_form_docente_basico':'_form_docente_extranjero_basico';
   // var_dump($scenario,$VISTAFORMULARIO);die();
    ?>
    <?= $this->render($VISTAFORMULARIO, ['model' => $model,]) ?>
        
        
        
       
    </div>
</div>
