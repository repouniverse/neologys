<?php
use kartik\tabs\TabsX;
use common\helpers\h;
use yii\helpers\Html;
use yii\helpers\Url;
   use common\widgets\buttonajaxwidget\buttonAjaxWidget;
/* @var $this yii\web\View */
/* @var $model common\models\masters\Clipro */
use yii\widgets\ActiveForm 
?>
<?php
$username=$profile->user->username;
   $this->title = yii::t('base_labels', 'Update Profile: {name}', ['name' => $username,]);
    $this->params['breadcrumbs'][] = ['label' => yii::t('base_labels', 'Users'), 'url' => ['view-users']];
    $this->params['breadcrumbs'][] = ['label' => yii::t('base_labels', 'My Profile'), 'url' => ['profile']];
    //$this->params['breadcrumbs'][] = m::t('verbs', 'Update');
?>

<div class="siteee-login">
    <h4><?= Html::encode($this->title) ?></h4>

    
<div class="box box-success">
<?php
echo \common\widgets\spinnerWidget\spinnerWidget::widget();
?>
<?php

   $form = ActiveForm::begin(['enableAjaxValidation'=>true, 
       'id' => 'profile-form','options' => ['enctype' => 'multipart/form-data']]);?>
 <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                
        <?= Html::submitButton('<span class="fa fa-save"></span>   '.yii::t('base_verbs', 'Save'), ['class' => 'btn btn-success']) ?>
       <?php
          //$url= Url::to(['unique-university','id'=>$profile->id,'gridName'=>'check-multiple','idModal'=>'buscarvalor']);
            echo  Html::button(h::awe('toggle-on').h::space(10).yii::t('base_verbs','Switch Multiple'), ['href' => '#', 'title' => yii::t('base_labels','Switch Multiple'),'id'=>'btn-expe', 'class' => 'btn-danger']); 
           ?> 
                
                
            </div>
        </div>
    </div>
<?php 
echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
    'items' => [
        [
            'label' => yii::t('base_labels','Profile'),
            'content' => $this->render('profileother',['form'=>$form,'model'=>$model,'profile'=>$profile]),
            'active' => true,
             'options' => ['id' => 'myveryryyownID2'],
        ],
        [
            'label' => yii::t('base_labels','Universities'),
         'content' => $this->render('_tab_facu',['form'=>$form,'useruniversidades'=>$useruniversidades,'model'=>$model]),
            'headerOptions' => ['style'=>'font-weight:bold'],
            'options' => ['id' => 'myveryownID1'],
            'active' => false
        ],
        /*[
            'label' => yii::t('sta.labels','Audit'),
            'content' => $this->render('_tab_log',[]),
            'headerOptions' => ['style'=>'font-weight:bold'],
            'options' => ['id' => 'myveryownID2'],
            'active' => false
        ],*/
        
    ],
]);    
    
    ?>
 <?php ActiveForm::end(); ?>
    
    <?php echo buttonAjaxWidget::widget(
       [  
            'id'=>'btn-expe',
            'idGrilla'=>'check-multiple',
            'ruta'=>Url::to(['unique-university','id'=>$profile->id]),          
           //'posicion'=> \yii\web\View::POS_END           
        ]
       
   );   ?>   
    </div>
</div>
