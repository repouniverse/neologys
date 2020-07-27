<?php
use kartik\detail\DetailView;
use yii\helpers\Html;
//use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Trabajadores */

$this->title = yii::t('base.actions','Visualizar {name}',['name'=>$model->nombrecompleto]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.actions', 'Trabajadores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
\yii\web\YiiAsset::register($this);
?>
<h4> </h4>
<div class="trabajadores-view">

 
<div class="box box-success">
    <div class="box-body">
    <p>
        <?= Html::a(Yii::t('base.verbs', 'Editar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('base.verbs', 'Eliminar'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('control.errors', '¿Desea eliminar este registro?'),
                'method' => 'post',
            ],
        ]) ?>
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
        'heading'=>yii::t('base.names','Trabajador' ).'  '. $model->codigotra,
        'type'=>DetailView::TYPE_WARNING,
    ],
    'attributes'=>[
        [
        'group'=>true,
        'label'=>yii::t('base.forms','Información Personal'),
        //'rowOptions'=>['class'=>'alert alert-danger'],
        'groupOptions'=>['class'=>'alert alert-warning']
          ],
        //'codigotra',
        'nombres',        
        'ap',
            'am',
            'nombres',
            'dni',
            'ppt',
            'pasaporte',
        
         [
        'group'=>true,
         'label'=>yii::t('base.forms','Información Laboral'),
        //'rowOptions'=>['class'=>'alert alert-danger'],
        'groupOptions'=>['class'=>'alert alert-warning']
        //'groupOptions'=>['class'=>'text-center']
          ],
            'codpuesto',
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
