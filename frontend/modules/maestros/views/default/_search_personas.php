<?php
 use kartik\date\DatePicker;
use yii\helpers\Html;
use common\helpers\h;
use yii\widgets\ActiveForm;
use frontend\modules\maestros\MaestrosModule as m;
/* @var $this yii\web\View */
/* @var $model common\models\masters\TrabajadoresSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trabajadores-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index-persona'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <div class="form-group">
            <?= Html::submitButton("<span class='fa fa-search'></span>".m::t('verbs', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(m::t('labels', 'Create Person'), ['create-persona'], ['class' => 'btn btn-success']) ?>
          <?= Html::a(m::t('labels', 'Create Foreign Person'), ['create-foreign-person'], ['class' => 'btn btn-warning']) ?>
   
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <?= $form->field($model, 'codigoper') ?>        
    </div>
       
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <?= $form->field($model, 'ap') ?>
    </div>
    
    
    
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <?= $form->field($model, 'nombres') ?>
    </div>
    
    
     <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <?php  //h::settings()->invalidateCache();  ?>
                       <?= $form->field($model, 'cumple')->widget(DatePicker::class, [
                             'language' => h::app()->language,
                           // 'readonly'=>true,
                          // 'inline'=>true,
                           'pluginOptions'=>[
                                     'format' => h::gsetting('timeUser', 'date')  , 
                                  'changeMonth'=>true,
                                  'changeYear'=>true,
                                 'yearRange'=>"-99:+0",
                               ],
                           
                            //'dateFormat' => h::getFormatShowDate(),
                            'options'=>['class'=>'form-control']
                            ]) ?>
</div>
  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <?php  //h::settings()->invalidateCache();  ?>
                       <?= $form->field($model, 'cumple1')->widget(DatePicker::class, [
                             'language' => h::app()->language,
                           // 'readonly'=>true,
                          // 'inline'=>true,
                           'pluginOptions'=>[
                                     'format' => h::gsetting('timeUser', 'date')  , 
                                  'changeMonth'=>true,
                                  'changeYear'=>true,
                                 'yearRange'=>"-99:+0",
                               ],
                           
                            //'dateFormat' => h::getFormatShowDate(),
                            'options'=>['class'=>'form-control']
                            ]) ?>
</div>
 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <?=$form->field($model, 'codgrupo')->
            dropDownList(\common\helpers\ComboHelper::getCboGrupoPersonas() ,
                    ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    )  ?>
</div>
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
   <?=$form->field($model, 'tipodoc')->
            dropDownList($model->comboDataField('tipodoc') ,
                    ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    )  ?>
        </div>
       
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <?= $form->field($model, 'numerodoc') ?>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>
