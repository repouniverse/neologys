<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use frontend\modules\inter\helpers\ComboHelper;
use frontend\modules\inter\Module as m;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];
?>

<div class="login-box">
    <div class="login-logo">
        <?=Html::img('@web/img/logo_usmp.png',['width'=>280,'height'=>100])?>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Enter your code an email to validate</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form',
            'enableAjaxValidation' => true]); ?>

          
 <?= $form->field($model, 'modo_id')->
            dropDownList(ComboHelper::getCboModos(),
                  ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
 
        
        
        
        <?= $form
            ->field($model, 'codigo', $fieldOptions1)
           // ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('codigo')]) ?>

        <?= $form
            ->field($model, 'email', $fieldOptions2)
            //->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

        <div class="row">
            
            <!-- /.col -->
            <div class="col-xs-4">
                <?= Html::submitButton(m::t('verbs','Verify'), ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>

     
        
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->

