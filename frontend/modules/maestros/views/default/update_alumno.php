<?php

use yii\helpers\Html;
use frontend\modules\maestros\MaestrosModule as m;
/* @var $this yii\web\View */
/* @var $model common\models\Documentos */

$this->title = m::t('labels', 'Update Student: {name}', ['name' => $model->codalu.' - '.$model->fullName(),]);
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Students'), 'url' => ['index-alumnos']];
$this->params['breadcrumbs'][] = m::t('verbs', 'Update');
?>
    <h4><?= Html::encode($this->title) ?></h4>
    <div class="documentos-update">
        <?= $this->render('_form_alumno', ['model' => $model, 'modelPersona'=>$modelPersona]) ?>
    </div>