
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
 use kartik\tabs\TabsX;
use yii\helpers\Html;
use common\helpers\h;
use yii\bootstrap\ActiveForm;

$this->title = '   '.yii::t('base_labels','User Data');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h4><span class="fa fa-user"></span><?= Html::encode($this->title) ?></h4>
 <div class="box box-success">
    

 
        
             
            
            
              <?php  
              $form = ActiveForm::begin(['id' => 'profile-form','options' => ['enctype' => 'multipart/form-data']]); ?>
                  
     <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                
        <?= Html::submitButton(Yii::t('base_verbs', 'Save'), ['class' => 'btn btn-success']) ?>
            

            </div>
        </div>
    </div>
      <div class="box-body">
     
     
               <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= \common\widgets\imagewidget\ImageWidget::widget(['name'=>'imagenrep','model'=>$model]); ?>
   </div>
    
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <?= Html::label(yii::t('base_names','User'),'45545ret',['class' => 'control-label']) ?>
                <?=  Html::input('text', 'username', h::userName(),['disabled'=>'disabled','class' => 'form-control']) ?>
             </diV>
            
             <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <?= Html::label(yii::t('base_names','Last Access'),'fd5656',['class' => 'control-label']) ?>
                <?=  Html::input('text', 'username', h::user()->lastLoginForHumans(),['disabled'=>'disabled','class' => 'form-control']) ?>
             </diV>
            
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <?= Html::label(yii::t('base_names','Created'),'fdtt5656',['class' => 'control-label']) ?>
                <?=  Html::input('text', 'username', h::user()->getSince(),['disabled'=>'disabled','class' => 'form-control']) ?>
             </diV>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <?=$form->field($identidad,'email')->textInput() ?>
             </diV>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= Html::checkbox('agreeff',h::user()->isActive(), [ 'disabled'=>'disabled', 'label' =>yii::t('base_verbs','Enabled')]) ?>
             </diV>
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                 <?=$form->field($model,'recexternos')->checkBox() ?>
             </diV>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= $form->field($model, 'names')->textInput(['autofocus' => true]) ?>
                    </diV>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= $form->field($model, 'duration')->textInput(['autofocus' => true]) ?>
                    </diV>
            
             <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?= $form->field($model, 'durationabsolute')->textInput(['autofocus' => true]) ?>
                    </diV>
       
                
            
               
                
            <?php ActiveForm::end(); ?>
            
      <?php 
 /*echo TabsX::widget([
     'position' => TabsX::POS_ABOVE,
     'bordered'=>true,
    'align' => TabsX::ALIGN_LEFT,
      'encodeLabels'=>false,
    'items' => [
        [
            'label' =>'<i class="fa fa-bookmark"></i> '.yii::t('base.names','Favoritos'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=>$this->render('_tab_profile_favoritos'),
            'active' => true,
             'options' => ['id' => 'tnID3'],
        ],
        [
            'label' =>'<i class="fa fa-list-ul"></i> '. yii::t('base.names','Registro Acceso'), //$this->context->countDetail() obtiene el contador del detalle
           'content'=>$this->render('_tab_profile_audit'),
            'active' => false,
             'options' => ['id' => 'myy6nID4'],
        ],
      
    ],
]); */
    ?>       
       
    </div>
    <br>
</div>
   
</div>
