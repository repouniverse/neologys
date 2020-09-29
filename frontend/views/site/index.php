<?php
use frontend\views\layouts\perfiles\alumnoAsset;
use common\helpers\h;
use lo\widgets\modal\ModalAjax;
use yii\helpers\Url;
use conquer\jvectormap\JVectorMapWidget;
use conquer\jvectormap\JVectorMapAsset;
use yii\helpers\Html;
alumnoAsset::register($this);

?>
    
<h4><i style="font-size:30px;"><?=h::awe('globe').'</i>'.h::space(10).yii::t('base_labels','Welcome to International Module')?></h4>
<div class="box body body-success">
<div class="row">
       <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <div class="small-box bg-green-gradient">
            <div class="inner">
              <h3>60</h3>

              <p><?php echo yii::t('base_labels','Students') ?></p>
            </div>
            <div class="icon">
                <span style="color:white;opacity:0.5;"><i class="fa fa-users"></i></span>
            </div>
            <?php 
            //$url=Url::to(['cantidades-en-riesgo']);
            echo Html::a(yii::t('base_labels','Detalles').'<i class="fa fa-arrow-circle-right"></i>','trtr', ['class'=>"botonAbre small-box-footer"]);
            ?>
            
          </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">  
           <div class="small-box bg-purple-gradient">
            <div class="inner">
              <h3>45</h3>

              <p><?php 
            
              echo yii::t('base_labels','Program') ?></p>
            </div>
            <div class="icon">
                <span style="color:white;opacity:0.5;"><i class="glyphicon glyphicon-scale"></i></span>
            </div>
            <?php 
            //$url=Url::to(['cantidades-en-riesgo']);
            echo Html::a(yii::t('base_labels','Detalles').'<i class="fa fa-arrow-circle-right"></i>',Url::to(['/inter/programa']), ['class'=>"small-box-footer"]);
            ?>
            
          </div>
         </div> 
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">  
             <div class="small-box bg-teal-gradient">
            <div class="inner">
              <h3>45</h3>

              <p><?php 
            
              echo yii::t('base_labels','Teachers') ?></p>
            </div>
            <div class="icon">
                <span style="color:white;opacity:0.5;"><i class="glyphicon glyphicon-list"></i></span>
            </div>
            <?php 
            //$url=Url::to(['cantidades-en-riesgo']);
            echo Html::a(yii::t('base_labels','Detalles').'<i class="fa fa-arrow-circle-right"></i>','trtr', ['class'=>"botonAbre small-box-footer"]);
            ?>
            
          </div>
        </div>     
</div>        
             
      





   
<?php 

$marcadores=[
      ['latLng'=> [36.7, -4.4], 'name'=> 'UNIVERSIDAD DE MÁLAGA','href' => Url::to(['/maestros/default/update-univer','id'=>3])],
      ['latLng'=> [41.3818, 2.1685], 'name'=> 'ESCUELA SUPERIOR DE RELACIONES PÚBLICAS','weburl' => Url::to(['/maestros/default/update-univer','id'=>2])],
      ['latLng'=> [7.12,-73.11], 'name'=> 'UNIVERSIDAD AUTÓNOMA DE BUCARAMANGA','weburl' => Url::to(['/maestros/default/update-univer','id'=>5])],
      ['latLng'=> [-34.53, -56.09], 'name'=> 'UNIVERSIDAD CATÓLICA DEL URUGUAY','weburl' => Url::to(['/maestros/default/update-univer','id'=>26])],
      ['latLng'=> [52.45, 9.23], 'name'=> 'UNIVERSIDAD DE LEUPHANA','weburl' => Url::to(['/maestros/default/update-univer','id'=>28])],        
      ['latLng'=> [23.63, -102.55], 'name'=> 'UNIVERSIDAD DE ANAHUAC','weburl' => Url::to(['/maestros/default/update-univer','id'=>10])],        
              
    
    ];
$options=[
        'backgroundColor'=>'#d9dde2;',
         'markerStyle'=>[
      'initial'=>[
        'fill'=> '#F8E23B',
        'stroke'=> '#383f47'
        ],
      ],
        'width'=>'600',
        'height'=>'600',
          'markers'=>$marcadores,
       // 'onMarkerClick'=>'{(event){alert("hola")}',
        ];

$marcadores=\yii\helpers\Json::encode($marcadores);
$cadena= \yii\helpers\Json::encode($options);
/*echo JVectorMapWidget::widget([
    //'id'=>'mapita1',
    'map'=>'world_mill_en',    
    'options'=>$options,    
    'htmlOptions'=>[
        'id'=>'map1',
                ],
]);*/ ?>
        <div class="map-container">
                <div id="world-map" class="jvmap-smart">   
                    <div id="map1">
                        
                    </div>
                </div>
        </div>
 <?php 
 
 echo ModalAjax::widget([
    'id' => 'modalMapa',
    'header' => 'Buscar Valor',
    'toggleButton' => false,
    //'mode'=>ModalAjax::MODE_MULTI,
    'size'=>\yii\bootstrap\Modal::SIZE_LARGE,    
    //'selector'=>'.jvectormap-marker',
   // 'url' => $url, // Ajax view with form to load
    'ajaxSubmit' => true, // Submit the contained form as ajax, true by default
    //para que no se esconda la ventana cuando presionas una tecla fuera del marco
    'clientOptions' => ['tabindex'=>'','backdrop' => 'static', 'keyboard' => FALSE]
    // ... any other yii2 bootstrap modal option you need
]);
 
JVectorMapAsset::register($this);
JVectorMapAsset::registerMap('world_mill_en');
 $this->registerJs ("
     var markers=".$marcadores.";
    $(function(){
    $('#map1').vectorMap({  
              map:'world_mill_en',
              backgroundColor:'#d9dde2',
              markerStyle:{
                    class:'botonAbre',
                    initial:{
                    fill:'#F8E23B',
                    stroke:'#383f47',
                    r:10,
                        },
                  hover: {
                    stroke: 'red',                    
                    cursor: 'pointer',
                    fill:'orange',
                        }      


                        },
               markers:markers,         

                  onMarkerClick: function(event, index) {                      
                      //alert(markers[index].weburl);
                     // alert('hola');
                                           
                                  $('#modalMapa').modal('show')
                                            //.find('.jvectormap-marker')
                                  .load(markers[index].weburl);
                                                   
                  
                   }//fin de onmARCKERcLICK
            });
        });
",\yii\web\View::POS_READY);     ?>       
        
        
        
        
        <br>
     

</div>