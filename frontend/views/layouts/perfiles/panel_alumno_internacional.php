<?php

use frontend\views\layouts\perfiles\alumnoAsset;
use common\helpers\h;
use conquer\jvectormap\JVectorMapWidget;
use conquer\jvectormap\JVectorMapAsset;

use yii\helpers\Html;
use yii\helpers\Url;
//use frontend\modules\inter\Module as m;
alumnoAsset::register($this);
?>
<h4><?= h::awe('user') . h::space(10) . $identidad->fullName(false, true, '-') ?></h4>
<div class="box box-success">
    <div class="box-body">

        <?PHP
        //var_dump($identidad->id,$identidad->currentConvocatoria());die();
        $convocatoria = $identidad->currentConvocatoria();
        $esPostulanteInternacional = (is_null($convocatoria)) ? false : true;
        if (!$esPostulanteInternacional) {
        ?>
            <?php echo $this->render('alumno_sin_convocar') ?>
            <?php  ?>
        <?php } else {
            $isAdmitido = $convocatoria->isAdmitido();
            $targetUniversidad = $convocatoria->targetUniversity();
            if (is_null($targetUniversidad)) {
                $univdestino = $convocatoria->universidad;
            } else {
                $univdestino = $targetUniversidad->univop;
            }
        ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <?php
                    echo \common\widgets\imagerenderwidget\imageRenderWidget::widget(
                        [

                            'src' => $identidad->image($identidad->code()),
                        ]
                    ); ?>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <?php if (!$isAdmitido) {  ?>
                        <div style=" padding:7px;text-align:justify;color:#999;">
                            Bienvenido al panel del postulante. Sigue las instrucciones
                            que se indican para completar el proceso de admisión.
                            ¡Te deseamos éxito...!
                        </div>
                    <?php  }  ?>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <?php
                    var_dump( $convocatoria->universidad);/*
                    echo \common\widgets\imagerenderwidget\imageRenderWidget::widget(
                        [

                            'src' => \frontend\modules\inter\helpers\FileHelper::urlFlag($univdestino->codpais, 64),
                        ]
                    );*/

                    ?>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <?php if ($univdestino->hasAttachments())
                        echo Html::img($univdestino->files[0]->url, ['width' => 200, 'height' => 100,]);
                    ?>

                </div>

            </div>

            <!-- CONDICION PARA VER AUN NO ESTA ADMITIDO -->
            <?php if (!$isAdmitido) {   ?>


                <?php
                //var_dump($identidad->currentConvocatoria());die();
                //echo $this->render('@frontend/modules/inter/views/convocados/_progress_convocado',['identidad'=>$identidad]);




                $etapas = $convocatoria->modo->getEtapas()->orderBy(['orden' => SORT_ASC])->asArray()->all();
                $steps = [];
                foreach ($etapas as $etapa) {
                    $steps[$etapa['orden']] = [
                        'title' => $etapa['descripcion'],
                        'icon' => 'fa fa-' . $etapa['awe'],
                        'content' => '<h4>' . $etapa['descripcion'] . '</h4><br><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert alert-info">' . $etapa['comentarios'] . '</div>' . $this->render(
                            '_etapa_' . $etapa['orden'],
                            [
                                'identidad' => $identidad,
                                'convocatoria' => $convocatoria,
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-gray-light">
                    <?= \drsdre\wizardwidget\WizardWidget::widget($wizard_config); ?>
                </div>

            <?PHP  } else { ?>

                <?php $this->registerCssFile($this->registerCssFile(
                    '/frontend/views/layouts/perfiles/css/welcome-inter.css',
                    [
                        'depends' => [yii\bootstrap\BootstrapAsset::className()],
                        'media' => 'print',
                    ],
                    'css-print-theme'
                ));
                ?>
                <!-- NUEVO CSS -->
                <link rel="stylesheet" href="css/welcome-inter.css">



                <!-- Primer contenedor -->
                <div class="container-fluid">
                    <div class="row cab_user">
                        <div class="col-md-6 centrav">
                            <div class="nom_user">
                                <i class="fa fa-user" aria-hidden="true"></i><?= $identidad->fullName() ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 text-right">
                            <?= Html::img("@frontend/web/img/modules/inter/welcome/images/logo-inter.svg", []) ?>

                        </div>
                    </div>
                </div>
                <!-- Segundo contenedor -->
                <div class="container-fluid bg-cl-welcome">
                    <div class="row cab_tit">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <table width="100%">
                                <tr>
                                    <td width="120px">
                                        <div class="foto_user"><?= Html::img("@web/img/modules/inter/welcome/images/ico-user.jpg", []) ?></div>
                                        <div class="bandera"><?= Html::img("@web/img/modules/inter/welcome/images/ico-flag.jpg", []) ?></div>
                                    </td>
                                    <td width=""> <strong>!FELICITACIONES!</strong><br> Has sido admitido en el programa de Internacional 2021-I</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 text-right img_uni">

                        </div>
                    </div>
                    <div class="container-fluid cont-welcome" style="background-image:url(<?= yii::getAlias("@web/img/modules/inter/welcome/images/fondo-welcome-inter.jpg") ?>)">
                        <div class="row tits">
                            <div class="tit-welcome">Internacional</div>
                            <div class="subtit-welcome">Bienvenido al Sistema</div>
                            <div class="linea-tit"></div>
                            <div class="botonera">
                                <a href="#">
                                    <div class="enlace-welcome btn-enlace">> Eventos</div>
                                </a>
                                <a href="#">
                                    <div class="enlace-welcome btn-enlace">> Invitaciones</div>
                                </a>
                                <a href="#">
                                    <div class="enlace-welcome btn-enlace">> Programas</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

        <?PHP  }
        } ?>

        <br>

    </div>
</div>