<?php
use frontend\modules\inter\Module as m;
use yii\helpers\Html;



/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Talleres */
ECHO \common\widgets\spinnerWidget\spinnerWidget::widget();
/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterExpedientes */

$this->title = m::t('labels', 'Update Inter Files: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Inter Files'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = m::t('verbs', 'Update');
?>

<h4><i class="fa fa-edit"></i><?= Html::encode($this->title) ?></h4>
   
    <div class="box box-success">
    <div class="box-body">
      <?php echo $this->render('/expedientes/planes/etapa_'.$model->orden, [
            'persona' => $persona,
            'model' => $model,
            'identidad'=>$identidad,
            'convocado'=>$convocado
        ]);    ?>
        
    </div>
   </div>