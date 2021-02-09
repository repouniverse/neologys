<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helpers\h;
use frontend\modules\tramdoc\models\TramdocFiles;
/* @var $this yii\web\View */
/* @var $model frontend\modules\tramdoc\models\Matriculareact */

/*const DOCU_PAGO_TRAMITE_ADJUNTO = '156';
const DOCU_RECORD_NOTAS_ADJUNTO = '157';
const DOCU_CURSOS_APTO_ADJUNTO = '159';*/
const DOCU_PAGO_TRAMITE_ADJUNTO='211';
const DOCU_RECORD_NOTAS_ADJUNTO='213';
const DOCU_CURSOS_APTO_ADJUNTO='215';
$this->title = Yii::t('base_labels', 'Datos Registrados');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'Matriculareacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="matriculareact-view">

    <h4><?= h::awe('eye') . h::space(10) . Html::encode($this->title) ?></h4>
    <div class="box box-success">
        <br>

        <p>
            <?= Html::a(Yii::t('base_labels', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('base_labels', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('base_labels', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'nro_matr',
                'codigo',
                [
                    'format' => 'raw',
                    'label' => 'Carrera',
                    'value' => function ($model) {
                        return h::nombreCarrera($model->carrera_id);
                    },

                ],
                'dni',
                'apellido_paterno',
                'apellido_materno',
                'nombres',
                'email_usmp:email',
                'email_personal:email',
                'celular',
                'telefono',
                'mensaje:ntext',
                'fecha_solicitud',
                'fecha_registro',
                'cta_sin_deuda_pendiente_check',
                'cta_sin_deuda_pendiente_obs:ntext',
                'cta_pago_tramite_check',
                [
                    'format' => 'raw',
                    'label' => 'Pago Trámite Adjunto',
                    'value' => function ($model) {
                        $archivo = TramdocFiles::findOne(['matr_id' => $model->id, 'docu_id' => DOCU_PAGO_TRAMITE_ADJUNTO]);
                        //return Html::a('<span class="glyphicon glyphicon-save"></span>', $archivo->urlFirstFile, ['data-pjax' => '0']);

                        if ($archivo->hasAttachments()) {
                            return Html::a('<span class="glyphicon glyphicon-save"></span>', $archivo->urlFirstFile, ['data-pjax' => '0', 'class' => 'btn btn-block']);
                        } else {
                            return "Sin archivo.";
                        }
                    },

                ],
                'cta_pago_tramite_obs:ntext',
                'ora_record_notas_check',
                [
                    'format' => 'raw',
                    'label' => 'Record de Notas Adjunto',
                    'value' => function ($model) {
                        $archivo = TramdocFiles::findOne(['matr_id' => $model->id, 'docu_id' => DOCU_RECORD_NOTAS_ADJUNTO]);
                        //return Html::a('<span class="glyphicon glyphicon-save"></span>', $archivo->urlFirstFile, ['data-pjax' => '0']);

                        if ($archivo->hasAttachments()) {
                            return Html::a('<span class="glyphicon glyphicon-save"></span>', $archivo->urlFirstFile, ['data-pjax' => '0', 'class' => 'btn btn-block']);
                        } else {
                            return "Sin archivo.";
                        }
                    },

                ],
                'ora_record_notas_obs:ntext',
                'aca_cursos_aptos_check',
                [
                    'format' => 'raw',
                    'label' => 'Cursos Aptos Adjunto',
                    'value' => function ($model) {
                        $archivo = TramdocFiles::findOne(['matr_id' => $model->id, 'docu_id' => DOCU_CURSOS_APTO_ADJUNTO]);
                        //return Html::a('<span class="glyphicon glyphicon-save"></span>', $archivo->urlFirstFile, ['data-pjax' => '0']);

                        if ($archivo->hasAttachments()) {
                            return Html::a('<span class="glyphicon glyphicon-save"></span>', $archivo->urlFirstFile, ['data-pjax' => '0', 'class' => 'btn btn-block']);
                        } else {
                            return "Sin archivo.";
                        }
                    },

                ],
                'aca_cursos_aptos_observaciones:ntext',
                'ora_cursos_aptos_check',
                'ora_cursos_aptos_obs:ntext',
                'oti_cursos_aptos_check',
                'oti_cursos_aptos_obs:ntext',
                'oti_notifica_email_check:email',
                'oti_notifica_email_obs:ntext',

            ],
        ]) ?>

    </div>