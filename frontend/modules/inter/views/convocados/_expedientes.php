<?php
use common\widgets\buttonajaxwidget\buttonAjaxWidget as btnAjax;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\h;
use frontend\modules\inter\Module as m;
use yii\widgets\Pjax;
 use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
//use yii\grid\GridView;
USE kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use frontend\modules\inter\models\InterExpedientes;
?>

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
                'template' => '{attach}{aprove}',
                'buttons' => [
                     'attach' => function($url, $model) {  
                         $url=\yii\helpers\Url::toRoute(['/finder/selectimage',
                             'isImage'=>false,'idModal'=>'imagemodal',
                             'idGrilla'=>'pjaxuno','modelid'=>$model->id,
                              'extension'=> \yii\helpers\Json::encode(array_merge(common\helpers\FileHelper::extDocs(),common\helpers\FileHelper::extImages())),
                             'nombreclase'=> str_replace('\\','_',get_class($model))]);
                        $options = [
                            'title' => Yii::t('sta.labels', 'Subir Archivo'),
                            //'aria-label' => Yii::t('rbac-admin', 'Activate'),
                            //'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                            'data-method' => 'get',
                            //'data-pjax' => '0',
                        ];
                        return Html::button('<span class="glyphicon glyphicon-paperclip"></span>', ['href' => $url, 'title' => m::t('verbs','Attach file'), 'class' => 'botonAbre btn btn-danger']);
                        //return Html::a('<span class="btn btn-success glyphicon glyphicon-pencil"></span>', Url::toRoute(['view-profile','iduser'=>$model->id]), []/*$options*/);
                     
                        
                        },
                        'aprove' => function ($url,$model) {
                           if(!$model->estado){
                              $url = Url::toRoute([$this->context->id.'/ajax-aprove-expediente','id'=>$model->id]);
                              return Html::a('<span class="btn btn-success glyphicon glyphicon-thumbs-up"></span>', '#', ['id'=>$model->id,'title'=>$url,'family'=>'holas']);
                          
                           }else{
                              $url = Url::toRoute([$this->context->id.'/ajax-disapbrobe-expediente','id'=>$model->id]);
                              return Html::a('<span class="btn btn-danger glyphicon glyphicon-thumbs-down"></span>', '#', ['id'=>$model->id,'title'=>$url,'family'=>'holas']);
                           
                           }
                            
			   },   
                       
                    ]
                ],
          [
                'class' => 'kartik\grid\ExpandRowColumn',
                'width' => '50px',
                'value' => function ($model, $key, $index, $column) {
                            return GridView::ROW_COLLAPSED;
                                },
                     'detailUrl' =>Url::toRoute([$this->context->id.'/expand-attachments']),
                    //'headerOptions' => ['class' => 'kartik-sheet-style'], 
                    'expandOneOnly' => true
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


<?php 
   echo linkAjaxGridWidget::widget([
           'id'=>'srttrwidgetgruidBancos',
            'idGrilla'=>'pjaxuno',
       //'otherContainers'=>['grupo-pjax'],
            'family'=>'holas',
          'type'=>'POST',
           'evento'=>'click',
       'posicion'=>\yii\web\View::POS_END
            //'foreignskeys'=>[1,2,3],
        ]); 
   ?>


<?php
  Pjax::end();
?>
    


