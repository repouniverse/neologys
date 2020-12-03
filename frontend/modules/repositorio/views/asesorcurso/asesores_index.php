<?php

use yii\helpers\Html;
use kartik\grid\GridView;
//use yii\grid\GridView;
use yii\widgets\Pjax;
 use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel common\models\masters\AsesoresCursoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('base_labels', 'List of students with advisor');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asesores-curso-index">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
  <div class="box-body">  

    <?php Pjax::begin(); ?>
      
     <?php echo  $this->render('_search_alumnos_asesor',[
         'model'=>$searchModel,
     ]);  ?> 
      
      
      
    <?php 
  $gridColumns=[
            ['class' => 'yii\grid\SerialColumn'],
            [  'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}',
                
                ],
            ['attribute'=>'Asesor',
                //'header'=>'Asesor',
                'value'=>function($model){
                     return $model->asesor->docente->persona->fullName(false);
                }
             ],
            
            ['attribute'=>'codesp',
                //'header'=>'Escuela',
                'group'=>true,
             ],
                     
              ['attribute'=>'descripcion',
               
                'header'=>'Curso',
                   'group'=>true,
             ],       
            ['attribute'=>'seccion',
               /* 'value'=>function($model){
                     return $model->seccion;
                }*/
                ],
            ['attribute'=>'Alumno',
                'value'=>function($model){
                     return $model->alumno->fullName(false);
                }
                ],
            /*['attribute'=>'apasesor'],*/
            
        ];
// echo $this->render('_search', ['model' => $searchModel]); 
    
    ?>

    <?=ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
        'batchSize'=>20,
    'dropdownOptions' => [
        'label' => yii::t('base_labels','Export'),
        'class' => 'btn btn-success'
    ]
]) . "<hr>\n". GridView::widget([
        'dataProvider' => $dataProvider,
       //'filterModel' => $searchModel,
        'columns' =>$gridColumns ,
    ]); ?>

    <?php Pjax::end(); ?>
</div>
</div>
    </div>
