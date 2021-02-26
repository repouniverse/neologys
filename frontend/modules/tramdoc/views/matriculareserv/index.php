<?php

use yii\helpers\Json;
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use yii\widgets\Pjax;
use common\helpers\h;
use Carbon\Carbon;
use frontend\modules\tramdoc\models\TramdocFilesReserv;
 
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\tramdoc\models\MatriculareactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

const DOCU_COMPROBANTE_PAGO_ADJUNTO='211';
const DOCU_SOLICITUD_REGISTRADA_ADJUNTO='235';

echo \common\widgets\spinnerWidget\spinnerWidget::widget();
$this->title = Yii::t('base_labels', 'Seguimiento de Reserva de Matrículas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matriculareact-index">
    <h4><?= h::awe('list') . h::space(10) . Html::encode($this->title) ?></h4>
    <div class="box">
        <div class="box-body">
        <?php Pjax::begin(); ?>
        <?php echo $this->render('_search_index', ['model' => $searchModel]); ?>

        
        <?php 
            if(sizeof($docsMat)!=0 && $trabajador->depa_id == h::getDepartamendoIdByCoddepa('OTI-FCCTP')){
                
                $url = Url::toRoute(['/tramdoc/matriculareserv/ajax-docs-tram-reserv']);
                echo  Html::a(Yii::t('base_labels', 'GENERAR ARCHIVOS'),$url, ['class' => 'btn btn-danger btn-block']);
                //echo Html::a('<span class="btn btn-danger ">GENERAR ARCHIVOS</span>', 'javascript:void();', ['title' => $url, 'family' => 'holas']);
            }
        ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'beforeHeader' => [
                [
                    'columns' => [
                        ['' => ''],
                        ['content' => 'DATOS DE LA SOLICTUD', 'options' => ['colspan' => 6, 'class' => 'text-center']],
                        ['content' => 'CUENTAS CORRIENTES', 'options' => ['colspan' => 3, 'class' => 'text-center']],
                        ['content' => 'REG. ACADÉMICOS', 'options' => ['colspan' => 5, 'class' => 'text-center']],
                        
                    ],
                ]
            ],
            'columns' => [

                //'nro_matr',
                [
                    'columnKey' => 'id',
                    'class' => 'kartik\grid\ExpandRowColumn',
                    'width' => '50px',

                    'value' => function ($model, $key, $index, $column) {
                        return GridView::ROW_COLLAPSED;
                    },
                    'detail' => function ($model, $key, $index, $column) {
                        // $dataProvider= \frontend\modules\acad\models\AcadContenidoSyllabusSe
                        return $this->render('_expand_content_audit', [
                            'identidad_unidad' => $model->id,
                        ]);
                    },
                    'expandOneOnly' => true
                ],
                'codigo',
                [
                    'attribute' => 'carrera_id',
                    'label' => 'Carrera',
                    'value' => function ($model, $key, $index, $column) {
                        return h::nombreCarrera($model->carrera_id);
                    },

                ],
                //'carrera_id',
                'dni',
                'apellido_paterno',
                'apellido_materno',
                'nombres',

                //'email_usmp:email',
                //'email_personal:email',
                //'celular',
                //'telefono',
                //'mensaje:ntext',
                [
                    'attribute' => 'fecha_solicitud',
                    'format' => ['date', 'php:d/m/Y'], //.h::gsetting('timeBD','date'
                ],
                //'fecha_registro',
                [
                    'attribute' => 'cta_sin_deuda_pendiente_check',
                    'label' => 'Habilitado (Sin deuda pendiente)',
                    'value' => function ($model, $key, $index, $column) {
                        return $model->cta_sin_deuda_pendiente_check;
                    },

                ],
                //'cta_sin_deuda_pendiente_obs:ntext',
                'cta_pago_tramite_check',
                //'cta_pago_tramite_adjunto',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Adjunto  de Comprobante de Pago',
                    'template' => '{Pago}',
                    'buttons' => [
                        'Pago' => function ($url, $model) {
                            $archivo = TramdocFilesReserv::findOne(['matr_reserv_id' => $model->id, 'docu_id' => DOCU_COMPROBANTE_PAGO_ADJUNTO]);
                            //return Html::a('<span class="glyphicon glyphicon-save"></span>', $archivo->urlFirstFile, ['data-pjax' => '0']);
                            if(is_null($archivo)){
                                return "Sin archivo generado";
                            }
                            if ($archivo->hasAttachments()) {
                                return Html::a('<span class="glyphicon glyphicon-save"></span>', $archivo->urlFirstFile, ['data-pjax' => '0', 'class' => 'btn']);
                            } else {
                                return "Sin archivo.";
                            }
                        },
                    ],
                ],


                [
                    'attribute' => 'ora_soli_reg_check',
                    'label' => 'Solicitud Registrada',
                    'value' => function ($model, $key, $index, $column) {
                        return $model->ora_soli_reg_check;
                    },

                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Adjunto de Solicitud registrada',
                    'template' => '{Solicitud}',
                    'buttons' => [
                        'Solicitud' => function ($url, $model) {
                            $archivo = TramdocFilesReserv::findOne(['matr_reserv_id' => $model->id, 'docu_id' => DOCU_SOLICITUD_REGISTRADA_ADJUNTO]);
                            //return Html::a('<span class="glyphicon glyphicon-save"></span>', $archivo->urlFirstFile, ['data-pjax' => '0']);
                            if(is_null($archivo)){
                                return "Sin archivo generado";
                            }
                            if ($archivo->hasAttachments()) {
                                return Html::a('<span class="glyphicon glyphicon-save"></span>', $archivo->urlFirstFile, ['data-pjax' => '0', 'class' => 'btn']);
                            } else {
                                return "Sin archivo.";
                            }
                        },
                    ],
                ],

                [
                    'attribute' => 'estado',
                    'label' => 'Estado Trámite',
                    'value' => function ($model, $key, $index, $column) {
                        return h::nombreEstado($model->estado);
                    },
                    'contentOptions' => function ($model, $key, $index, $column){
                        if(h::nombreEstado($model->estado) == 'PENDIENTE'){
                            return ['style'=> 'background-color:#ff3f3a; color: white'];
                        }
                        if(h::nombreEstado($model->estado) == 'EN-TRAMITE'){
                            return ['style'=> 'background-color:#f89828; color: white'];
                        }
                        if(h::nombreEstado($model->estado) == 'FINALIZADO'){
                            return ['style'=> 'background-color:#03cea4; color: white'];
                        }
                        if(h::nombreEstado($model->estado) == 'NO-PROCEDE'){
                            return ['style'=> 'background-color:gray; color: white'];
                        }
                    }
                ],
                

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update}{view}',
                    'buttons' => [
                        'update' => function($url, $model) {
                            $url=Url::to(['update','id'=>$model->id]);
                            $options = [
                                'title' => yii::t('base_verbs', 'Update'), 'data-pjax'=>'0'
                            ];
                            return Html::a('<span class="btn btn-success btn-sm glyphicon glyphicon-pencil"></span>', $url, $options/*$options*/);
                        },
                        'view' => function($url, $model) {
                            $url=Url::to(['view','id'=>$model->id]);
                            $options = [
                                'title' => yii::t('base_verbs', 'View'), 'data-pjax'=>'0'
                            ];
                            return Html::a('<span class="btn btn-warning btn-sm glyphicon glyphicon-search"></span>', $url, $options/*$options*/);
                        },

                    ]
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
        </div>
    </div>