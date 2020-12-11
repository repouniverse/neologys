<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\data\ActiveDataProvider;
use frontend\modules\acad\models\AcadContenidoSyllabus;

?>
<div class="acad-syllabus-index">

    
    <?php
    $id_pjax_content='dsdsiooioryr';
    Pjax::begin(['id'=>$id_pjax_content,'timeout'=>false]); ?>
    <?php 
            $dataProvider=new ActiveDataProvider([
            'query'=>AcadContenidoSyllabus::find()->select([
               'id' ,'n_sesion',
            'n_semana',
            'bloque1',
            'bloque2',
            'bloque3',
            'n_horas_cumplimiento',
            'n_horas_trabajo_indep',
            ])->andWhere(['unidad_id'=>$identidad_unidad])
        ]);
          // var_dump($dataProvider->getModels()[0]->id);  DIE();
            ?>
       
    <?= GridView::widget([
        'dataProvider' =>$dataProvider,
       
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\ActionColumn',
                //'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
            'template' => '{contenido}',
               'buttons' => [
                     'contenido' => function ($url,$model)use($id_pjax_content){     
                              //return var_dump($model->id);
                            $url = Url::toRoute(['/acad/syllabus/modal-edit-content','id'=>$model->id,'gridName'=>'grid_sumilla','idModal'=>'buscarvalor']);
                             return Html::a('<span class="btn btn-info glyphicon glyphicon-pencil"></span>', $url, ['class'=>'botonAbre']);
                             }, 
                      
                    ]
                ],
            //['class' => 'yii\grid\SerialColumn'],

            'n_sesion',
            'n_semana',
             ['attribute'=>'bloque1',
                 'format'=>'html'
                 ],
           ['attribute'=>'bloque2',
                 'format'=>'html'
                 ],
            ['attribute'=>'bloque3',
                 'format'=>'html'
                 ],
          ['attribute'=>'n_horas_cumplimiento',
                 'header'=>'H Cumpl'
                 ],
          ['attribute'=> 'n_horas_trabajo_indep',
                 'header'=>'H Ind'
                 ],
            //'bloque4',
            
           
           
                
            
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
