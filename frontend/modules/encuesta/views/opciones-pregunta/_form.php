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
    <div style="padding: 80px;">
    
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
                    'max' => 5,
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
    

    

    

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        
    </div>
    </div>
    <?php 
    
    ActiveForm::end(); ?>

</div>
