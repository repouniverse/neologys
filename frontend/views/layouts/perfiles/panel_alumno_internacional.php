<?php
use frontend\views\layouts\perfiles\alumnoAsset;
use common\helpers\h;
use conquer\jvectormap\JVectorMapWidget;
use yii\helpers\Html;
use frontend\modules\inter\Module as m;
alumnoAsset::register($this);
?>
 <div class="box box-success">
    <div class="box-body">
      
      
        <div  class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?= \common\widgets\userwidget\userWidget::widget(['size'=>100,
                                'orientacion'=>'vertical','longName'=>true])  ?>
         </div>
         <div  class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <div class="small-box bg-green-gradient">
            <div class="inner">
              <h3><?php echo "saludo" ?></h3>

              <p>Periodo promedio (días)</p>
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
         <div  class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
           <div class="small-box bg-yellow-gradient">
            <div class="inner">
              <h3><?php echo "saludo" ?></h3>

              <p>Periodo promedio (días)</p>
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
       
    

<?php
$wizard_config = [
	'id' => 'stepwizard',
	'steps' => [
		1 => [
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
		2 => [
			'title' => 'Step 2',
			'icon' => 'fa fa-folder-open',
			'content' => '<h3>Step 2</h3>This is step 2',
			'skippable' => true,
		],
		3 => [
			'title' => 'Step 3',
			'icon' => 'fa fa-comments',
			'content' => '<h3>Step 3</h3>This is step 3',
		],
	],
	'complete_content' => "You are done!", // Optional final screen
	'start_step' => 2, // Optional, start with a specific step
];
?>
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-gray-light">
            <h4><?=h::awe('forward').yii::t('base_labels','Assessment progress')?></h4>
<?= \drsdre\wizardwidget\WizardWidget::widget($wizard_config); ?>  
        </div>
      

   <div class="map-container">
    <div id="world-map" class="jvmap-smart">   
<?= JVectorMapWidget::widget([
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
]); ?>
    
        
        
        
        
        
        <br>
     
</div>
</div>
</div>
</div>