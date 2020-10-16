<?php
use frontend\views\layouts\perfiles\alumnoAsset;
//use frontend\modules\inter\Module as m;
use common\helpers\h;
use frontend\modules\inter\components\Metricas;
//use frontend\modules\inter\Module as m;
use frontend\modules\inter\models\InterExpedientesSearch;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use conquer\jvectormap\JVectorMapWidget;
use yii\helpers\Html;
 use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
alumnoAsset::register($this);

?>
  <?php echo \common\widgets\spinnerWidget\spinnerWidget::widget(); ?>  
<h4><i style="font-size:30px;"><?=h::awe('calendar').'</i>'.h::space(10).yii::t('base_labels','Welcome to International Module').h::space(10).$identidad->fullName()?></h4>
<div class="box box-success">
  <div class="box-body">  
<div class="row">
       <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <div class="small-box bg-green-gradient">
            <div class="inner">
                <h3><?= Metricas::nConvocados()?></h3>

              <p><?php echo yii::t('base_labels','Summoneds') ?></p>
            </div>
            <div class="icon">
                <span style="color:white;opacity:0.5;"><i class="fa fa-users"></i></span>
            </div>
            <?php 
            //$url=Url::to(['cantidades-en-riesgo']);
            echo Html::a(yii::t('base_labels','Details').'<i class="fa fa-arrow-circle-right"></i>','trtr', ['class'=>"botonAbre small-box-footer"]);
            ?>
            
          </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">  
           <div class="small-box bg-yellow-gradient">
            <div class="inner">
                <h3><?= Metricas::nExpedientes()?></h3>

              <p><?php 
            
              echo yii::t('base_labels','Files') ?></p>
            </div>
            <div class="icon">
                <span style="color:white;opacity:0.5;"><i class="fa fa-folder-open"></i></span>
            </div>
            <?php 
            //$url=Url::to(['cantidades-en-riesgo']);
            echo Html::a(yii::t('base_labels','Details').'<i class="fa fa-arrow-circle-right"></i>',Url::to(['/inter/programa']), ['class'=>"small-box-footer"]);
            ?>
            
          </div>
         </div> 
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">  
             <div class="small-box bg-light-blue">
            <div class="inner">
                <h3><?= Metricas::nEntrevistas()?></h3>

              <p><?php 
            
              echo yii::t('base_labels','Interviews') ?></p>
            </div>
            <div class="icon">
                <span style="color:white;opacity:0.5;"><i class="fa fa-history"></i></span>
            </div>
            <?php 
            //$url=Url::to(['cantidades-en-riesgo']);
            echo Html::a(yii::t('base_labels','Details').'<i class="fa fa-arrow-circle-right"></i>','trtr', ['class'=>"botonAbre small-box-footer"]);
            ?>
            
          </div>
        </div>     
</div>        
             
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     
       <?php
       $ajaxIdentidad='PjaxIndentidad';
       Pjax::begin(['id'=>$ajaxIdentidad]);            
            $gridColumns=[   
                                [
                'class' => 'yii\grid\ActionColumn',
                //'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
            'template' => '{asistencia}',
               'buttons' => [
                   
                    'rescue' => function ($url,$model) {
                       // if(!empty($model->numerocita)){
                            $url = Url::toRoute(['/sta/citas/rescue-token','id'=>$model->codalu]);
                              return Html::a('<span class="btn btn-info glyphicon glyphicon-log-in"></span>', 'javascript:void();', ['id'=>$model->id,'title'=>$url,'family'=>'holas']);
                       
                        /*}else{
                             return '';
                        }*/
                           
                           
			 
			   }, 
                   
                   
                        'delete' => function ($url,$model) {
                        /////if(!$model->asistio && empty($model->numerocita) && !$model->libre){
                            $url = Url::toRoute([$this->context->id.'/elimina-alumno','id'=>$model->id]);
                              return Html::a('<span class="btn btn-danger glyphicon glyphicon-trash"></span>', 'javascript:void();', ['id'=>$model->id,'title'=>$url,'family'=>'holas']);
                       
                        //}else{
                             //return '';
                        //}
			   }, 
                        'asistencia' => function ($url,$model) {
                        //if(!$model->asistio && !$model->libre){
                            $url = Url::toRoute(['/inter/convocados/ajax-aprove-expediente','id'=>$model->id]);
                              return Html::a('<span class="btn btn-success glyphicon glyphicon-ok"></span>', 'javascript:void();', ['id'=>$model->id,'title'=>$url,'family'=>'holas']);
                      
                       // }else{
                           // return '';
                        //}
                           
                            
			 
			     } ,
                         'cita' => function ($url,$model) {
                        //if($model->asistio && empty($model->numerocita) && !$model->libre ){
                           $url = Url::toRoute([$this->context->id.'/crea-cita','id'=>$model->id]);
                              return Html::a('<span class="btn btn-warning  glyphicon glyphicon-dashboard"></span>', 'javascript:void();', ['id'=>$model->id,'title'=>$url,'family'=>'holas']);
                        
                        /*}else{
                            return ''; 
                        }*/
                           
                           
			 
			    } ,
                               
                    ]
                ],
                             
                           [
                    'class' => 'kartik\grid\ExpandRowColumn',
                    'width' => '50px',
                    'value' => function ($model, $key, $index, $column)
                               {
                                return GridView::ROW_COLLAPSED;
                               },
                    /*'detail' => function ($model, $key, $index, $column) 
                                {
                                    return $this->render('@frontend/modules/inter/views/convocados/_expand_historial', ['model'=>$model,'datos'=>$model->datosExpedientes()]);
                                },*/
                          'detailUrl' =>Url::toRoute([
                                            '/inter/expedientes/ajax-show-adjunto']),
                      
                    //'headerOptions' => ['class' => 'kartik-sheet-style'], 
                    'expandOneOnly' => true
                    //'expandOneOnly' => true
                ],
                [
                            'attribute'=>'imagen',
                            'format'=>'raw',
                            'value'=>function($model){
                                   $postulante=$model->convocado->postulante;
                                return Html::img($model->image($postulante->{$postulante->nameFieldCode()}),['width'=>60,'height'=>80, 'class'=>"img-thumbnail cuaizquierdo"]);
                            }
                        ], 
                        ['attribute'=>yii::t('base_labels','Names'),
                                  'format'=>'raw',
                                    
                                  'value'=>function($model){
                                            $convocado=$model->convocado;
                                            $url=Url::to(['/inter/convocados/view','id'=>$convocado->id]);
                                            $options=['data-pjax'=>'0','target'=>'_target'];
                                      return Html::a($convocado->postulante->fullName(),$url,$options);
                                     
                                  },
                                  'group'=>true,
                                   //'header'=>'current_stage',
                                   //'group'=>true, 
                                 ],         
                        [
                            'attribute'=>'Documento',
                            'format'=>'raw',
                            'value'=>function($model){
                                   //$postulante=$model->convocado->postulante;
                               $enlace= $model->plan->documento->desdocu;
                               $url=Url::to(['/inter/expedientes/update','id'=>$model->id]);
                               return Html::a($enlace,$url,['data-pjax'=>'0','target'=>'_blank']);
                            }
                        ],
                               
                                
                        'plan.documento.desdocu',        
                       /*['attribute'=>'desdocu',
                                   //'header'=>''
                                    'group'=>true, 
                                     ],    */         
                   [
                            'attribute'=>'codigo',
                            'format'=>'raw',
                            'value'=>function($model){
                                   $postulante=$model->convocado->postulante;
                                return $postulante->{$postulante->nameFieldCode()};
                            }
                        ],  
                          
                           ['attribute'=>'Esp',
                              'value'=>function($model){
                                   //$postulante=$model->postulante;
                                return $model->convocado->postulante->carrera->codesp;
                              }
                                ],     
                                
                                
                           ['attribute'=>'descripcion',
                                   'value'=>function($model){
                                   //$postulante=$model->postulante;
                                return $model->modo->descripcion;
                            },
                                    'group'=>true, 
                                     ],
                              ['attribute'=>'current_etapa',
                                  'format'=>'raw',
                                  'value'=>function($model){
                                      return '<div class="circle-badge">'.$model->orden.'</div>';
                                  },
                                  
                                   //'header'=>'current_stage',
                                   //'group'=>true, 
                                 ],
                                
                                //'current_etapa',
                                 
                               // 'codigoper',
                                //'documento.desdocu',
                                //'numerodoc',
                                //'codgrupo',
                                //'id',
                                /*'universidad_id',
                                'facultad_id',
                                'depa_id',
                                'modo_id',*/
                            ];
            
            
            ?>
                
                              
        <?php $dataProvider =(new InterExpedientesSearch())->searchByPendienteByEvaluador($identidad->id); ?>
                
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  
                    <?=GridView::widget(
                        [
                            'dataProvider' => $dataProvider,
                            //'summary' => '',
                            'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
                          //  'filterModel' => $searchModel,
                            'columns' => $gridColumns,
                            
                        ]);
                    ?>
    
    <?php 
   echo linkAjaxGridWidget::widget([
           'id'=>'widgetgruidBancos',
            'idGrilla'=>$ajaxIdentidad,
            'family'=>'holas',
          'type'=>'POST',
           'evento'=>'click',
       'posicion'=>\yii\web\View::POS_END
            //'foreignskeys'=>[1,2,3],
        ]); 
   ?>
    
    
    
            <?php Pjax::end(); ?>
      
      
      
      
        
  
    </div> 
    <br>.<br><br>.<br><br>.<br><br>.<br>
  
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <?php $dataProvider =(new \frontend\modules\inter\models\InterExpedientesSearch())->searchByPendienteByEvaluador($identidad->id); ?>
        
       <div style='overflow:auto;'>
           <?php 
           /*$gridColumns=[   
                                
                           [
                    'class' => 'kartik\grid\ExpandRowColumn',
                    'width' => '50px',
                    'value' => function ($model, $key, $index, $column)
                               {
                                return GridView::ROW_COLLAPSED;
                               },
                    'detail' => function ($model, $key, $index, $column) 
                                {
                                    return $this->render('@frontend/modules/inter/views/convocados/_expand_historial', ['model'=>$model,'datos'=>$model->datosExpedientes()]);
                                },
                    'expandOneOnly' => true
                ],
                [
                            'attribute'=>'imagen',
                            'format'=>'raw',
                            'value'=>function($model){
                                return Html::img($model->image($model->codigodocente),['width'=>60,'height'=>80, 'class'=>"img-thumbnail cuaizquierdo"]);
                            }
                        ],   
                        
                       ['attribute'=>'desdocu',
                                   //'header'=>''
                                    'group'=>true, 
                                     ],                 
                   'codigodocente',  
                    'codesp',
                           ['attribute'=>'descripcion',
                                   //'header'=>''
                                    'group'=>true, 
                                     ],
                              ['attribute'=>'current_etapa',
                                  'format'=>'raw',
                                  'value'=>function($model){
                                      return '<div class="circle-badge">'.$model->current_etapa.'</div>';
                                  },
                                  
                                   //'header'=>'current_stage',
                                   //'group'=>true, 
                                 ],
                                 
                                ['attribute'=>yii::t('base_labels','Names'),
                                  //'format'=>'raw',
                                  'value'=>function($model){
                                      return $model->fullName();
                                  },
                                  
                                   //'header'=>'current_stage',
                                   //'group'=>true, 
                                 ],
                            ];
            
            
           
           
           
           
           
             echo GridView::widget(
                        [
                            'dataProvider' => $dataProvider,
                            //'summary' => '',
                            'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
                          //  'filterModel' => $searchModel,
                            'columns' => $gridColumns,
                            
                        ]);
           
           */
           ?>

         </div>
   </div>          
           
           
</div>
      
      
    
</div>
</div>