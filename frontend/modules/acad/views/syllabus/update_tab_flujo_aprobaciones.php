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
 use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use frontend\modules\acad\models\AcadSyllabusCompetencias;
use yii\data\ActiveDataProvider;

use yii\widgets\Pjax;
?>

<div class="box-body">
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
   
       <?php Pjax::begin(['id'=>'grid_flujo_pjax','timeout'=>false]); ?>
    <?php 
  $userId=h::userId();
// echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query'=> frontend\modules\acad\models\AcadTramiteSyllabus::find()->
                select(['id','docu_id','user_id','aprobado','descripcion','focus','fecha_recibido','fecha_aprobacion'])
                ->andWhere(['docu_id'=>$model->id])->orderBy(['orden'=>SORT_ASC])
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
                      //var_dump($model->aprobado);
                      $color=($model->aprobado)?'#60a917':'#eee';
                     // RETURN $color;
                        return '<i style="font-size:20px;color:'.$color.'">'. h::awe('check').'</i>';
                  }
              
                  ], 
             ['attribute'=>'focus',
                 'format'=>'raw',
                   'value'=>function($model) use($userId){
                    $buton1='';
                    $buton2='';
                         if($model->focus){
                             if($model->hasObservaciones()){
                                $link2=Url::to(['modal-edit-observacion','id'=>$model->id,'idModal'=>'buscarvalor','gridName'=>'grid_flujo_pjax']);
                              
                         
                             }else{
                                 $link2=Url::to(['modal-create-observacion','id'=>$model->id,'idModal'=>'buscarvalor','gridName'=>'grid_flujo_pjax']);                        
                             }
                            // $link=Url::to(['ajax-aprobe-syllabus']);
                             $link = Url::toRoute([$this->context->id.'/ajax-aprobe-flujo','id'=>$model->id]);
                          
                            // return $model->id;
                      
                             if($userId==$model->user_id){

                              if($userId!=$model->syllabus->docenteOwner->persona->profile->user_id){
                                $buton2=Html::a('<span class="fa fa-check"></span>Observar',$link2,['data-pjax'=>'0','class'=>'botonAbre btn btn-success']);
                              }

                              $buton1=Html::a('<span class="fa fa-check"></span>Aprobar', '#', ['class'=>'btn btn-success','id'=>$model->id,'title'=>$link,'family'=>'holas']);

                               }else{
                             $buton1='';

                            }                        
                                 
                           $buton2='';  
                         }
                             
                             /*
                             
                            */
                             return $buton1.$buton2;
                              
                             
                         
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
    
    <?php 
   echo linkAjaxGridWidget::widget([
           'id'=>'srttrwidgetgruidBancos',
            'idGrilla'=>'grid_flujo_pjax',
       //'otherContainers'=>['grupo-pjax'],
            'family'=>'holas',
          'type'=>'POST',
           'evento'=>'click',
       'posicion'=>\yii\web\View::POS_END
            //'foreignskeys'=>[1,2,3],
        ]); 
   ?>
    
    
<?php Pjax::end(); ?>
 </div>
</div>