<?php
use kartik\tabs\TabsX;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model common\models\masters\Clipro */
use yii\widgets\ActiveForm 
?>

<div class="siteee-login">
    <h6><?= Html::encode($this->title) ?></h6>

    
<div class="box box-success">
<?php

   $form = ActiveForm::begin(['enableAjaxValidation'=>true,   'id' => 'profile-form','options' => ['enctype' => 'multipart/form-data']]);
echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
    'items' => [
        [
            'label' => yii::t('base_labels','Perfil'),
            'content' => $this->render('profileother',['form'=>$form,'model'=>$model,'profile'=>$profile]),
            'active' => true,
             'options' => ['id' => 'myveryryyownID2'],
        ],
        [
            'label' => yii::t('base_labels','Universities'),
         'content' => $this->render('_tab_facu',['form'=>$form,/*'userfacultades'=>$userfacultades*/]),
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
    </div>
</div>
