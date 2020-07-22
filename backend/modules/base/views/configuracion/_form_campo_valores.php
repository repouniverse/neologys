<?php
use common\helpers\h;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use backend\modules\base\Module as m;
/* @var $this yii\web\View */
/* @var $model common\models\masters\Combovalores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="combovalores-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
        <?= Html::submitButton('<span class="fa fa-save"></span>    '.m::t('verbs', 'Save'), ['class' => 'btn btn-success']) ?>
         <?=($model->isNewRecord)?'':common\widgets\auditwidget\auditWidget::widget(['model'=>$model])?>
        </div>
    </div>
    
     <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
      
          <?= ComboDep::widget([
               'model'=>$model,               
               'form'=>$form,
               'data'=> ComboHelper::getCboModels(),
               'campo'=>'nombreModelo',
               'idcombodep'=>'modelcombo-nombrecampo',
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
                   'source'=>['\common\helpers\ComboHelper'=>
                                [
                                  //'campoclave'=>'codprov' , //columna clave del modelo ; se almacena en el value del option del select 
                                        //'camporef'=>'provincia',//columna a mostrar 
                                        'campofiltro'=>'getCboCamposFromTable'  
                                ]
                                ],
                            ]
               
               
        )  ?>
         
         
    
    </div>
    
    
    
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
       <?= $form->field($model, 'nombreCampo')->
            dropDownList(($model->isNewRecord)?[]:ComboHelper::getCboCamposFromTable($model->nombreModelo),
                    ['prompt'=>'--'.m::t('verbs','Choose a value')."--",
                    // 'class'=>'probandoSelect2',
                        ]
                    ) ?>
    
       
    </div>
    
   

    <?php ActiveForm::end(); ?>

</div>
