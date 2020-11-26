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
    'options' => ['class' => 'input is-medium input-login is-size-6'],
   // 'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'input is-medium input-login is-size-6'],
    //'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>


        
        <?php //echo Yii::$app->geoip->ip()->isoCode; */  ?> 
    
    <!-- /.login-logo -->
  <div class="hero is-fullheight bg-login">
        <div class="hero-body">
          <div class="container has-text-centered">
            <div class="column is-offset-1 is-4-widescreen is-5-desktop  is-6-tablet is-offset-0-mobile is-12-mobile">
                <div class="box py-6 px-6">
                    <div class="logo pb-4 pt-2">
                        <?=Html::img('@web/img/logo-usmp.svg',['width'=>"70%"])?>
                      
                    </div>  
       
        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>
        <div class="field">
          <div class="control">
        <?= $form
            ->field($model, 'username', [])
            ->label(false)
            ->textInput(['class'=>'input is-medium input-login is-size-6','placeholder' => $model->getAttributeLabel('username')]) ?>
         <p class="help-block help-block-error"></p>
          </div>
         </div>
        <div class="field">
          <div class="control">
        <?= $form
            ->field($model, 'password', [])
            ->label(false)
            ->passwordInput(['class'=>'input is-medium input-login is-size-6','placeholder' => $model->getAttributeLabel('password')]) ?>
          <p class="help-block help-block-error"></p>
          </div>
         </div>
        <div class="botones">
           
            
                <?= Html::submitButton(yii::t('base_labels','Sign in'), ['class' => 'button is-block is-fullwidth is-normal btn-ingresa is-uppercase', 'name' => 'login-button']) ?>
           
            <hr class="m-3">
                <?= Html::a(yii::t('base_labels','I forgot my password'),Url::to(['request-password-reset']) ,['class' => 'button is-block is-fullwidth is-normal btn-recupera is-uppercase']) ?>
            
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>

       
        <?php //echo Html::a(yii::t('base_labels','Register'),Url::to(['/inter/default/base-auth']))?>
         <div class="logo p-5 pt-6 is-hidden-mobile"></div>
                </div>
            </div>
          </div>
        </div>
      </div>

    
        
    
    <!-- /.login-box-body -->

