<?php
    use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
    use common\models\masters\Personas;
    use yii\helpers\Html;
    use common\helpers\h;
    use yii\grid\GridView;
    use yii\widgets\Pjax;
    use frontend\modules\maestros\MaestrosModule as m;

    $this->title = m::t('labels', 'Manage Persons');
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="trabajadores-index">
    <h4><?=h::awe('users').h::space(10).Html::encode($this->title) ?></h4>
    <div class="box box-success">
        <div class="box-body">
            <?php Pjax::begin(['id'=>'gridTraba']); ?>
            <?php  echo $this->render('_search_personas', ['model' => $searchModel]); ?>

 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   .

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        // 'summary' => '',
        'columns' => [
           

            'codigoper',
            ['attribute'=>'identidad_id',
                //'filter'=>Personas::comboDataField('tipodoc'),
                 'format'=>'raw',
                'value'=>function($model){
                    if($model->identidad_id>0){
                       return '<i style="font-size:20px; color:green" >'.h::awe('link').'</i>';
               
                    }else{
                        return '<i style="font-size:20px; color:red" >'.h::awe('unlink').'</i>';
                
                    }
                          }
                ],
            'ap',
            'am',
            'nombres',
             'numerodoc',
            ['attribute'=>'tipodoc',
                //'filter'=>Personas::comboDataField('tipodoc'),
                'value'=>function($model){
                        return $model->comboValueField('tipodoc');
                }
                ],
             
            
            //'ppt',
            //'pasaporte',
            //'codpuesto',
            //'cumple',
            //'fecingreso',
            //'domicilio',
            //'telfijo',
            //'telmoviles',
            //'referencia',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{update}{view}',
                'buttons'=>[
                    'update'=>function($url,$model){
                        $url=\yii\helpers\Url::toRoute(['update-persona','id'=>$model->id]);
                        return \yii\helpers\Html::a(
                                '<span class="btn btn-success glyphicon glyphicon-pencil"></span>',
                                $url,
                                ['data-pjax'=>'0']
                                );
                     },
                     'view'=>function($url,$model){
                        $url=\yii\helpers\Url::toRoute(['view-persona','id'=>$model->id]);
                        return \yii\helpers\Html::a(
                                '<span class="btn btn-success glyphicon glyphicon-search"></span>',
                                $url,
                                ['data-pjax'=>'0']
                                );
                     },
                             'delete' => function ($url,$model) {
			   $url = \yii\helpers\Url::toRoute($this->context->id.'/deletemodel-for-ajax');
                              return \yii\helpers\Html::a('<span class="btn btn-danger glyphicon glyphicon-trash"></span>', '#', ['title'=>$url,/*'id'=>$model->codparam,*/'family'=>'holas','id'=>\yii\helpers\Json::encode(['id'=>$model->id,'modelito'=> str_replace('@','\\',get_class($model))]),/*'title' => 'Borrar'*/]);
                            }
                   ]
                ],
        ],
    ]); ?>
  </div>
    <?php 
   echo linkAjaxGridWidget::widget([
           'id'=>'widgetgridBancos',
            'idGrilla'=>'gridTraba',
            'family'=>'holas',
          'type'=>'POST',
           'evento'=>'click',
            //'foreignskeys'=>[1,2,3],
        ]); 
   ?>
    <?php Pjax::end(); ?>
</div>
     </div>
</div>