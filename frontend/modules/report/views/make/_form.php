<?php

use yii\helpers\Html;
use common\helpers\ComboHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\report\models\Reporte */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$papeles =['A3'=>'A3','A4'=>'A4','A5-L'=>'A5-L','A5'=>'A5','Letter'=>'Letter','A3-L'=>'A3-L','A4-L'=>'A4-L','Letter-L'=>'Letter-L'];

        
?>
<div class="reporte-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'xgeneral')->textInput() ?>
    </div>
     
    
    
    
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'ygeneral')->textInput() ?>
 </div>
    
   <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= \common\widgets\imagewidget\ImageWidget::widget(['name'=>'imagenrep','model'=>$model]); ?>
   </div>
    
    
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'xlogo')->textInput() ?>
 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'ylogo')->textInput() ?>
 </div>
     <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
       <?= $form->field($model, 'codocu')->
            dropDownList(ComboHelper::getCboDocuments(),
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                        ]
                    ) ?>
    
       
    </div>
    
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
       <?= $form->field($model, 'role')->
            dropDownList(ComboHelper::getCboRoles(),
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                        ]
                    ) ?>
    
       
    </div>
    
     <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
       <?= $form->field($model, 'codcen')->
            dropDownList(ComboHelper::getCboCentros(),
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                        ]
                    ) ?>
    
       
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
       <?= $form->field($model, 'modelo')->
            dropDownList(ComboHelper::getCboModels(),
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                        ]
                    ) ?>
    
       
    </div>
    
   
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'nombrereporte')->textInput(['maxlength' => true]) ?>
 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'detalle')->textarea(['rows' => 6]) ?>
 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'campofiltro')->textInput(['maxlength' => true]) ?>
 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
       <?= $form->field($model, 'tamanopapel')->
            dropDownList($papeles,
                    ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                        ]
                    ) ?>
    
       
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'x_grilla')->textInput() ?>
 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'y_grilla')->textInput() ?>
 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'registrosporpagina')->textInput() ?>
 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'tienepie')->checkbox() ?>
 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'tienelogo')->checkbox() ?>
 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'xresumen')->textInput() ?>
 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'yresumen')->textInput() ?>
 </div>
 
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'comercial')->checkbox() ?>
 </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <?= $form->field($model, 'tienecabecera')->checkbox() ?>
 </div>
    
     <?= ''/*Html::dropDownList('parentmodels', ' ', (new $model->modelo)->parentModels(), []);*/?>
     
    
    <div class="form-group">
        
        <?= Html::submitButton(Yii::t('report.messages', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    
    <?php


?>
    <?php echo($model->isNewRecord)?'':$this->render('_grilla',[
        'searchModel'=>$searchModel,
        'dataProvider'=>$dataProvider,
    ]);  ?>
    
  
    
    
    
    
    
    
    
    
</div>
