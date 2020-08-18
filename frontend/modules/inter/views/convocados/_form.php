<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\inter\Module as m;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterConvocados */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inter-convocados-form">
    <br>
    <?php $form = ActiveForm::begin([
    'fieldClass'=>'\common\components\MyActiveField'
    ]); ?>
      <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                
        <?= Html::submitButton('<span class="fa fa-save"></span>   '.Yii::t('base_labels', 'Save'), ['class' => 'btn btn-warning']) ?>
            

            </div>
        </div>
    </div>
      <div class="box-body">
 
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     <?= $form->field($model, 'universidad_id')->label(m::t('labels','University'))->textInput(['value'=>$model->universidad->nombre,'disabled'=>true]) ?>
      
 </div>
  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">     
     <?= $form->field($model, 'facultad_id')->label(m::t('labels','Faculty'))->textInput(['value'=>$model->facultad->desfac,'disabled'=>true]) ?>
      
 </div>
  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
     <?= $form->field($model, 'depa_id')->label(m::t('labels','Departament'))->textInput(['value'=>$model->depa->nombredepa,'disabled'=>true]) ?>
      
 </div>
 
  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
     <?= $form->field($model, 'alumno_id')->label(m::t('labels','Student'))->textInput(['value'=>$model->alumno->fullName(false),'disabled'=>true]) ?>
      
 </div>
          
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <p>
         <?php $url= Url::to(['modal-new-opuniv','id'=>$model->id,'gridName'=>'OpcionesUniversidad','idModal'=>'buscarvalor']);
        //echo  Html::button(yii::t('base.verbs','Modificar Rangos'), ['href' => $url, 'title' => yii::t('sta.labels','Agregar Tutor'),'id'=>'btn_contacts', 'class' => 'botonAbre btn btn-success']); 
       echo Html::a('<span class="btn btn-success btn-sm glyphicon glyphicon-plus"></span>', $url, ['class'=>'botonAbre']);
         ?>           
     </p>
      
 </div> 
   <?php ActiveForm::end(); ?>
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">      
    <?php Pjax::begin(['id'=>'OpcionesUniversidad']); ?>      
          
    <?= GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query'=> \frontend\modules\inter\models\InterOpuniv::find()->andWhere(['convocatoria_id'=>$model->id])
        ]),
        //'summary' => '',
        'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
        //'filterModel' => $searchModel,
        'columns' => [
            
         
         [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function($url, $model) {                        
                        $options = [
                            'title' => m::t('verbs', 'Update'),                            
                        ];
                        $url= Url::to(['modal-edit-opuniv','id'=>$model->id,'gridName'=>'OpcionesUniversidad','idModal'=>'buscarvalor']);
                        return Html::a('<span class="btn btn-info btn-sm glyphicon glyphicon-pencil"></span>', $url, $options/*$options*/);
                         },                          
                         'delete' => function($url, $model) {                        
                        $options = [
                            'data-confirm' => m::t('labels', 'Are you sure you want to activate this user?'),
                            'title' => m::t('verbs', 'Delete'),                            
                        ];
                        return Html::a('<span class="btn btn-danger btn-sm glyphicon glyphicon-remove"></span>', $url, $options/*$options*/);
                         }
                    ]
                ],
         
         
         
         
         
            ['attribute'=>'Universidad',
                'value'=> function($model){
                    return $model->univop->nombre;
                }
                ],                
            'prioridad',
            'comentarios',
        ],
    ]); ?>
    <?php Pjax::end(); ?>      
    </div>
</div>
    
    </div>
