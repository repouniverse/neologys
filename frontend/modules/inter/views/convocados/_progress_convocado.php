<?php
use common\helpers\h;
use frontend\modules\inter\Module as m;
//use Yii;
//var_dump($identidad->currentConvocatoria());die();

$convocatoria=$identidad->currentConvocatoria();
$etapas=$convocatoria->modo->getEtapas()->orderBy(['orden'=>SORT_ASC])->asArray()->all();
$steps=[];
foreach($etapas as $etapa){
    $steps[$etapa['orden']]=[  'title' => $etapa['descripcion'],
                'icon' => 'fa fa-'.$etapa['awe'],
                'content' =>'<h4>'.$etapa['descripcion'],
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
            <h4><?=h::awe('forward').m::t('labels','Assessment progress')?></h4>
<?= \drsdre\wizardwidget\WizardWidget::widget($wizard_config); ?>  
        </div>
