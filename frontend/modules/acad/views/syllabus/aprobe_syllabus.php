<?php
use yii\db\Query;
use yii\grid\GridView;
use frontend\modules\acad\models\AcadRespoSyllabus;
use common\models\masters\Cursos;
use frontend\modules\acad\models\AcadTramiteSyllabus;
use yii\widgets\Pjax;
use yii\helpers\Url;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;

//VAR_DUMP($dataProvider->getModels()[0]);die();
  Pjax::begin(['id'=>'pjaxuno']);   
  $dataProvider=New \yii\data\ActiveDataProvider([
            'query'=>AcadTramiteSyllabus::find()->where([
                'user_id'=>$idUser,
            ]),
      ]);
  
  
  echo AcadTramiteSyllabus::find()->where([
                'user_id'=>$idUser,
            ])->createCommand()->rawSql;
echo GridView::widget([
        'dataProvider' => $dataProvider,
        ///'filterModel' => $searchModel,
        'columns' => [
             'orden',
            'descripcion',
            'syllabusView.codperiodo',
            'syllabusView.codcursocorto',
            'syllabusView.descripcion',
            
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