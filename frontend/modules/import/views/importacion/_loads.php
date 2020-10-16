<?php use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use frontend\modules\import\ModuleImport as m;
?>
<div style='overflow:auto;'>
     <?php Pjax::begin(['id'=>'grilla-cargas']); ?>
    <?= GridView::widget([
        'id'=>'grillax-cargax',
        'dataProvider' => $dataProvider,
         'summary' => '',
         'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
      //  'filterModel' => $searchModel,
        'columns' => [
             'id',
             [
                'class' => 'yii\grid\ActionColumn',
                //'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
            'template' => '{attachCarga}{upload}{try}',
               'buttons' => [
                    'attachCarga' => function($url, $model) {  
                         $url=\yii\helpers\Url::toRoute(['/finder/selectimage','extension'=>'csv','isImage'=>false,'idModal'=>'imagemodal','modelid'=>$model->id,'nombreclase'=> str_replace('\\','_',get_class($model))]);
                        $options = [
                            'title' => m::t('labels', 'Upload file'),
                            //'aria-label' => Yii::t('rbac-admin', 'Activate'),
                            //'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                            'data-method' => 'get',
                            //'data-pjax' => '0',
                        ];
                        return Html::button('<span class="glyphicon glyphicon-paperclip"></span>', ['href' => $url, 'title' => 'Editar Adjunto', 'class' => 'botonAbre btn btn-success']);
                        //return Html::a('<span class="btn btn-success glyphicon glyphicon-pencil"></span>', Url::toRoute(['view-profile','iduser'=>$model->id]), []/*$options*/);
                     
                        
                        },
                        'try' => function ($url,$model) {
			    $url = Url::toRoute([$this->context->id.'/import','id'=>$model->id,/*'verdadero'=>'1',*/]);
                             return Html::a('<span class="btn btn-warning btn-sm glyphicon glyphicon-cog"></span>', '#', ['title'=>$url,/*'id'=>$model->codparam,*/'family'=>'holas','id'=> \yii\helpers\Json::encode(['id'=>$model->id,'modelito'=> str_replace('@','\\',get_class($model))]),/*'title' => 'Borrar'*/]);
                            },
                        
                        'upload' => function ($url,$model) {
			    $url = Url::toRoute([$this->context->id.'/import','id'=>$model->id,'verdadero'=>'1']);
                             return Html::a('<span class="btn btn-info btn-sm glyphicon glyphicon-upload"></span>', '#', ['title'=>$url,/*'id'=>$model->codparam,*/'family'=>'holas','id'=> \yii\helpers\Json::encode(['id'=>$model->id,'modelito'=> str_replace('@','\\',get_class($model))]),/*'title' => 'Borrar'*/]);
                            }
                    ]
                ],
            [ 'attribute' => 'hasFile',
               'headerOptions' => ['style' => 'width:10%'],
                'format' => 'raw',
                'value' =>  function ($model, $key, $index, $column){
                        //$options=['width' => '40','height' => '42','class'=>"img-thumbnail"];
                 $cad=($model->activo==$model::STATUS_CARGADO)?'<span style="font-size:16px;" class="glyphicon glyphicon-check"></span>':'';      
        return ($model->hasAttachments())?Html::a('<span class="glyphicon glyphicon-save"></span>',$model->urlFirstFile,['data-pjax'=>'0']).$cad:
            '<span class="glyphicon glyphicon-folder-open"></span>';
                       
              },
            ],
              
                      
                      'activo',   
            'descripcion',
           // 'fechacarga',
           [
    'attribute' => 'tienecabecera',
    'format' => 'raw',
    'value' => function ($model) {
        return \yii\helpers\Html::checkbox('tienecabecera[]', $model->tienecabecera, [ 'disabled' => true]);

             },

          ],
            //'duracion',
         
                               [
    'attribute' => 'estricto',
    'format' => 'raw',
    'value' => function ($model) {
        return \yii\helpers\Html::checkbox('estricto[]', $model->estricto, [ 'disabled' => true]);

             },

          ],
           
        ],
    ]); ?>
    
   
     


<?php
     echo linkAjaxGridWidget::widget([
           'id'=>'mifpapay67xfx',
            'idGrilla'=>'grillax-cargax',
            'divReplace'=>'div_carga_reflejo',
            'family'=>'holas',
             'mode'=>'html',
          'type'=>'GET',
           'evento'=>'click',
            //'foreignskeys'=>[1,2,3],
        ]); 
    ?>
 
    <?php Pjax::end(); ?> 
    
 
   <?= Html::buttonInput(m::t('labels','Create load'), ['id'=>'btn-carga-nueva','class' => 'btn btn-info']) ?> 
    
</div>
<?php 
  $this->registerJs("$('#btn-carga-nueva').on( 'click', function() { 
        
            $.ajax({
              url: 'new-carga', 
              type: 'POST',
              data:{identidad:".$model->id."},
              dataType: 'json',        
            // beforeSend: function() {  
            // return confirm('Are you Sure to Delete this Record ?');
                      //  },
               error:  function(xhr, textStatus, error){               
                            var n = Noty('id');                      
                              $.noty.setText(n.options.id, error);
                              $.noty.setType(n.options.id, 'error');       
                                }, 
              success: function(json) {
              
               //alert(typeof json['dfdfd']==='undefined');
                        var n = Noty('id');
                       if ( typeof json['error']==='undefined' ) {
                        $.pjax({container: '#grilla-cargas'});
                             $.noty.setText(n.options.id, json['success']);
                             $.noty.setType(n.options.id, 'success'); 
                            
                            }else{
                            $.noty.setText(n.options.id,'<span class=\'glyphicon glyphicon-trash\'></span>      '+ json['error']);
                              $.noty.setType(n.options.id, 'error');  
                            }
                   
                        }
                        });  })", View::POS_READY);
?>

<?php 
  $this->registerJs("$('.carga-boton-ajax').on( 'click', function() { 
      //alert(this.id);
      $.ajax({
              url: '".Url::to(['importar'])."', 
              type: 'get',
              data:{id:this.id,verdadero:0},
              dataType: 'html', 
              error:  function(xhr, textStatus, error){               
                            var n = Noty('id');                      
                              $.noty.setText(n.options.id, error);
                              $.noty.setType(n.options.id, 'error');       
                                }, 
              success: function(data) {
              $('#resultados-carga-ajax').html(data);
                   
                        }
                        });


              
             })", View::POS_READY);
?>


 
    

    
  