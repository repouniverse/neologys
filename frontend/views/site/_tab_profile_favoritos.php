<?php
 use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
 //use frontend\modules\sta\models\StaDocuAluSearch;
 use yii\widgets\Pjax;
 use yii\grid\GridView;
 use yii\helpers\Html;
  use yii\helpers\Url;
  use common\models\Userfavoritos;
  USE common\helpers\h;
 //use frontend\modules\sta\models\ExamenesSearch;
?>
<div>
   
    
   <?php Pjax::begin(['id'=>'grid_favoritos']); ?>
    
   <?php //var_dump((new SigiApoderadosSearch())->searchByEdificio($model->id)); die(); ?>
    <?= GridView::widget([
        'id'=>'grid-docusx',
        'dataProvider' =>new \yii\data\ActiveDataProvider([
            'query' => Userfavoritos::find()->andWhere(['user_id'=>h::userId()]),
            'pagination'=>['pageSize'=>10]
        ]),
         //'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
        'columns' => [
                 [
                'class' => 'yii\grid\ActionColumn',
                //'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
            'template' => '{delete}{home}',
               'buttons' => [
                  'delete' => function ($url,$model) {
			   $url = \yii\helpers\Url::toRoute($this->context->id.'/deletemodel-for-ajax');
                              return \yii\helpers\Html::a('<span class="btn btn-danger glyphicon glyphicon-trash"></span>', '#', ['title'=>$url,'id'=>$model->id,'family'=>'pinke','id'=>\yii\helpers\Json::encode(['id'=>$model->id,'modelito'=> str_replace('@','\\',get_class($model))]),'title' => $url]);
                            },
                    'home' => function ($url,$model) {
                             if(!$model->ishome){
                                  $url = \yii\helpers\Url::toRoute([$this->context->id.'/set-home-url','id'=>$model->id]);
                              return \yii\helpers\Html::a('<span class="btn btn-success glyphicon glyphicon-home"></span>', '#', ['title'=>$url,'id'=>$model->id,'family'=>'pinke','id'=>\yii\helpers\Json::encode(['id'=>$model->id,'modelito'=> str_replace('@','\\',get_class($model))]),'title' => $url]);
                                
                             }else{
                                return ''; 
                             }
                    }
			  
                       
                       
                    ]
                ],
                                    [
              'attribute' => 'alias',
                  //'header'=>'Código',
               
             ],
            [
              'attribute' => 'url',
                  //'header'=>'Código',
                'format'=>'raw',
                'value' => function ($model) {
                    return substr($model->url,0,20).'...';            
                },
              'contentOptions' => ['style' => 'width:300px;'],
                    ],
             
             
              [
              'attribute' => 'ishome',
                    'format' => 'raw',
    'value' => function ($model) {
        return \yii\helpers\Html::checkbox('calificacion[]', $model->ishome, [ 'disabled' => true]);

             },
                  /*'header'=>'Nombre',
               'format'=>'raw',
                'value' => function ($model) {
                    if($model->hasAttachments()){
                        //var_dump($model->testTalleres);
                        return Html::a($model->documento->desdocu, $model->files[0]->getUrl(), ['data-pjax'=>'0']);      
                     
                    }else{
                       return $model->documento->desdocu ;
                    }
                   },*/
                    ],
        ],
    ]); ?>
        <?php 
   echo linkAjaxGridWidget::widget([
           'id'=>'widgetgruidBanuyucos',
            'idGrilla'=>'grid_favoritos',
            'family'=>'pinke',
          'type'=>'POST',
           'evento'=>'click',
        'posicion'=>\yii\web\View::POS_END,
            //'foreignskeys'=>[1,2,3],
        ]); 
   ?>
    <?php Pjax::end(); ?> 
    
 
</div>