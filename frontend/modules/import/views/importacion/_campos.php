<?php use yii\grid\GridView;
use yii\widgets\Pjax;
?>
<div style='overflow:auto;'>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
      //  'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
              [
                'attribute'=>'aliascampo',
                  'format' => 'raw',
                  'value'=>function($model){
                        $ico=($model->esforeign)?'<i style="color:#f97e00;font-size:16px"><span class="glyphicon glyphicon-info-sign"></span></i>':'';
                        return $model->aliascampo.'   '.$ico;    
                        
                  }
               ],
            'sizecampo',
            'tipo',
            'orden',
         [
    'attribute' => 'requerida',
    'format' => 'raw',
    'value' => function ($model) {
        return \yii\helpers\Html::checkbox('requerida[]', $model->requerida, [ 'disabled' => true]);

             },

          ],
   
                    
   ['attribute' => 'esclave',
        'format' => 'raw',
        'value' => function ($model) {
             if($model->esclave){
                 return '<i style="color:red;font-size:16px;"><span class="fa fa-key"></i></span>';
                 }else{
                  return '';
               }
              }
       ],
     ['attribute'=>'esforeign',
               'format' => 'raw',
    'value' => function ($model) {
             if($model->esforeign){
                $cad=$model->cargamasiva->modelAsocc()->obtenerForeignClass($model->nombrecampo); 
                $campoForaneo=$model->cargamasiva->modelAsocc()->obtenerForeignField($model->nombrecampo);
                $url=\yii\helpers\Url::to([
                 $this->context->id.'/example-file-csv',
                 'id'=>$model->cargamasiva->id,
                 'calse'=>str_replace('\\','_',$cad),
                  'campoforaneo'=>$campoForaneo,  
                 ]);
                $cad= \common\helpers\FileHelper::getShortName($cad);
                return \yii\helpers\Html::a($cad,$url,['data-pjax'=>'0']);
             }else{
                return ''; 
             }
             
           
            
        
             },

          ],
         [
    'attribute' => 'esforeign',
    'format' => 'raw',
    'value' => function ($model) {
        return \yii\helpers\Html::checkbox('esforeing[]', $model->esforeign, [ 'disabled' => true]);

             },

          ],
            //'descripcion',
            //'format',
            //'modelo',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
    



    
    

    
  