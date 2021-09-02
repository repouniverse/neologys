<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

if(Yii::$app->geoip->ip()->isoCode=='PE'){
  yii::$app->language='es_PE';
}else{
   yii::$app->language='en_US'; 
}
  //echo $model::className();
$this->title = yii::t('base_labels','Request password reset');
$this->params['breadcrumbs'][] = $this->title;

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

?>


<div class="site-request-password-reset">
    <div class="login-box">
        <div class="login-box-body">
            <p>
                <?php echo yii::t('base_labels', 'Please fill out your email. <b>If you have a institutional account, yo should use it.</b> A link to reset password will be sent there.'); ?>
            </p>

            <?php $form = ActiveForm::begin(['id' => 'resend-verification-email-form']); ?>

            <?= $form
                ->field($model, 'email', $fieldOptions1)
                ->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

            <div class="row">
                <div class="col-xs-4">
                    <?= Html::submitButton(yii::t('base_verbs', 'Send'), ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            <hr>
            <p>
                En caso tengas algún inconveniente con el acceso luego de estos pasos, puedes realizar una solicitud en el siguiente enlace.
            </p>
            <p>
                <a href="https://fcctp.usmp.edu.pe/mi-tramite/solicitud-acceso" target="_blank" class="btn btn-danger">Ingresar solicitud</a>
            </p>
        </div>
    </div>
</div>