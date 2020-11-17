<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="site-reset-password">
    
   
<div class="login-box">
    
       <div class="login-box-body">
    <p><?php echo yii::t('base_labels','Please choose your new password:'); ?></p>

    <div class="row">
        
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton(yii::t('base_verbs','Save'), ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
       </div>     
    </div>
</div></div>
