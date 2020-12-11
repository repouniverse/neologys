<?php
use kartik\editable\Editable;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
//use yii\widgets\ActiveForm;
//use common\helpers\ComboHelper;
use common\helpers\h;
//use common\widgets\selectwidget\selectWidget;
//use yii\grid\GridView;

use frontend\modules\acad\models\AcadSyllabusCompetencias;
use yii\data\ActiveDataProvider;

use yii\widgets\Pjax;
?>

<div class="box-body">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   
       <?php Pjax::begin(['id'=>'grid_competencias_pjax','timeout'=>false]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query'=> AcadSyllabusCompetencias::find()->
                select(['id','bloque','bloque_padre','item_bloque','contenido_bloque'])->andWhere(['syllabus_id'=>$model->id])
        ]),
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
                'bloque',
            'item_bloque',
              [
            'class' => 'kartik\grid\EditableColumn',
            'editableOptions'=>[
                            'pjaxContainerId'=>'grid_competencias_pjax',
                            //'format' => Editable::FORMAT_BUTTON,
                            'inputType' => Editable::INPUT_DROPDOWN_LIST,
                          'data'=> ['Competencias'=>'Competencias','Componentes'=>'Componentes'],  
                                            ],
            'attribute' => 'bloque_padre',
           // 'pageSummary' => 'Total',
            'vAlign' => 'left',
            'width' => '100px',
            'readonly' => false,
           //'data'=>['modelo'=>'mimodelo']
            
         ],
            
            [
            'class' => 'kartik\grid\EditableColumn',
            'editableOptions'=>[
                            'pjaxContainerId'=>'grid_competencias_pjax',
                            //'format' => Editable::FORMAT_BUTTON,
                            'inputType' => Editable::INPUT_DROPDOWN_LIST,
                          'data'=> ['1'=>yii::t('base_labels','Enabled'),'0'=>yii::t('base_labels','Disabled')],  
                                            ],
            'attribute' => 'activo',
            'value'=>function($model){
                  return ($model->activo)?yii::t('base_labels','Enabled'):yii::t('base_labels','Disabled');
               },
           // 'pageSummary' => 'Total',
            'vAlign' => 'left',
            'width' => '100px',
            'readonly' => false,
           //'data'=>['modelo'=>'mimodelo']
            
         ],
            
               [
                   'attribute'=>'contenido_bloque',
                   
                   'format'=>'html',
                   ],
            ['class' => 'yii\grid\ActionColumn',
                //'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
            'template' => '{edit}{visible}',
               'buttons' => [                    
                                     
                        
                     'edit' => function ($url,$model){                   
                            $url = Url::toRoute(['/acad/syllabus/modal-editar-compe','id'=>$model->id,'gridName'=>'grid_competencias_pjax','idModal'=>'buscarvalor']);
                              return Html::a('<span class="btn btn-info glyphicon glyphicon-pencil"></span>', $url, ['class'=>'botonAbre']);
                             }, 
                    /* 'visible' => function ($url,$model){   
                              $icon=($model->activo)?'glyphicon glyphicon-eye-open':'glyphicon glyphicon-eye-close';
                           // $url = Url::toRoute(['/acad/syllabus/modal-editar-compe','id'=>$model->id,'gridName'=>'grid_competencias_pjax','idModal'=>'buscarvalor']);
                              return Html::a('<span class="btn btn-warning '.$icon.'"></span>', $url, ['class'=>'']);
                             }, */
                    ]
                ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
 </div>
</div>