<?php
USE frontend\modules\inter\Module as m;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use common\widgets\buttonajaxwidget\buttonAjaxWidget;
$persona=$model->persona;
$this->title = m::t('labels', 'File candidate: {name}', [
    'name' => $persona->fullName(),
]);
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Candidates'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Programa'), 'url' => ['update', 'id' => $modelTallerdet->talleres_id]];
$this->params['breadcrumbs'][] = m::t('labels', 'File');
?>
<?php
echo \common\widgets\spinnerWidget\spinnerWidget::widget();
?>
<h4><span class="fa fa-calendar"></span><?='   '.\yii\helpers\Html::encode(yii::t('sta.labels','File')).'-'.$persona->fullName() ?></h4>
<div class="box box-success">


     <div class="col-md-12">
    <div class="btn-group">   
          <?php //$url=\yii\Helpers\Url::toRoute(['/sta/alumnos/retira-del-programa','id'=>$modelTallerdet->id]);  ?>      
              <?php //\yii\Helpers\Html::a('<span class="fa fa-file-pdf" ></span>'.'  '.yii::t('sta.labels','Retirar Alumno'),$url,['target'=>'_blank','data-pjax'=>'0','class'=>"btn btn-danger"])?>
            
     </div>            
    </div>
   
    
    <?php 
    $gridName='grillapk';
        Pjax::begin(['id'=>'grillapk','timeout'=>false]);
    ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group no-margin"> 
                 <?php    if($model->isHabilToIngresar())
                    echo Html::button('<span class="fa fa-check"></span>   '.m::t('labels', 'Final approval'), ['id'=>'btn-admision','class' => 'btn btn-success']);
                 ?>
                <?php  if(!$model->isAdmitido() && !$model->isEliminado())     
                    echo  Html::button('<span class="fa fa-user-times"></span>   '.m::t('labels', 'General disapproval'), ['id'=>'btn-admision','class' => 'btn btn-danger'])
                 ?>
                
                </div>
          
    </div>
    
    <?php echo buttonAjaxWidget::widget(
       [  
            'id'=>'btn-admision',
            'idGrilla'=>'grillapk',
            'ruta'=>Url::to(['/inter/convocados/admitir-postulante','id'=>$model->id]),          
           //'posicion'=> \yii\web\View::POS_END           
        ]  
   );   ?> 
 <?php echo buttonAjaxWidget::widget(
       [  
            'id'=>'btn-rechazo',
            'idGrilla'=>$gridName,
            'ruta'=>Url::to(['/inter/convocados/cancelar-postulante','id'=>$model->id]),          
           //'posicion'=> \yii\web\View::POS_END           
        ]  
   );   ?>  
    
    
   <?php Pjax::end();  ?>
    <br>  <br>  <br>
<?php

 echo $this->render('_alu_basico',
               ['model' =>$model ,'persona'=>$persona,'identidad'=>$identidad
                ]);

?>
<div style='overflow:auto;'>
<?php 
Pjax::begin(['id'=>'grillaexpedientes','timeout'=>false]);
  echo GridView::widget([
        'dataProvider' => NEW \yii\data\ActiveDataProvider([
            'query'=> \frontend\modules\inter\models\InterExpedientes::find()
                ->andWhere(['convocado_id'=>$model->id]),
        ]),
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
        //'filterModel' => $searchModel,
        'columns' => [
            
         
         [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{attach}',
                'buttons' => [
                    'update' => function($url, $model) { 
                        $url=Url::to(['/inter/expedientes/update','id'=>$model->id]);
                        $options = [
                           'data-pjax'=>'0',
                            'target'=>'_blank',
                            'title' => Yii::t('base.verbs', 'Update'),                            
                        ];
                        return Html::a('<span class="btn btn-success btn-sm glyphicon glyphicon-pencil"></span>', $url, $options/*$options*/);
                         },
                          'view' => function($url, $model) {                        
                        $options = [
                            'title' => Yii::t('base.verbs', 'View'),                            
                        ];
                        return Html::a('<span class="btn btn-warning btn-sm glyphicon glyphicon-search"></span>', $url, $options/*$options*/);
                         },
              'attach' => function($url, $model) {  
                         if($model->hasAttachments()){
                         $url=\yii\helpers\Url::toRoute(['/finder/selectimage',
                             'isImage'=>false,
                             'idModal'=>'imagemodal',
                             'modelid'=>$model->id,
                             'extension'=> \yii\helpers\Json::encode(['png','jpg','jpeg','doc','docx','docxx','pdf']),
                             'nombreclase'=> str_replace('\\','_',get_class($model))]);
                        $options = [
                            'title' => Yii::t('base_labels', 'Manage Files'),
                            //'aria-label' => Yii::t('rbac-admin', 'Activate'),
                            //'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                            'data-method' => 'get',
                            //'data-pjax' => '0',
                        ];
                        return Html::button('<span class="glyphicon glyphicon-paperclip"></span>', ['href' => $url, 'title' => 'Attach', 'class' => 'botonAbre btn btn-danger']);
                        //return Html::a('<span class="btn btn-success glyphicon glyphicon-pencil"></span>', Url::toRoute(['view-profile','iduser'=>$model->id]), []/*$options*/);
                         }else{
                             return '';
                         }
                        
                                 },
                    ]
                ],
         ['attribute'=>'estado',
                    'format'=>'raw',
                    'value'=>function($model){
                        if($model->estado)
                        return '<i style="color:#60a917;font-size:18px;"><span class="fa fa-check"></span></i>';
                        return '';
                    }
                    ],
          ['attribute'=>'documento',
                    'format'=>'raw',
                    'value'=>function($model){
                     $url=Url::to(['/inter/expedientes/update','id'=>$model->id]);
                     $options=['data-pjax'=>'0','target'=>'_blank'];
                     
                       return Html::a($model->documento->desdocu,$url,$options);
                    },
               'group'=>true,
                 //'contentOptions' => ['style' => 'width:200px;'], 
                 // 'headerOptions' => ['style' => 'width:20%'],
                    ],                  
       /*  ['attribute'=>'etapa',
                    'format'=>'raw',
                    'value'=>function($model){
                       return $model->etapa->descripcion;
                    },
                            
               'group'=>true,
                 //'contentOptions' => ['style' => 'width:200px;'], 
                 // 'headerOptions' => ['style' => 'width:20%'],
                    ], */
             ['attribute'=>'Dpto',
                    'format'=>'raw',
                    'value'=>function($model){
                       return $model->plan->eval->depa->nombredepa;
                    },
               'group'=>true,
                 //'contentOptions' => ['style' => 'width:200px;'], 
                 // 'headerOptions' => ['style' => 'width:20%'],
                    ], 
        ['attribute'=>'Eval',
                    'format'=>'raw',
                    'value'=>function($model){
                       return '<span class="fa fa-user"></span>'.'   '.$model->plan->eval->trabajador->ap;
                    },
               'group'=>true,
                 //'contentOptions' => ['style' => 'width:200px;'], 
                 // 'headerOptions' => ['style' => 'width:20%'],
                    ], 
         //'documento.desdocu',
         //'etapa.descripcion',
        // 'plan.eval.depa.nombredepa',
         //'plan.eval.trabajador.ap',
                
                            
            //'modo_id',
            //'convocado_id',
            //'clase',
            //'status',
            //'codocu',
            //'fpresenta',
            //'fdocu',
            //'detalles:ntext',
            //'textointerno:ntext',
            //'estado',
            //'requerido',
            //'plan_id',
            //'orden',
            //'etapa_id',
            //'secuencia',
            //'current_etapa',

          
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

     
</div>
    
