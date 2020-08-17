<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use frontend\modules\inter\helpers\ComboHelper;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Additional questions';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="login-box">
    
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Answer the questions</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form',
            'enableAjaxValidation' => true]); ?>

          
         <?php   
         $questions=$model->modelPostulante->questionsForAutenticate();
           // $labels=array_keys($questions['questions']);
           // print_r($labels);
         //var_dump(array_keys($questions['questions']['pregunta1'])[0]);die();
         ?>
        
        <?= $form
            ->field($model, 'codigo', [])
            //->label(array_keys($questions['questions']['pregunta2'])[0])
            ->textInput(['disabled'=>true]) ?>   
        <?= $form
            ->field($model, 'email', [])
            //->label(array_keys($questions['questions']['pregunta2'])[0])
            ->textInput(['disabled'=>true]) ?>   
        <?= $form
            ->field($model, 'pregunta1', [])
           ->label(array_keys($questions['questions']['pregunta1'])[0])
            ->textInput() ?>

        <?= $form
            ->field($model, 'pregunta2', [])
            ->label(array_keys($questions['questions']['pregunta2'])[0])
            ->textInput() ?>
        
        

        <div class="row">
            
            <!-- /.col -->
            <div class="col-xs-4">
                <?= Html::submitButton('Verify', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>

     
        
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->

