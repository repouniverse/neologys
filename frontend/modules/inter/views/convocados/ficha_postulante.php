<?php

use yii\helpers\Html;
use kartik\tabs\TabsX;
use common\helpers\h;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Talleres */
ECHO \common\widgets\spinnerWidget\spinnerWidget::widget();
/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterConvocados */

$this->title = Yii::t('base_labels', 'Fill in personal data : {name}', [
    'name' => $modelP->fullName(),
]);
//$this->params['breadcrumbs'][] = ['label' => substr($model->programa->descripcion,0,10), 'url' => ['/inter/programa/update', 'id' => $model->programa->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'My panel'), 'url' => [h::user()->resolveUrlAfterLogin()]];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
///$this->params['breadcrumbs'][] = Yii::t('base_labels', 'Update');
?>
<div class="inter-convocados-update">
<h4><i class="fa fa-edit"></i><?= Html::encode($this->title) ?></h4>
   
    <div class="box box-success">
     <?php 
   // VAR_DUMP($model->currentStage(),$model->firstExpediente());DIE();
     echo $this->render('@frontend/modules/inter/views/convocados/_progress_convocado',['identidad'=>$modelP->identidad]);?>   
    <?php echo $this->render('_form_postulante',['model' => $model, 'modelP'=>$modelP]); ?>
    </div>
</div>
