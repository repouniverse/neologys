<?php
use frontend\views\layouts\perfiles\alumnoAsset;
use common\helpers\h;

use yii\helpers\Url;
use conquer\jvectormap\JVectorMapWidget;
use conquer\jvectormap\JVectorMapAsset;
use yii\helpers\Html;
use common\models\masters\Universidades;
alumnoAsset::register($this);

?>
 
   
<?php 
$universidades= Universidades::find()->asArray()->all();
$marcadores=[];
foreach($universidades as $universidad){
    $elemento=[ 'latLng'=> [$universidad['latitud'], $universidad['meridiano']],
                'name'=> $universidad['nombre'],
                'href' => Url::to(['/maestros/default/view-univer',
                    'id'=>$universidad['id']])
                ];
    if($universidad['id']==h::user()->profile->universidad_id)
    $elemento['style']=['fill'=>'rgba(0,0,255,0.1)','r'=>20];
    
    $marcadores[]=$elemento;  
}
//var_dump($marcadores);die();
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
 
 
 
JVectorMapAsset::register($this);
JVectorMapAsset::registerMap('world_mill_en');
 $this->registerJs ("
     var markers=".$marcadores.";
    $(function(){
    $('#map1').vectorMap({  
              map:'world_mill_en',
              backgroundColor:'#d9dde2',
              markerStyle:{
                    //class:'botonAbre',
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

