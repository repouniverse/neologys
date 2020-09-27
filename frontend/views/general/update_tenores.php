<?php

use yii\helpers\Html;
use kartik\tabs\TabsX;


/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Talleres */
ECHO \common\widgets\spinnerWidget\spinnerWidget::widget();
/* @var $this yii\web\View */
/* @var $model common\models\masters\Tenores */

$this->title = Yii::t('base_labels', 'Update Text: {name}', [
    'name' => $model->documento->desdocu,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'Texts'), 'url' => ['index-tenores']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view-tenor', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('base_labels', 'Update');
?>

<h4><i class="fa fa-edit"></i><?= Html::encode($this->title) ?></h4>
   
    <div class="box box-success">
    
    <?php echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
     'bordered'=>true,
    'align' => TabsX::ALIGN_LEFT,
      'encodeLabels'=>false,
    'items' => [
        [
          'label'=>'<i class="fa fa-home"></i> '.yii::t('sta.labels','Principal'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_form_tenores',['model' => $model]),
            'active' => true,
             'options' => ['id' => 'myveryownID3'],
        ],
        [
          'label'=>'<i class="fa fa-users"></i> '.yii::t('sta.labels','Tutores'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_segunda',[ 'model' => $model]),
            'active' => false,
             'options' => ['id' => 'myveryownID4'],
        ],
       
        
       
    ],
]);  


