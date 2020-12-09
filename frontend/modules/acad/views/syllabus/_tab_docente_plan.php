<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\helpers\h;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
$mizona2='pajaxn_ui2';
$docente_id=$model->id;
 Pjax::begin(['id'=>$mizona2,'timeout'=>false]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<div style="overflow:auto;">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'carrera_id',
                'filter'=> \common\helpers\ComboHelper::getCboCarreras(h::gsetting('general', 'MainFaculty')),
                'value'=>function($model){
                        return $model->nombre;
                }
                ],
           // 'id',
            
                   
            'nombrecurso',
            'codcur',
            'codcursocorto',
                     
            [
                'class' => 'yii\grid\ActionColumn',
                //'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
            'template' => '{rescue}',
               'buttons' => [
                    
                    'rescue' => function ($url,$model) use($docente_id){
                   
                            $url = Url::toRoute(['/acad/syllabus/ajax-asigna-curso','plan_id'=>$model->plan_detalle_id,'docente_id'=>$docente_id]);
                              return Html::a('<span class="btn btn-info glyphicon glyphicon-log-in"></span>', 'javascript:void();', ['id'=>$model->id,'title'=>$url,'family'=>'holas2']);
                       
			   },                    
                        
                    ]
                ],
        ],
    ]); ?>
</div>
<?php 
   echo linkAjaxGridWidget::widget([
           'id'=>'widgetgruidBancos',
            'idGrilla'=>$mizona2,
        'otherContainers'=>['pajaxn_ui_segu'],
            'family'=>'holas2',
          'type'=>'POST',
           'evento'=>'click',
       'posicion'=>\yii\web\View::POS_END
            //'foreignskeys'=>[1,2,3],
        ]); 
   ?>


    <?php Pjax::end(); ?>