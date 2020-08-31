<?php
use kartik\detail\DetailView;
use yii\helpers\Html;
use frontend\modules\maestros\MaestrosModule as m;
//use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Trabajadores */

$this->title = m::t('verbs','View {name}',['name'=>$model->fullName(true)]);
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Persons'), 'url' => ['index-trabajadores']];
$this->params['breadcrumbs'][] = $model->id;
\yii\web\YiiAsset::register($this);
?>
<h4><?= $this->title ?></h4>
<div class="trabajadores-view">

 
<div class="box box-success">
    <div class="box-body">
    <p>
        <?= Html::a(m::t('verbs', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
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
        'heading'=>m::t('labels','Worker' ).'  '. $model->codtra,
        'type'=>DetailView::TYPE_WARNING,
    ],
    'attributes'=>[
        [
        'group'=>true,
        'label'=>m::t('labels','Personal information'),
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
         'label'=>m::t('base.labels','Work data'),
        //'rowOptions'=>['class'=>'alert alert-danger'],
        'groupOptions'=>['class'=>'alert alert-warning']
        //'groupOptions'=>['class'=>'text-center']
          ],
           // 'codpuesto',
            
    ]
]);
  ?>  
    
</div>
</div>
</div>
