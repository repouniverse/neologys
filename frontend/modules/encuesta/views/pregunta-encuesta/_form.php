<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper as combo;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $model frontend\modules\encuesta\models\EncuestaPreguntaEncuesta */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="encuesta-pregunta-encuesta-form">
    <?php $form = ActiveForm::begin(); ?>
    
    <p class="form-group text-center ">     
    <h4 class="text-primary text-center " style="text-transform:uppercase;"><?=$titulo_encuesta?></h4>        
    </p>
    <div class="text-center text-warning">
    Cuenta con <?=$numero_preguntas?> preguntas seleccione el tipo de pregunta y escriba la pregunta.
    </div>
    <hr style="border-top: 1px solid #EAEAEA;">    
    <div style="padding-left: 10%;padding-right: 10%">    
         <?php
          for($i = 0; $i < $numero_preguntas; $i++){
        ?>
            <div class="box-body">
                
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <?php echo $form->field($model, 'array_id_tipo_pregunta['.$i.']')->dropDownList(                                      
                    combo::getCboTipoPregunta($id_tipo_encuesta),
                    [
                        'prompt' => '-- ' . yii::t('base_verbs', 'Choose a question type').' '.($i+1) . " --",
                        'id' => "tipo_pregunta".$i,
                        
                    ]

                ) ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <?php echo $form->field($model, 'array_pregunta['.$i.']')->textInput(['maxlength' => true,'placeholder' =>'Ingrese su pregunta'.' '.($i+1)  ,'id' => "pregunta".$i, ]) ?>
                </div>
        
            </div>
            <hr style="border-top: 1px solid #EAEAEA;">
        <?php
        }
        ?>  
    
    
            

    <div class="form-group text-center " >
        <?= Html::submitButton(Yii::t('base_verbs', 'Siguiente'), ['class' => 'btn btn-primary']) ?>
    </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>

<?php
/* AGREGANDO JQUERY */
$script = <<< JS
    //todo codigo Jquery o javascript stuffer
   $(document).ready(function() {
    $('#encuestas').change(function() {
        
    })
   })  
    
JS;
$this->registerJs($script);

  
?>