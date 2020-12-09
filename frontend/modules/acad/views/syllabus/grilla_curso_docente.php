<?php

use yii\db\Query;
use yii\grid\GridView;
use frontend\modules\acad\models\AcadRespoSyllabus;
use common\models\masters\Cursos;
use yii\widgets\Pjax;
use yii\helpers\Url;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;

//VAR_DUMP($dataProvider->getModels()[0]);die();
  Pjax::begin(['id'=>'pjaxuno']);    
echo GridView::widget([
        'dataProvider' => $dataProvider,
        ///'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
             [
                    'class' => 'yii\grid\CheckboxColumn',
                     'checkboxOptions' => function($model) {
                    return ['value' =>$model['id'],
                        'family'=>'identidad_familiar', 'title'=>Url::to(['ajax-register-docente']),
                        ];
                     }
                ],
             
            'id',
            'ciclo',
           // 'codperiodo',
            'codcursocorto',
            'descripcion',
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

<?php 

echo linkAjaxGridWidget::widget([
         'id'=> uniqid(),
            'idGrilla'=>'pjaxuno',
       //'otherContainers'=>['grupo-pjax'],
            'family'=>'identidad_familiar',
          'type'=>'POST',
           'evento'=>'click',
       'posicion'=>\yii\web\View::POS_END    
]);
Pjax::end();

?>