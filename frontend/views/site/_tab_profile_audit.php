<?php

 //use frontend\modules\sta\models\StaDocuAluSearch;
 use yii\widgets\Pjax;
 use yii\grid\GridView;
 use yii\helpers\Html;
  use yii\helpers\Url;
  use common\models\Useraudit;
  USE common\helpers\h;
 //use frontend\modules\sta\models\ExamenesSearch;
?>
<div>
   
    
   <?php Pjax::begin(['id'=>'grid_audit']); ?>
    
   <?php //var_dump((new SigiApoderadosSearch())->searchByEdificio($model->id)); die(); ?>
    <?= GridView::widget([
        'id'=>'grid-audiot',
        'dataProvider' =>new \yii\data\ActiveDataProvider([
            'query' => Useraudit::find()->andWhere(['user_id'=>h::userId()])->orderBy('when DESC'),
            'pagination'=>['pageSize'=>10]
        ]),
         //'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
        'columns' => [
                
                                    [
              'attribute' => 'when',
                  //'header'=>'Código',
               
             ],
            [
              'attribute' => 'ip',
                
                    ],
             
             
              [
              'attribute' => 'action',
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
        
    <?php Pjax::end(); ?> 
    
 
</div>