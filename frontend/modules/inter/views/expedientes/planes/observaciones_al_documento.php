<?php
use frontend\modules\inter\Module as m;
USE frontend\modules\inter\models\InterObsexpe;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
?>
<?php 
$gridName='grillap';
Pjax::begin(['id'=>$gridName]); ?>
 <div style='overflow:auto;'>
<?php  

    echo GridView::widget([
        'dataProvider' =>new \yii\data\ActiveDataProvider([
            'query'=> $model->getObservaciones(),
        ]),
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
       // 'filterModel' => $searchModel,
        'columns' => [
            
         
         [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function($url, $model)use($gridName) {                        
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
                       'delete' => function ($url,$model) {
			   $url = \yii\helpers\Url::toRoute($this->context->id.'/deletemodel-for-ajax');
                              return \yii\helpers\Html::a('<span class="btn btn-danger glyphicon glyphicon-trash"></span>', '#', ['title'=>$url,/*'id'=>$model->codparam,*/'family'=>'holas','id'=>\yii\helpers\Json::encode(['id'=>$model->id,'modelito'=> str_replace('@','\\',get_class($model))]),/*'title' => 'Borrar'*/]);
                            }
                    ]
                ],
         ['attribute'=>'detalles',
             'value'=>function($model){
               return substr($model->detalles,0,40);
             }
         ],
          [
                    'class' => 'yii\grid\CheckboxColumn',
                     'checkboxOptions' => function($model) {
                    return ['value' => $model->valido];
                     }
                ],
         
         
         
         

          
        ],
    ]); ?>
     
             <?php 
   echo linkAjaxGridWidget::widget([
           'id'=>'widgetgruidBancos',
            'idGrilla'=>$gridName,
            'family'=>'holas',
          'type'=>'POST',
           'evento'=>'click',
            //'foreignskeys'=>[1,2,3],
        ]); 
   ?>
    <?php Pjax::end(); ?>
</div>
<p>
         <?php $url= Url::to(['modal-new-obs','id'=>$model->id,'gridName'=>$gridName,'idModal'=>'buscarvalor']);
                             //echo  Html::button(m::t('base.verbs','Modificar Rangos'), ['href' => $url, 'title' => m::t('labels','Agregar Tutor'),'id'=>'btn_contacts', 'class' => 'botonAbre btn btn-success']); 
                            echo Html::a('<span class="btn btn-success btn-sm glyphicon glyphicon-plus"></span>', $url, ['class'=>'botonAbre']);
         ?>           
 </p>




