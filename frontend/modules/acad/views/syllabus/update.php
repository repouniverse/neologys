<?php

use yii\helpers\Html;
use kartik\tabs\TabsX;
use common\helpers\h;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model frontend\modules\acad\models\AcadSyllabus */

$this->title = Yii::t('base_labels', 'Update Acad Syllabus: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'Acad Syllabi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('base_labels', 'Update');
?>


    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-body">
  
     <?php $form = ActiveForm::begin(); ?>
       <div class="col-md-12">
            <div class="form-group no-margin">
            <?= Html::submitButton(Yii::t('base_labels', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    <?php echo TabsX::widget
                  (
                    [
                        'position' => TabsX::POS_ABOVE,
                        'bordered'=>true,
                        'align' => TabsX::ALIGN_LEFT,
                        'encodeLabels'=>false,
                        'items' =>
                        [
                            [
                                'label'=>'<i class="fa fa-home"></i> '.yii::t('base_labels','General'),
                                'content'=> $this->render('_form',['model' => $model,'form'=>$form]),
                                'active' => true,
                                'options' => ['id' => 'myvnID3'],
                            ],
                            [
                                'label'=>'<i class="'.h::awe('users').'"></i> '.yii::t('base_labels','Summary and contents'),
                                'content'=> $this->render('update_tab_sumilla',['model' => $model,'form'=>$form]),
                                'active' => false,
                                'options' => ['id' => 'movtytyrwnID4'],
                            ],  
                            
                            [
                                'label'=>'<i class="fa fa-home"></i> '.yii::t('base_labels','competencies'),
                                'content'=> $this->render('update_tab_competencias',['model' => $model,'form'=>$form]),
                                'active' => false,
                                'options' => ['id' => 'tr565myvnID3'],
                            ],
                            
                            
                            [
                                'label'=>'<i class="'.h::awe('users').'"></i> '.yii::t('base_labels','Strategies'),
                                'content'=> $this->render('update_tab_estrategias',['model' => $model,'form'=>$form]),
                                'active' => false,
                                'options' => ['id' => 'movrerrw78nID4'],
                            ],       
                            [
                                'label'=>'<i class="'.h::awe('users').'"></i> '.yii::t('base_labels','Resources'),
                                'content'=> $this->render('update_tab_recursos',['model' => $model,'form'=>$form]),
                                'active' => false,
                                'options' => ['id' => 'movrfggfwnrerID4'],
                            ], 
                            [
                                'label'=>'<i class="'.h::awe('users').'"></i> '.yii::t('base_labels','Sources'),
                                'content'=> $this->render('update_tab_fuentes',['model' => $model,'form'=>$form]),
                                'active' => false,
                                'options' => ['id' => '56ggfwnrerID4'],
                            ], 
                            [
                                'label'=>'<i class="'.h::awe('users').'"></i> '.yii::t('base_labels','Evaluation'),
                                'content'=> $this->render('update_tab_evaluacion',['model' => $model,'form'=>$form]),
                                'active' => false,
                                'options' => ['id' => '56xetrerID4'],
                            ], 
                        ],
                    ]
                  );  
            ?>
 <?php ActiveForm::end(); ?>
</div>
