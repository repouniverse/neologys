<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\helpers\h;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
$mizona='pajaxn_ui_segu';
 Pjax::begin(['id'=>$mizona,'timeout'=>false]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<div style="overflow:auto;">
    <?= GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query'=> \frontend\modules\acad\models\AcadRespoSyllabus::find()->andWhere(['docente_id'=>$model->id]),
        ]),
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
           // 'codesp',
           // 'id',
            /*[
               'format'=>'raw',
               'value'=>function($model){
                  if($model->hasDocente()){
                      return '<i style="font-size:10px; color:#5bb75b;"><span class="fa fa-check"></span></i><i style="font-size:18px; color:#8a172c;"><span class="fa fa-chalkboard-teacher"></span></i>';
                  }else{
                      return "";
                  }
               },
            ],*/                   
            [
                'value'=>function($model){
                    return $model->planEstudio->curso->descripcion;
                }
            ],          
            [
                'class' => 'yii\grid\ActionColumn',
                //'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
            'template' => '{link}',
               'buttons' => [
                        'link' => function ($url,$model) {
                              $url =Url::to(['/acad/syllabus/create','plan_id'=>$model->planEstudio->plan->id,'docente_id'=>$model->docente_id]);
                              $options=['data-pjax'=>'0','class'=>'btn btn-info btn-sm'];
                               return Html::a('<span class=" glyphicon glyphicon-edit"></span>', $url, $options);
                             },
                    ]
                ],
        ],
    ]); ?>
</div>
<?php 
   echo linkAjaxGridWidget::widget([
           'id'=>'widgetgds',
            'idGrilla'=>$mizona,
           
            'family'=>'holas',
          'type'=>'POST',
           'evento'=>'click',
       'posicion'=>\yii\web\View::POS_END
            //'foreignskeys'=>[1,2,3],
        ]); 
   ?>

    <?php Pjax::end(); ?>
