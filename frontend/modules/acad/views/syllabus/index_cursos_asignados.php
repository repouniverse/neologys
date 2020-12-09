<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\helpers\h;
 use kartik\export\ExportMenu;
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
     echo  $this->render('_search_cursos_asignados',['model'=>$searchModel]);
     $mizona='mypjax_id';
    ?>    
    <?php Pjax::begin(['id'=>$mizona,'timeout'=>false]); ?>
    <?php 
    $gridColumns=[
            ['class' => 'yii\grid\SerialColumn'],
            'codesp',
            'codcursocorto',
            'codcur',
            'descripcion',
            [
                'value'=>function($model){
                    return $model->docente->fullName();
                }
            ],
            
           // 'id',
            
                   
                     
            [
                'class' => 'yii\grid\ActionColumn',
                //'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
            'template' => '{profe}{edit}',
              
                ],
        ];
    
    ?>

   
    <?=ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
        'batchSize'=>20,
    'dropdownOptions' => [
        'label' => yii::t('base_labels','Export'),
        'class' => 'btn btn-success pull-right'
    ]
]) . "<hr>\n".GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => $gridColumns,
    ]); ?>

    <?php Pjax::end(); ?>

</div>

