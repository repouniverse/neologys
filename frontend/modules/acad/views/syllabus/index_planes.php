<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\helpers\h;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\acad\models\AcadSyllabusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('base_labels', 'Acad Syllabi');
$this->params['breadcrumbs'][] = $this->title;
?>
 <h4><?= Html::encode($this->title) ?></h4>
<div class="acad-syllabus-index">
   <div class="box box-success">
     <div class="box-body">
   

   
    <?php       
     echo  $this->render('_search_planes',['model'=>$searchModel]);
     $mizona='mypjax_id';
    ?>    
    <?php Pjax::begin(['id'=>$mizona,'timeout'=>false]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'codesp',
           // 'id',
            [
               'format'=>'raw',
               'value'=>function($model){
                  if($model->hasDocente()){
                      return '<i style="font-size:10px; color:#5bb75b;"><span class="fa fa-check"></span></i><i style="font-size:18px; color:#8a172c;"><span class="fa fa-chalkboard-teacher"></span></i>';
                  }else{
                      return "";
                  }
               },
            ],
                   
            'nombrecurso',
            'codcur',
            'codcursocorto',
            'descripcion',
            'codperiodo',           
            [
                'class' => 'yii\grid\ActionColumn',
                //'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
            'template' => '{profe}{edit}',
               'buttons' => [
                        'profe' => function ($url,$model)use($mizona) {
                          $tieneDocente=$model->hasDocente();
                           if(!$tieneDocente){
                               $url =Url::to(['/acad/syllabus/modal-crea-docente','id'=>$model->plan_detalle_id,'gridName'=>$mizona,'idModal'=>'buscarvalor']);
                           }else{
                              $url =Url::to(['/acad/syllabus/modal-edita-docente','id'=>$model->idDocente(),'gridName'=>$mizona,'idModal'=>'buscarvalor']);
                            }
                           $options=['data-pjax'=>'0','class'=>'botonAbre btn btn-danger btn-sm'];
                               return Html::a('<span class=" glyphicon glyphicon-plus glyphicon glyphicon-user">'.(($tieneDocente)?' ':'+').'</span>', $url, $options/*$options*/);
                             },
                    ]
                ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
