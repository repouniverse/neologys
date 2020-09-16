 <?php 
  use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use frontend\modules\inter\Module as m;
    use yii\helpers\Url;
    use yii\grid\GridView;
    use yii\widgets\Pjax;
 
 
     echo GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider(
                [
                    'query'=> frontend\modules\inter\models\InterHorarios::find()->
                                andWhere(['plan_id'=>$model->id]),
                ]
                ),
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
       // 'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{edit}',
                'buttons' => [
                   
                         'edit' => function ($url,$model) {
			    $url= Url::to(['edit-horario','id'=>$model->id,'gridName'=>'grilla-rangos','idModal'=>'buscarvalor']);
                             //echo  Html::button(m::t('base.verbs','Modificar Rangos'), ['href' => $url, 'title' => m::t('sta.labels','Agregar Tutor'),'id'=>'btn_contacts', 'class' => 'botonAbre btn btn-success']); 
                            return Html::a('<span class="btn btn-danger btn-sm glyphicon glyphicon-pencil"></span>', $url, ['class'=>'botonAbre']);
                            }
                    ]
                ],
            'dia',
             [
                 'attribute'=>'nombredia',
                 'format'=>'raw',
                    'value' => function ($model, $key, $index, $column) {
                        $formato=($model->activo)?'  <i style="color:#3ead05;font-size:12px"><span class="glyphicon glyphicon-ok"></span></i>':
                        '  <i style="color:red;font-size:12px"><span class="glyphicon glyphicon-remove"></span></i>';
                        return $model->nombredia.$formato;
                        },
                 
                 ],
             'tolerancia',
            /*[
                'attribute'=>'psico',
                'header'=>'Psicólogo',
                 'value'=>function($model){
                   if(!empty($model->codtra)){
                       return $model->trabajadores->fullName();
                   }else{
                      return  ''; 
                   }
                   
                        
                 }
            ],  */               
            'hinicio',
             'hfin',
          
        ],
    ]); ?>
        
  
    


  

