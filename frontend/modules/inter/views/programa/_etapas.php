<?php
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\modules\inter\Module as m;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
 USE yii\widgets\Pjax;
 use common\helpers\h;
 //use yii\grid\GridView;
 use kartik\grid\GridView;
?>
<?php Pjax::begin(['id'=>'grilla-etapas']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

    <?= GridView::widget([
        'id'=>'mi-grilletaspas',
        'dataProvider' => new \yii\data\ActiveDataProvider(
                        [
                    'query'=> frontend\modules\inter\models\InterEtapas::find()
                ->andWhere(['programa_id'=>$model->id])->orderBy(
                        [
                            'modo_id'=>SORT_ASC,'orden'=>SORT_ASC
                        ])
                            ]
                ),
        //'filterModel' => $searchModel,
        'columns' => [
             [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}{update}',
                'buttons' => [
                   
                         'update' => function ($url,$model) {
			    $url= Url::to(['modal-edit-etapa','id'=>$model->id,'gridName'=>'grilla-etapas','idModal'=>'buscarvalor']);
                             //echo  Html::button(yii::t('base.verbs','Modificar Rangos'), ['href' => $url, 'title' => yii::t('sta.labels','Agregar Tutor'),'id'=>'btn_contacts', 'class' => 'botonAbre btn btn-success']); 
                            return Html::a('<span class="btn btn-success btn-sm glyphicon glyphicon-pencil"></span>', $url, ['class'=>'botonAbre']);
                            },
                          
                         'delete' => function ($url,$model) {
			    $url = Url::toRoute($this->context->id.'/ajax-detach-psico',['id'=>$model->id]);
                             return Html::a('<span class="btn btn-danger btn-sm glyphicon glyphicon-trash"></span>', '#', ['title'=>$url,/*'id'=>$model->codparam,*/'family'=>'holas','id'=> \yii\helpers\Json::encode(['id'=>$model->id,'modelito'=> str_replace('@','\\',get_class($model))]),/*'title' => 'Borrar'*/]);
                            }
                    ]
                ],
             ['attribute'=>'icono',
               'format'=>'raw',
                'value'=>function($model){
                    return '<i style="font-size:19px;color:#8a172c;">'.trim(h::awe($model->awe)).'</i>';    
                }
             ],
             
           ['attribute'=>'Modo',
               'format'=>'raw',
                'value'=>function($model){
                    return $model->modo->descripcion;    
                },
               'group'=>true,         
                
             ],
            'descripcion',
           'orden',
            
            //'valor1',
            //'valor2',

            
        ],
    ]); ?>
    
    <?php 
   echo linkAjaxGridWidget::widget([
         
            'idGrilla'=>'grilla-etapas',
            'family'=>'holas',
          'type'=>'POST',
           'evento'=>'click',
           'posicion'=> \yii\web\View::POS_END
           
        ]); 
   ?>
    



  <p>
         <?php $url= Url::to(['modal-new-etapa','id'=>$model->id,'gridName'=>'grilla-etapas','idModal'=>'buscarvalor']);
                             //echo  Html::button(yii::t('base.verbs','Modificar Rangos'), ['href' => $url, 'title' => yii::t('sta.labels','Agregar Tutor'),'id'=>'btn_contacts', 'class' => 'botonAbre btn btn-success']); 
                            echo Html::a('<span class="btn btn-success btn-sm glyphicon glyphicon-plus"></span>', $url, ['class'=>'botonAbre']);
         ?>           
 </p>

  <?php Pjax::end(); ?>
