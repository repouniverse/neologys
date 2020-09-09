<?php
use frontend\views\layouts\perfiles\alumnoAsset;
use common\helpers\h;
use conquer\jvectormap\JVectorMapWidget;
use yii\helpers\Html;
use frontend\modules\inter\Module as m;
alumnoAsset::register($this);
?>
<h4><?=h::awe('user').h::space(10).$identidad->fullName(false,true, '-')?></h4>
 <div class="box box-success">
    <div class="box-body">
      
      
        <div  class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?= \common\widgets\userwidget\userWidget::widget(['size'=>100,
                                'orientacion'=>'vertical','longName'=>true])  ?>
         </div>
         <div  class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <div class="small-box bg-green-gradient">
            <div class="inner">
              <h3><?php 
              $convocatoria=$identidad->currentConvocatoria();
              echo $convocatoria->modo->getPlanes()->andWhere(['ordenetapa'=>$convocatoria::STAGE_UPLOADS])->count(); ?></h3>

              <p><?php echo yii::t('base_labels','Files uploaded') ?></p>
            </div>
            <div class="icon">
                <span style="color:white;opacity:0.5;"><i class="fa fa-file"></i></span>
            </div>
            <?php 
            //$url=Url::to(['cantidades-en-riesgo']);
            echo Html::a(yii::t('base_labels','Detalles').'<i class="fa fa-arrow-circle-right"></i>','trtr', ['class'=>"botonAbre small-box-footer"]);
            ?>
            
          </div>
         </div>
         <div  class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
           <div class="small-box bg-yellow-gradient">
            <div class="inner">
              <h3><?php 
              $lleno=$convocatoria->hasFillFicha();
              echo ($lleno)?"<span class='fa fa-ok'></span>":"<span class='fa file'></span>"?></h3>

              <p><?php 
              $lleno=$convocatoria->hasFillFicha();
              echo ($lleno)?yii::t('base_labels','Ficha completa'):yii::t('base_labels','Falta llenar tu Ficha') ?></p>
            </div>
            <div class="icon">
                <span style="color:white;opacity:0.5;"><i class="fa fa-user"></i></span>
            </div>
            <?php 
            //$url=Url::to(['cantidades-en-riesgo']);
            echo Html::a(yii::t('base_labels','Detalles').'<i class="fa fa-arrow-circle-right"></i>','trtr', ['class'=>"botonAbre small-box-footer"]);
            ?>
            
          </div>
         </div>
       
    

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
	'complete_content' => "You are done!", // Optional final screen
	'start_step' => $convocatoria->currentStage(), // Optional, start with a specific step
];
?>
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-gray-light">
            <h4><?=h::awe('forward').yii::t('base_labels','Assessment progress')?></h4>
<?= \drsdre\wizardwidget\WizardWidget::widget($wizard_config); ?>  
        </div>
      

   <div class="map-container">
    <div id="world-map" class="jvmap-smart">   
<?php /*echo JVectorMapWidget::widget([
    //'id'=>'map1',
    'map'=>'world_mill_en',
    
    'options'=>[
        'backgroundColor'=>'#c3eaea',
        'width'=>'600',
        'height'=>'400'
        ],
    
    'htmlOptions'=>[
        'id'=>'map1',
                ],
]);*/ ?>
    
        
        
        
        
        
        <br>
     
</div>
</div>
</div>
</div>


