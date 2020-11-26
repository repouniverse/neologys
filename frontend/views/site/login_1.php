<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
if(Yii::$app->geoip->ip()->isoCode=='PE'){
  yii::$app->language='es_PE';
}ELSE{
   yii::$app->language='en_US'; 
}
 // echo $model::className();
    
$this->title = yii::t('base_labels','Sign In');

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="login-box">
        
        <?php echo Yii::$app->geoip->ip()->isoCode;   ?> 
    <div class="login-logo">
        
        <?=Html::img('@web/img/logo_usmp.png',['width'=>280,'height'=>100])?>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"><?php echo yii::t('base_labels','Sign in to start your session')?></p>
        
        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="row">
           
            <div class="col-xs-12">
                <?= Html::submitButton(yii::t('base_labels','Sign in'), ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>

       <?=Html::a(yii::t('base_labels','I forgot my password'),Url::to(['request-password-reset']))?>
        <br>
        <?php //echo Html::a(yii::t('base_labels','Register'),Url::to(['/inter/default/base-auth']))?>
         
    
        
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
