<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;
use common\helpers\h;

/* @var $this yii\web\View */
/* @var $model frontend\modules\encuesta\models\EncuestaOpcionesPregunta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="encuesta-opciones-pregunta-form">

    <?php $form = ActiveForm::begin(); ?>
    <p class="form-group text-center ">     
    <h4 class="text-primary text-center" style="text-transform:uppercase;"><?=$titulo_encuesta?></h4>        
    </p>
    <div class="text-center">
    Cuenta con preguntas tipo multiples, selecciona las opciones de las preguntas multiples.
    </div> 
    <hr style="border-top: 1px solid #EAEAEA;">  
    <div style="padding-left: 10%;padding-right: 10%">
    
    <?php
     
    foreach ($model_preguntas as $index => $pregunta) {
        # code...
    ?>
    
        <!-- MULTIPLE INPUT -->
            
            <?php 
            
            if( h::getTipoPreguntaEncuesta($pregunta->id_tipo_pregunta) == 'MULTIPLE'){
            ?>
                <?php
                echo '<strong class="d-inline">PREGUNTA '.($index+1).': </strong><strong class="d-inline text-success text-center">'.$pregunta->pregunta.'</strong>'
                ?>                                
                <?= $form->field($model, 'array'.($index+1))->widget(MultipleInput::className(), [
                    'min' => 1,
                    'max' => 20,
                    'columns' => [
                        [
                            'name'  => 'valor',
                            'title' => 'Opciones De Pregunta '.($index+1),
                            'options'=>[
                                'placeholder' => 'Ingrese Opción'
                            ]
                            
                        ],
                        [
                            'name'  => 'descripcion',
                            'title' => 'Descripción De Pregunta '.($index+1),
                            'options'=>[
                                'placeholder' => 'Descripción De Opción'
                            ]
                        ],
                        
                    ]

                    ])->label(false);
                       
                ?>                
                <hr style="border-top: 1px solid #EAEAEA;">
            <?php
            
            }
            ?>

            <!-- <?php 
            if(h::getTipoPreguntaEncuesta($pregunta->id_tipo_pregunta) == 'LIBRE' ){
            ?>
            
            
            <?php 
                echo '<strong class="d-inline">PREGUNTA '.($index+1).':</strong><p class="d-inline text-primary ">'.$pregunta->pregunta.'</p>'
            ?>
                      
            <p class=" text-danger "> PREGUNTA LIBRE</p>
            <hr>
            <?php
            
            }
            ?> -->
        
        <!-- FIN DEL MULTIPLE INPUT -->

    <?php    
    }
    ?>
    

    

    

    <div class="form-group text-center">
        <?= Html::submitButton(Yii::t('app', 'Siguiente'), ['class' => 'btn btn-primary']) ?>
        
    </div>
    </div>
    <?php 
    
    ActiveForm::end(); ?>

</div>
