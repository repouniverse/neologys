<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */
use mdm\admin\components\UserStatus;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = yii::t('base.verbs','Registrar');
$this->params['breadcrumbs'][] = $this->title;
?>

    <br>
    
        <div class="box box-body"> 
<div class="site-signup">
    <h3><?= Html::encode($this->title) ?></h3>

    <p><?=yii::t('base_verbs','Por favor llene los siguientes campos para Registrar :')?></p>

  
       <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
      
                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label(yii::t('base.names','Nombre de Usuario')) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
              
     <?= $form->field($model, 'status')->
            dropDownList([UserStatus::ACTIVE=>yii::t('base_names','Activo'),UserStatus::INACTIVE=>yii::t('base.names','No activo')] ,
                    ['prompt'=>'--'.yii::t('base_verbs','--Seleccione un valor')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
            

                 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                 <?= Html::submitButton(Yii::t('base_verbs', 'Registrar'), ['id' => 'next-button','class' => 'btn btn-success']) ?>
                                
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
    
       
    

