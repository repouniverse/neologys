<?php
use kartik\editable\Editable;
//use kartik\grid\GridView;
use yii\helpers\Html;
use common\models\User;
use yii\helpers\Url;
//use yii\widgets\ActiveForm;
//use common\helpers\ComboHelper;
use common\helpers\h;
//use common\widgets\selectwidget\selectWidget;
use yii\grid\GridView;

use frontend\modules\acad\models\AcadSyllabusCompetencias;
use yii\data\ActiveDataProvider;

use yii\widgets\Pjax;
?>

<div class="box-body">
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
   
       <?php Pjax::begin(['id'=>'grid_flujo_pjax','timeout'=>false]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query'=> frontend\modules\acad\models\AcadTramiteSyllabus::find()->
                select(['id','user_id','descripcion','focus','fecha_recibido','fecha_aprobacion'])
                ->andWhere(['docu_id'=>$model->id])
        ]),
        //'filterModel' => $searchModel,
        'summary'=>'',
        'columns' => [
            
           [
               'attribute'=>'user_id',
               'value'=>function($model){
                        return   User::findIdentity($model->user_id)->username;
                  }
              
                  ],
              'descripcion',             
           [
               'attribute'=>'aprobado',
               'format'=>'raw',
               'value'=>function($model){
                      $color=($model->aprobado)?'#60a917':'#eee';
                        return '<i style="font-size:20px;color:'.$color.'">'. h::awe('check').'</i>';
                  }
              
                  ], 
             ['attribute'=>'focus',
                 'format'=>'raw',
                   'value'=>function($model){
                         if($model->focus){
                             $link=Url::to(['aprobe-syllabus']);
                             $link2=Url::to(['modal-create-observacion','id'=>$model->id,'idModal'=>'buscarvalor','gridName'=>'grid_flujo_pjax']);
                        
                             $buton1=Html::a('<span class="fa fa-check"></span>Aprobar',$link,['data-pjax'=>'0','class'=>'btn btn-warning']);
                             $buton2=Html::a('<span class="fa fa-check"></span>Observar',$link2,['data-pjax'=>'0','class'=>'botonAbre btn btn-success']);
                             
                             return $buton1.$buton2;
                              
                             
                         }else{
                             return '';
                         }
                    }
              
                 ],
         [
               'attribute'=>'fecha_recibido',
              // 'format'=>'raw',
               'value'=>function($model){
                         if($model->fecha_recibido=='31/12/1969 19:00:00') RETURN '';
                        return $model->fecha_recibido ;
                  }
              
                  ], 
          [
               'attribute'=>'fecha_aprobacion',
              // 'format'=>'raw',
               'value'=>function($model){
                         if($model->fecha_aprobacion=='31/12/1969 19:00:00') RETURN '';
                        return $model->fecha_aprobacion ;
                  }
              
                  ], 
              
        ],
    ]); ?>
<?php Pjax::end(); ?>
 </div>
</div>