<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

?>
<div class="site-request-password-reset">
   
<div class="login-box">
    
       <div class="login-box-body">
        <p class="login-box-msg">Please fill out your email. A link to reset password will be sent there.</p>

        
         <?php $form = ActiveForm::begin(['id' => 'resend-verification-email-form']); ?>

           
        
        <?= $form
            ->field($model, 'email', $fieldOptions1)
             ->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

       
        <div class="row">
           
            <div class="col-xs-4">
                <?= Html::submitButton('Send', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>

    
   
       
   
</div>
</div></div>