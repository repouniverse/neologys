<?php
use kartik\detail\DetailView;
use yii\helpers\Html;
//use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Trabajadores */

$this->title = yii::t('base.verbs','View {name}',['name'=>$model->nombrecompleto]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.labels', 'Persons'), 'url' => ['index-persona']];
$this->params['breadcrumbs'][] = $model->id;
\yii\web\YiiAsset::register($this);
?>
<h4> </h4>
<div class="trabajadores-view">

 
<div class="box box-success">
    <div class="box-body">
    <p>
        <?= Html::a(Yii::t('base.verbs', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
    </p>

    <?php 
echo DetailView::widget([
    'formOptions' => [
        'id' => 'trabajadores-form',
    'enableAjaxValidation' => true,
    'fieldClass' => 'common\components\MyActiveField',
    ] ,// your action to delete
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=>yii::t('base.names','Person' ).'  '. $model->codigoper,
        'type'=>DetailView::TYPE_WARNING,
    ],
    'attributes'=>[
        [
        'group'=>true,
        'label'=>yii::t('base.labels','Personal information'),
        //'rowOptions'=>['class'=>'alert alert-danger'],
        'groupOptions'=>['class'=>'alert alert-warning']
          ],
        //'codigoper',
        'nombres',        
        'ap',
            'am',
            //'nombres',
            'numerodoc',
            //'ppt',
            //'pasaporte',
        
         [
        'group'=>true,
         'label'=>yii::t('base.labels','Work data'),
        //'rowOptions'=>['class'=>'alert alert-danger'],
        'groupOptions'=>['class'=>'alert alert-warning']
        //'groupOptions'=>['class'=>'text-center']
          ],
           // 'codpuesto',
            ['attribute'=>'cumple', 'type'=>DetailView::INPUT_DATE],
            ['attribute'=>'fecingreso', 'type'=>DetailView::INPUT_DATE],
            'domicilio',
            'telfijo',
            'telmoviles',
            'referencia',
    ]
]);
  ?>  
    
</div>
</div>
</div>
