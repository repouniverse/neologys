<?php

use yii\helpers\Html;
use common\helpers\h;
/* @var $this yii\web\View */
/* @var $model frontend\modules\tramdoc\models\Matriculareact */

$this->title = Yii::t('base_labels', 'Actualizar Seguimiento', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'Matriculareacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('base_labels', 'Update');
?>
<div class="matriculareact-update">

    <h4><?= h::awe('pencil') . h::space(10) . Html::encode($this->title) ?></h4>
    <div class="box box-body">
        <div style="width: 70%;">


                    <?= $this->render('_form_update', [
                        'model' => $model,
                        'trabajador' => $trabajador,
                        'file_pago_tram' => $file_pago_tram,
                        'file_record_notas' => $file_record_notas,
                        'file_cursos_apto' => $file_cursos_apto
                    ]) ?>


        </div>

    </div>