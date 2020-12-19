<?php

use yii\helpers\Html;
use yii\helpers\Json;
use common\helpers\comboHelper;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\grid\GridView;
//use kartik\grid\GridView;
use common\models\masters\Matricula;
use common\models\FormatoDocs;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
 use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;

/* @var $this yii\web\View */
/* @var $model common\models\masters\AsesoresCurso */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
echo \common\widgets\spinnerWidget\spinnerWidget::widget();
$modelAlumno=$model->alumno;
?>
<?php 
$this->title = Yii::t('base_labels', 'Manage files: {name}', [
    'name' => $modelAlumno->fullName(),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'Advisor panel'), 'url' => ['panel-asesor']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = Yii::t('base_labels', 'Update');
?>

<h4><?=$this->title?></h4>
<div class="box box-succes">
<div class="box-body">
<div class="asesores-curso-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-6"> 
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	 <?php //echo $form->field($modelDocente, 'id')->label(\Yii::t('base_labels','Race'))->textInput(['disabled'=>true,'value'=> $modelDocente->carrera->nombre]) ?>	
	 </div> 
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
	 <?= $form->field($modelAlumno, 'id')->label(\Yii::t('base_labels','Full Name'))->textInput(['disabled'=>true,'value'=> $modelAlumno->fullName()]) ?>
	 </div>
	 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	 <?= $form->field($modelAlumno, 'codalu')->label(\Yii::t('base_labels','Code'))->textInput(['disabled'=>true]) ?>	
	 </div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6"> 
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <br>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                 <?php 
                echo Html::img($modelAlumno->image($modelAlumno->codalu),['width'=>180,'height'=>240, 'class'=>"img-thumbnail cuaizquierdo"]);
                    ?>
            </div>
	   
	
	</div>

       
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
	<?php Pjax::begin(['id'=>'mi_grilla']); ?>
    
            
        
            
    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query'=> \frontend\modules\repositorio\models\RepositorioAsesoresCursoDocs::find()->
                andWhere([
                    'asesores_curso_id'=>$model->id,
                    //'publico'=>'1'
                    ]),
                        ]),
            'summary'=>'',
            'columns' => [                 
                      'documento.desdocu',
                 [
                'class' => 'yii\grid\ActionColumn',
                //'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
            'template' => '{attach}',
               'buttons'=>[ 
                      'attach' => function($url, $model) { 
                        if(!$model->hasAttachments()){
                           $url=Url::toRoute(['/finder/selectimage',
                             'isImage'=>false,
                             'idModal'=>'imagemodal',
                             'idGrilla'=>'mi_grilla',
                             'modelid'=>$model->id,
                             'extension'=> Json::encode(['pdf']),
                             'nombreclase'=> str_replace('\\','_',get_class($model))]);
                        $options = [
                            'title' => Yii::t('base_labels', 'Upload File'),
                            //'aria-label' => Yii::t('rbac-admin', 'Activate'),
                            //'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                            'data-method' => 'get',
                            //'data-pjax' => '0',
                                    ];
                                return Html::button('<span class="glyphicon glyphicon-paperclip"></span>', ['href' => $url, 'class' => 'botonAbre btn btn-success']);
                        
                        }else{
                            //$url=$model->urlFirstFile;
                       return Html::a('<span class="glyphicon glyphicon-save"></span>',$model->urlFirstFile,['data-pjax'=>'0','class' => 'btn btn-warning']);
                        
                        }
                        //return Html::a('<span class="btn btn-success glyphicon glyphicon-pencil"></span>', Url::toRoute(['view-profile','iduser'=>$model->id]), []/*$options*/);
                        
                                 },    
                         ]
                ],  
                
                            ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
        
        
     
</div>
   


    <?php ActiveForm::end(); ?>


</div>
</div>  
</div>
 

