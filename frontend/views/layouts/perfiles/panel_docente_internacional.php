<?php
use frontend\views\layouts\perfiles\alumnoAsset;
use common\helpers\h;
use conquer\jvectormap\JVectorMapWidget;
use conquer\jvectormap\JVectorMapAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\modules\inter\Module as m;
alumnoAsset::register($this);
?>

<h4><?=h::awe('user').h::space(10).$identidad->fullName(false,true, '-')?></h4>
 <div class="box box-success">
    <div class="box-body">
      
     
      <?PHP  
      $convocatoria=$identidad->currentConvocatoria();
       $isAdmitido=$convocatoria->isAdmitido();
       $targetUniversidad=$convocatoria->targetUniversity();
       if(is_null($targetUniversidad)){
           
           $univdestino=$convocatoria->universidad; 
       }else{
          $univdestino=$targetUniversidad->univop;
       }
           
       
       ?>
        
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
             
              <div  class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <?php 
               echo \common\widgets\imagerenderwidget\imageRenderWidget::widget([
            
                'src'=>$identidad->image($identidad->code()),
                ]
                    ); ?>
              </div>
             <div  class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                 <?php if(!$isAdmitido) {  ?>
                 <div style=" padding:7px;text-align:justify;color:#999;">
                     Bienvenido al panel del postulante. Sigue las instrucciones
                     que se indican para completar el proceso de admisión.
                     ¡Te deseamos éxito...!
                 </div>
                 <?php  }  ?>
             </div>
             
              <div  class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <?php 
            echo \common\widgets\imagerenderwidget\imageRenderWidget::widget([
            
                'src'=>\frontend\modules\inter\helpers\FileHelper::urlFlag($univdestino->codpais, 64),
                ]
                    );
               
             ?>    
              </div>
            <div  class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
             <?php if($univdestino->hasAttachments())   
             echo Html::img($univdestino->files[0]->url,['width'=>200,'height'=>100,]);
             ?>
        
           </div>
           
       </div>
        
       <!-- CONDICION PARA VER AUN NO ESTA ADMITIDO -->
      <?php IF(!$isAdmitido){   ?>
        
        
        
       
    

<?php
//var_dump($identidad->currentConvocatoria());die();
 //echo $this->render('@frontend/modules/inter/views/convocados/_progress_convocado',['identidad'=>$identidad]);




$etapas=$convocatoria->modo->getEtapas()->orderBy(['orden'=>SORT_ASC])->asArray()->all();
$steps=[];
foreach($etapas as $etapa){
    $steps[$etapa['orden']]=[  'title' => $etapa['descripcion'],
                'icon' => 'fa fa-'.$etapa['awe'],
                'content' =>'<h4>'.$etapa['descripcion'].'</h4><br><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert alert-info">'.$etapa['comentarios'].'</div>'.$this->render('_etapa_'.$etapa['orden'],
                                [
                                    'identidad'=>$identidad,
                                    'convocatoria'=>$convocatoria,
                                ]
                     
                                         ),
             ];
}


$wizard_config = [
	'id' => 'stepwizard',
         'steps' => $steps,   
	/*'steps' => [
		0 => [
			'title' => 'Step 1',
			'icon' => 'fa fa-filter',
			'content' => '<h3>Step 1</h3>This is step 1',
			'buttons' => [
				'next' => [
					'title' => 'Forward', 
					'options' => [
						'class' => 'disabled'
					],
				 ],
			 ],
		],
		1 => [
			'title' => 'Step 2',
			'icon' => 'fa fa-folder-open',
			'content' => '<h3>Step 2</h3>This is step 2',
			'skippable' => true,
		],
		2 => [
			'title' => 'Step 3',
			'icon' => 'fa fa-comments',
			'content' => '<h3>Step 3</h3>This is step 3',
		],
	],*/
	'complete_content' => "", // Optional final screen
	'start_step' => $convocatoria->currentStage(), // Optional, start with a specific step
];
?>
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-gray-light">
            
<?= \drsdre\wizardwidget\WizardWidget::widget($wizard_config); ?>  
        </div>
    
      
      
      <!--    EN CASO DE QUE YA ESTE ADMITIDO MOSTRAR SU PANEL DE BIENVENIDA  -->
      
      
      <?PHP  } else{ ?>
      
      <DIV CLASS="aviso-info">
          <?=yii::t('base_labels','¡Felicitaciones...!. Has sido admitido en el programa de Internacional {periodo}',['periodo'=>h::periodos()->currentPeriod])?>
      </DIV>
      
      
      
   
     
<?php 
$marcadores=[
     ['latLng'=> [$univdestino->latitud, $univdestino->meridiano],
         'name'=> $univdestino->nombre,'weburl' => Url::to(['/maestros/default/update-univer','id'=>28])],        
             
    
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
                  
                   }//fin de onmARCKERcLICK
            });
        });
",\yii\web\View::POS_READY);     ?>       
        
        
        
        
        <br>
      
      
      
      
      
      
        
        
    <?PHP  } ?>     
        
        <br>
     
</div>
</div>

