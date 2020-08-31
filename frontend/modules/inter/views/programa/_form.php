<?php
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use common\models\masters\Departamentos;
use common\helpers\h;
use yii\helpers\Html;

use yii\widgets\ActiveForm;
use frontend\modules\inter\Module as m;
use common\helpers\ComboHelper;
use common\widgets\selectwidget\selectWidget;
 use kartik\date\DatePicker;
 
 use yii\helpers\Url;


 USE yii\widgets\Pjax;
 use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterPrograma */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inter-programa-form">
    <br>
    <?php $form = ActiveForm::begin([
    'fieldClass'=>'\common\components\MyActiveField'
    ]); ?>
      <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                
        <?= Html::submitButton('<span class="fa fa-save"></span>   '.m::t('verbs', 'Save'), ['class' => 'btn btn-success']) ?>
        <?php  $url=Url::to(['/inter/convocados/index','id'=>$model->id]);  ?>
         <?= Html::a('<span class="btn btn-danger btn-sm" ><span class="fa fa-users"></span>  '.m::t('labels','Convened').'</span></span>', $url); ?>  

            </div>
        </div>
    </div>
      <div class="box-body">
    

      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
          
    <?= ComboDep::widget([
               'model'=>$model,               
               'form'=>$form,
               'data'=> ComboHelper::getCboUniversidades(),
               'campo'=>'universidad_id',
               'idcombodep'=>'interprograma-facultad_id',               
                   'source'=>[\common\models\masters\Facultades::className()=>
                                [
                                         'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'desfac',//columna a mostrar 
                                        'campofiltro'=>'universidad_id'  
                                ]
                                ],
                            ]
               
               
        )  ?>
 </div>       
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
      <?= ComboDep::widget([
               'model'=>$model,               
               'form'=>$form,
               'data'=> ($model->isNewRecord)?[]:ComboHelper::getCboFacultades($model->universidad_id),
               'campo'=>'facultad_id',
               'idcombodep'=>'interprograma-depa_id',
               
                   'source'=>[\common\models\masters\Departamentos::className()=>
                                [
                                  'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'nombredepa',//columna a mostrar 
                                        'campofiltro'=>'facultad_id'  
                                ]
                                ],
                            ]
               
               
        )  ?>

 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">    
 <?= $form->field($model, 'depa_id')->
            dropDownList(($model->isNewRecord)?[]:ComboHelper::getCboDepartamentosFacu($model->facultad_id),
                  ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
 </div>    
          
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'codperiodo')->
            dropDownList(ComboHelper::getCboPeriodos(),
                  ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
 </div>
          
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
     <?php 
  // $necesi=new Parametros;
    echo selectWidget::widget([
           // 'id'=>'mipapa',
            'model'=>$model,
            'form'=>$form,
            'campo'=>'codigoper',
         'ordenCampo'=>5,
         'addCampos'=>[6,7],
        ]);  ?>

 </div>         
  
  
  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?php  //h::settings()->invalidateCache();  ?>
                       <?= $form->field($model, 'fopen')->widget(DatePicker::class, [
                             'language' => h::app()->language,
                           // 'readonly'=>true,
                          // 'inline'=>true,
                           'pluginOptions'=>[
                                     'format' => h::gsetting('timeUser', 'date')  , 
                                  'changeMonth'=>true,
                                  'changeYear'=>true,
                                 'yearRange'=>"-99:+0",
                               ],
                           
                            //'dateFormat' => h::getFormatShowDate(),
                            'options'=>['class'=>'form-control']
                            ]) ?>
</div>
  <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

 </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <?= $form->field($model, 'detalles')->textarea(['rows' => 6]) ?>

 </div>
     
    <?php ActiveForm::end(); ?>

</div>
    </div>
