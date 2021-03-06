<?php

use yii\helpers\Html;
use kartik\tabs\TabsX;
use common\helpers\h;
use frontend\modules\inter\Module as m;

/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Talleres */
ECHO \common\widgets\spinnerWidget\spinnerWidget::widget();
/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterConvocados */

$this->title = m::t('labels', 'Fill in personal data : {name}', [
    'name' => $model->persona->fullName(),
]);
//$this->params['breadcrumbs'][] = ['label' => substr($model->programa->descripcion,0,10), 'url' => ['/inter/programa/update', 'id' => $model->programa->id]];
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'My panel'), 'url' => [h::user()->resolveUrlAfterLogin()]];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
///$this->params['breadcrumbs'][] = Yii::t('base_labels', 'Update');
?>
<div class="inter-convocados-update">
<h4><i class="fa fa-edit"></i><?= Html::encode($this->title) ?></h4>
   
    <div class="box box-success">
      <div class="box-body">
     <?php 
     //VAR_DUMP($model->firstExpediente());DIE();
     echo $this->render('@frontend/modules/inter/views/convocados/_progress_convocado',['identidad'=>$model->persona->identidad]);?>   
    <?php echo $this->render('_form_expedientes_postulante',['model' => $model]); ?>
    </div>
</div>
</div>