<?php
use common\helpers\ComboHelper;
use frontend\modules\import\ModuleImport as m;
use frontend\modules\bigitems\models\Docbotellas;
use common\widgets\spinnerWidget\spinnerWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\tabs\TabsX;
//use kartik\depdrop\DepDrop;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
/* @var $this yii\web\View */
/* @var $model frontend\modules\import\models\ImportCargamasiva */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="import-cargamasiva-form">
<div class="box box-success">
       <?php
       ECHO spinnerWidget::widget();
       $form = ActiveForm::begin([
           'id'=>'form-cargamasiva',
    'fieldClass'=>'\common\components\MyActiveField'
    ]); ?>
    
  <div class="box-footer">
        <div class="col-md-12">
            <div class="form-group no-margin">
        <?= Html::submitButton('<span class="fa fa-save"></span>    '.m::t('labels', 'Grabar'), ['class' => 'btn btn-success']) ?>
           
            <?php 
               if(!$model->isNewRecord){
                  $url=Url::to(['example-csv','id'=>$model->id]);
                echo Html::a(
                        '<span class="fa fa-download"></span>    '.m::t('labels','Descargar plantilla'),
                        $url,
                        [
                          
                            'class' => 'btn btn-success',
                            
                            ]
                        );  
               }
               
                ?> 
            
            
            </div>
              
            
     </div>
    </div>
    <div class="box-body">
 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> 
      <?= $form->field($model, 'descripcion')->textInput() ?>

 </div>
   

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
  
    
    <?= ComboDep::widget([
               'model'=>$model,
               'controllerName'=>'import/importacion',
               'actionName'=>'escenarios',
               'form'=>$form,
               'data'=> ComboHelper::getCboModels(),
               'campo'=>'modelo',
               'idcombodep'=>'importcargamasiva-escenario',
               'inputOptions'=>[ 'disabled'=>(!$model->isNewRecord)?true:false],
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
                   'source'=>[],
                            ]
               
               
        )  ?>
 </div>  
        
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">   
   <?= $form->field($model, 'escenario')->
            dropDownList(($model->isNewRecord)?[]:[$model->escenario=>$model->escenario],
                    ['prompt'=>'--'.m::t('base.verbs','--Seleccione un valor')."--",
                     'disabled'=>(!$model->isNewRecord)?true:false
                       ]
                    ) ?>
 </div> 
         <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
          <?php /*var_dump($model->hasLoads()) ; die();*/ ?>
          <?= $form->field($model, 'insercion')->checkBox(['disabled'=>($model->hasLoads())?true:false]) ?>

 </div> 
   <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'tienecabecera')->checkBox() ?>

 </div> 
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">  
   <?= $form->field($model, 'lastimport')->textInput(['maxlength' => true,'disabled'=>true]) ?>

 </div>
  
    
   
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">   
   <?= $form->field($model, 'format')->
            dropDownList(['csv'=>'csv'],
                    ['prompt'=>'--'.m::t('base.verbs','Seleccione un valor')."--",
                     'disabled'=>(!$model->isNewRecord)?true:false
                       ]
                    ) ?>
 </div> 
 
    
    
  
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    

    
    <?php ActiveForm::end(); ?>




 <?php  
 if(!$model->isNewRecord){
    //var_dump($this->context);die();
 echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
    'items' => [
        [
            'label' => m::t('base.names','Columnas'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_campos',[ 'form' => $form, 'dataProvider' => $itemsFields]),
//'content' => $this->render('detalle',['form'=>$form,'orden'=>$this->context->countDetail(),'modelDetail'=>$modelDetail]),
            'active' => true,
             'options' => ['id' => 'myveryownID3'],
        ],
        [
            'label' => m::t('base.names','Cargas'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_loads',[  'model' => $model,'form' => $form, 'dataProvider' => $itemsLoads]),
//'content' => $this->render('detalle',['form'=>$form,'orden'=>$this->context->countDetail(),'modelDetail'=>$modelDetail]),
            'active' => false,
             'options' => ['id' => 'myveryownID4'],
        ],
       [
            'label' => m::t('base.names','Errores'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_emptyresult',[ ]),
//'content' => $this->render('detalle',['form'=>$form,'orden'=>$this->context->countDetail(),'modelDetail'=>$modelDetail]),
            'active' => false,
             'options' => ['id' => 'myverop5yowyynID4'],
        ],
    ],
]);  
 }
  
    
    ?> 
</div>
</div>
</div>
    </div>
    
    

    
  