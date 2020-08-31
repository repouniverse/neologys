<?php
use common\widgets\buttonajaxwidget\buttonAjaxWidget as btnAjax;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\h;
use frontend\modules\inter\Module as m;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use frontend\modules\inter\models\InterExpedientes;
?>

<?=Html::button(h::awe('plus').h::space(5).m::t('labels','Generate Files'),[ 'id'=>'btn_expe', 'class'=>'btn btn-danger'])?>


<?php
  Pjax::begin(['id'=>'pjaxuno','timeout'=>false]);
?>
<br>
<br>
<?= GridView::widget([
        'dataProvider' =>new ActiveDataProvider([
            'query'=> InterExpedientes::find()->andWhere([
                'convocado_id'=>$model->id,'orden'=>$model::STAGE_UPLOADS]),
                ]),
         //'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
       // 'filterModel' => $searchModel,
        'columns' => [
            
         
         [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function($url, $model) {                        
                        $options = [
                            'title' => Yii::t('base.verbs', 'Update'),                            
                        ];
                        return Html::a('<span class="btn btn-info btn-sm glyphicon glyphicon-pencil"></span>', $url, $options/*$options*/);
                         },
                          'view' => function($url, $model) {                        
                        $options = [
                            'title' => Yii::t('base.verbs', 'View'),                            
                        ];
                        return Html::a('<span class="btn btn-warning btn-sm glyphicon glyphicon-search"></span>', $url, $options/*$options*/);
                         },
                         'delete' => function($url, $model) {                        
                        $options = [
                            'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                            'title' => Yii::t('base.verbs', 'Delete'),                            
                        ];
                        return Html::a('<span class="btn btn-danger btn-sm glyphicon glyphicon-remove"></span>', $url, $options/*$options*/);
                         }
                    ]
                ],
         
         'documento.desdocu',
         'clase',
        [ 'attribute'=>'Attachment',
            'format'=>'raw',
            'value'=>function($model){
                  return $model->flagAttach();           
            }
            ]
         
         
         

           
          
        ],
    ]); ?>

<?PHP 
  /*ECHO btnAjax::widget([
      
  ]);*/
 
   echo btnAjax::widget([  
            'id'=>'btn_expe',
            'idGrilla'=>'pjaxuno',
            'ruta'=>Url::to(['/inter/convocados/ajax-crea-expedientes','id'=>$model->id]),          
           //'posicion'=> \yii\web\View::POS_END           
        ]); 
     

?>


<?php
  Pjax::end();
?>
    


