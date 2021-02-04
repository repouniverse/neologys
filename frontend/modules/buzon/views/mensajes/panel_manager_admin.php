<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use frontend\modules\maestros\MaestrosModule as m;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use common\helpers\ComboHelper as combo;
use common\helpers\h;

const _URGENTE = 1;
const _PENDIENTE = 2;
const _PROCESO = 3;
const _ATENDIDO = 4;
echo \common\widgets\spinnerWidget\spinnerWidget::widget();
$this->title = yii::t('base_labels', 'Panel de Administrador Buzon');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="docentes-index">
    <h4> <?= Html::encode($this->title) ?> </h4>
    <div class="box box-success">
        <div class="box-body">
            <?php
            /*
                 $url= Url::toRoute(['/buzon/mensajes/modal-prueba','idModal'=>'buscarvalor']);
                 echo  Html::button(yii::t('base_verbs','Add Unit'), ['href' => $url, 'title' => yii::t('base_verbs','Add Unit'),'id'=>'btn_unidad', 'class' => 'botonAbre btn btn-success']); 
                 */
            ?>
            <?php Pjax::begin(['id' => 'gridTraba']); ?>
            <?php
            $id_pjax_sumilla = 'gridTraba';
            $depas = combo::getCboDepartamentosFacu(h::gsetting('general', 'MainFaculty'));
            $carreras = combo::getCboCarreras(h::gsetting('general', 'MainFaculty'));
            ?>
            <?php echo $this->render('_search_panel_manager_admin', ['model' => $searchModel]); ?>
            .

            <?= GridView::widget(
                [
                    'dataProvider' => $dataProvider,
                    //'filterModel'=>$searchModel,
                    'tableOptions' => ['class' => 'table table-condensed table-hover table-bordered table-striped'],
                    'columns' =>
                    [
                        
                        [
                            'columnKey'=>'buzon_mensaje_id',
                            'class' => 'kartik\grid\ExpandRowColumn',
                            'width' => '50px',
                            
                            'value' => function ($model, $key, $index, $column) {
                                return GridView::ROW_COLLAPSED;
                            },
                            'detail' => function ($model, $key, $index, $column) {                    
                                // $dataProvider= \frontend\modules\acad\models\AcadContenidoSyllabusSe  
                                return $this->render('modal_ver_mensajes_respuesta', [
                                    'identidad_unidad' => $model->buzon_mensaje_id,
    
                                ]);
                            
                            },
                            'expandOneOnly' => true
                        ],

                        [
                            'attribute' => 'carrera_id',
                            'filter' => $depas,
                            'group' => true,
                            'value' => function ($model) {
                                return $model->codesp;
                            }
                        ],
                        [
                            'attribute' => 'departamento_id',
                            'filter' => $depas,
                            'group' => true,
                            'value' => function ($model) {
                                return $model->nombredepa;
                            }
                        ],

                        'numerodoc',
                        'alumno_nombres',
                        'alumno_ap',
                        'alumno_am',
                        'fecha_registro',
                        [
                            'attribute' => 'estado',
                            'contentOptions' => function ($model, $key, $index, $column) {
                                if ($model->estado == _URGENTE) return ['style' => 'background-color: #FF3114 ; color:white'];
                                if ($model->estado == _PENDIENTE) return ['style' => 'background-color: orange ;'];
                                if ($model->estado == _PROCESO) return ['style' => 'background-color: #08a0ff; color:white'];
                                if ($model->estado == _ATENDIDO) return ['style' => 'background-color: #00b106;color:white'];
                            },
                            'value' => function ($model) {
                                if ($model->estado == _URGENTE) return 'URGENTE';
                                if ($model->estado == _PENDIENTE) return 'PENDIENTE';
                                if ($model->estado == _PROCESO) return 'PROCESO';
                                if ($model->estado == _ATENDIDO) return 'ATENDIDO';
                            }
                        ],

                        [
                            'class' => 'yii\grid\ActionColumn',
                            //'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
                            'template' => '{edit}{response}{delete}{transferir}{priority}',
                            'buttons' => [

                                'edit' => function ($url, $model) use ($id_pjax_sumilla) {
                                    $url = Url::toRoute(['/buzon/mensajes/modal-ver-mensaje', 'id' => $model->buzon_mensaje_id, 'gridName' => $id_pjax_sumilla, 'idModal' => 'buscarvalor']);
                                    return Html::a('<span class="btn btn-info glyphicon  glyphicon-eye-open"></span>', $url, ['class' => 'botonAbre', 'title' => "Ver detalles"]);
                                },
                                'response' => function ($url2, $model) use ($id_pjax_sumilla) {
                                    $url2 = Url::toRoute(['/buzon/mensajes/modal-responder-mensaje', 'id' => $model->buzon_mensaje_id, 'gridName' => $id_pjax_sumilla, 'idModal' => 'buscarvalor']);
                                    if ($model->estado != _ATENDIDO)
                                        return Html::a('<span class="btn btn-success glyphicon glyphicon-envelope"></span>', $url2, ['class' => 'botonAbre', 'title' => "Responder mensaje"]);
                                    else
                                        return '';
                                },
                                'transferir' => function ($url2, $model) use ($id_pjax_sumilla) {
                                    $url2 = Url::toRoute(['/buzon/mensajes/modal-transferir-mensaje', 'id' => $model->buzon_mensaje_id, 'gridName' => $id_pjax_sumilla, 'idModal' => 'buscarvalor']);
                                    if ($model->estado != _ATENDIDO)
                                        return Html::a('<span class="btn btn-warning glyphicon glyphicon-send"></span>', $url2, ['class' => 'botonAbre', 'title' => "Transferir"]);
                                    else
                                        return '';
                                },

                                'priority' => function ($url, $model) use ($id_pjax_sumilla) {
                                    $url = Url::toRoute(['/buzon/mensajes/ajax-update-state', 'id' => $model->buzon_mensaje_id, 'gridName' => $id_pjax_sumilla, 'idModal' => 'buscarvalor']);
                                    if ($model->estado != _ATENDIDO && $model->estado != _URGENTE)
                                        return Html::a('<span class="btn btn-danger glyphicon glyphicon-pushpin"></span>', 'javascript:void();', ['id' => $model->buzon_mensaje_id, 'title' => $url, 'family' => 'holas']);
                                    else return '';
                                },

                                'delete' => function ($url, $model) {
                                    $url = Url::toRoute(['/buzon/mensajes/ajax-delete-mensaje', 'id' => $model->buzon_mensaje_id]);

                                    if ($model->estado == _ATENDIDO)
                                        return Html::a('<span class="btn btn-danger glyphicon glyphicon-trash"></span>', 'javascript:void();', ['id' => $model->buzon_mensaje_id, 'title' => $url, 'family' => 'holas']);
                                    else
                                        return '';
                                },


                            ]
                        ],

                    ],
                ]
            );
            ?>
            <?php
            echo linkAjaxGridWidget::widget(
                [
                    'id' => 'sdsds',
                    'idGrilla' => 'gridTraba',
                    'family' => 'holas',
                    'type' => 'POST',
                    'evento' => 'click',
                    'posicion' => \yii\web\View::POS_END
                ]


            );
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>