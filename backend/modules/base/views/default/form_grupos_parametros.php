<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\selectwidget\selectWidget;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use common\helpers\ComboHelper;
use common\helpers\h;
use backend\modules\base\Module AS m;
 use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Alumnos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alumnos-form">
    <br>
    <?php $form = ActiveForm::begin([
       //'enableAjaxValidation'=>true,
    //'fieldClass'=>'\common\components\MyActiveField'
    ]); ?>
      <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                
        <?= Html::submitButton(m::t('verbs', 'Save'), ['class' => 'btn btn-success']) ?>
          

            </div>
        </div>
    </div>
      <div class="box-body">
        <?php //print_r($model->attributes);var_dump($model->facultad); die(); ?>


   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">  
   <?php 
   /* echo selectWidget::widget([
           // 'id'=>'mipapa',
            'model'=>$model,
            'form'=>$form,
            'campo'=>'codcar',
             'addCampos'=>[2],
            //'foreignskeys'=>[1,2,3],
        ]); */ ?>
       <?php if(!$model->isNewRecord) { ?>
        <?= $form->field($model->carrera,'descar')->textInput(['disabled'=>true,'maxlength' => true]) ?>
       <?php } ?>
       
    </div>
          
          
       
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                   <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                        <?= $form->field($model, 'ap')->textInput(['disabled'=>true,'maxlength' => true]) ?>

                  </div>

                     <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                       <?= $form->field($model, 'am')->textInput(['disabled'=>true,'maxlength' => true]) ?>

                     </div>
                                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                           <?= $form->field($model, 'nombres')->textInput(['disabled'=>true,'maxlength' => true]) ?>

                              </div>
                            
              </div>
               <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <img src="<?=$model->getUrlImage()?>" class="img-thumbnail">
                  
              </div>
          </div>       
          
          
          
          
          
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                           <?php  //h::settings()->invalidateCache();  ?>
                       <?= $form->field($model, 'fecna')->widget(DatePicker::class, [
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
          
          
          
          
          
 
          
            
  
          
          
  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'codalu')->textInput(['disabled'=>true,'maxlength' => true]) ?>

 </div>
          
          
          
          
          
          
          
          
  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'dni')->textInput(['maxlength' => true]) ?>

 </div>
   <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
     <?= $form->field($model, 'correo')->textInput(['maxlength' => true]) ?>

 </div>
          
  <div class="col-lg-3 col-md-12 col-sm-6 col-xs-12">
     <?= $form->field($model, 'domicilio')->textInput(['maxlength' => true]) ?>

 </div>

   
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
    <?= ComboDep::widget([
               'model'=>$model,               
               'form'=>$form,
               'data'=> ComboHelper::getCboDepartamentos(),
               'campo'=>'codep',
               'idcombodep'=>'alumnos-codprov',
               /* 'source'=>[ //fuente de donde se sacarn lso datos 
                    /*Si quiere colocar los datos directamente 
                     * para llenar el combo aqui , hagalo coloque la matriz de los datos
                     * aqui:  'id1'=>'valor1', 
                     *        'id2'=>'valor2,
                     *         'id3'=>'valor3,
                     *        ...
                     * En otro caso 
                     * de la BD mediante un modelo  
                     */
                        /*Docbotellas::className()=>[ //NOmbre del modelo fuente de datos
                                        'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'descripcion',//columna a mostrar 
                                        'campofiltro'=>'codenvio'/* //cpolumna 
                                         * columna que sirve como criterio para filtrar los datos 
                                         * si no quiere filtrar nada colocwue : false | '' | null
                                         *
                        
                         ]*/
                   'source'=>[\common\models\masters\Ubigeos::className()=>
                                [
                                  'campoclave'=>'codprov' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'provincia',//columna a mostrar 
                                        'campofiltro'=>'coddepa'  
                                ]
                                ],
                            ]
               
               
        )  ?>
 </div>       
          
          
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
    <?= ComboDep::widget([
               'model'=>$model,               
               'form'=>$form,
               'data'=> ($model->isNewRecord)?[]:ComboHelper::getCboProvincias($model->codep),
               'campo'=>'codprov',
               'idcombodep'=>'alumnos-codist',
               /* 'source'=>[ //fuente de donde se sacarn lso datos 
                    /*Si quiere colocar los datos directamente 
                     * para llenar el combo aqui , hagalo coloque la matriz de los datos
                     * aqui:  'id1'=>'valor1', 
                     *        'id2'=>'valor2,
                     *         'id3'=>'valor3,
                     *        ...
                     * En otro caso 
                     * de la BD mediante un modelo  
                     */
                        /*Docbotellas::className()=>[ //NOmbre del modelo fuente de datos
                                        'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'descripcion',//columna a mostrar 
                                        'campofiltro'=>'codenvio'/* //cpolumna 
                                         * columna que sirve como criterio para filtrar los datos 
                                         * si no quiere filtrar nada colocwue : false | '' | null
                                         *
                        
                         ]*/
                   'source'=>[\common\models\masters\Ubigeos::className()=>
                                [
                                  'campoclave'=>'coddist' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'distrito',//columna a mostrar 
                                        'campofiltro'=>'codprov'  
                                ]
                                ],
                            ]
               
               
        )  ?>
 </div> 
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">    
 <?= $form->field($model, 'codist')->
            dropDownList(($model->isNewRecord)?[]:ComboHelper::getCboDistritos($model->codprov),
                  ['prompt'=>'--'.m::t('verbs','Choose a value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
 </div>        
          
          
          
          
  
  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">    
 <?= $form->field($model, 'sexo')->
            dropDownList(ComboHelper::getCboSex(),
                  ['prompt'=>'--'.m::t('verbs','Choose a value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
 </div>  
  <div class="col-lg-3 col-md-12 col-sm-6 col-xs-12">
     <?= $form->field($model, 'celulares')->textInput(['maxlength' => true]) ?>

 </div>         
     <div class="col-lg-3 col-md-12 col-sm-6 col-xs-12">
     <?= $form->field($model, 'fijos')->textInput(['maxlength' => true]) ?>

 </div> 
    <?php ActiveForm::end(); ?>

</div>
    </div>


