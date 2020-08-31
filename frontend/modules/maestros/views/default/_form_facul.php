<?php

 use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use kartik\tabs\TabsX;
use frontend\modules\maestros\MaestrosModule as m;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
 //USE yii\widgets\Pjax;
 use yii\grid\GridView;
 use yii\helpers\Url;
  use yii\helpers\Html;
  use common\helpers\ComboHelper;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Talleres */
ECHO \common\widgets\spinnerWidget\spinnerWidget::widget();
/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterPrograma */

$this->title = m::t('labels', 'Update Inter Program: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Inter Programs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = m::t('verbs', 'Update');
?>
<div class="inter-programa-update">

   <div class="combovalores-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
        <?= Html::submitButton('<span class="fa fa-save"></span>    '.m::t('verbs', 'Save'), ['class' => 'btn btn-success']) ?>
         <?=($model->isNewRecord)?'':common\widgets\auditwidget\auditWidget::widget(['model'=>$model])?>
        </div>
    </div>
    
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <?= $form->field($model, 'universidad_id')->
            dropDownList(ComboHelper::getCboUniversidades(),
                  ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
        </div>
  
    
    
    
    
    <div class="col-lg-3 col-md-8 col-sm-6 col-xs-12">
        <?= $form->field($model, 'desfac')->textInput(['maxlength' => true]) ?>
    </div>
    
   

    <?php ActiveForm::end(); ?>
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php echo ".";  ?>
    </div>
<?php if(!$model->isNewRecord) {  ?>
       
       
    <?php echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
     'bordered'=>true,
    'align' => TabsX::ALIGN_LEFT,
      'encodeLabels'=>false,
    'items' => [
        [
          'label'=>'<i class="fa graduation-cap"></i> '.m::t('labels','Departaments'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_form_facul_tab_depa',['model' => $model]),
            'active' => true,
             'options' => ['id' => 'myveryownID3'],
        ],
        [
          'label'=>'<i class="fa fa-users"></i> '.m::t('labels','Professions'), //$this->context->countDetail() obtiene el contador del detalle
            'content'=> $this->render('_form_facul_tab_carrera',[ 'model' => $model]),
            'active' => false,
             'options' => ['id' => 'my56y67nID4'],
        ],
       
        
       
    ],
]);  
  ?>
       
<?php  }  ?>
       
   
</div>

    
  
</div>


