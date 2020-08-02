<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Documentos */

$this->title = Yii::t('app', 'Update Students: {name}', [
    'name' => $model->codalu.' - '.$model->fullName(),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Students'), 'url' => ['index-alumnos']];

$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<h4><?= Html::encode($this->title) ?></h4>
<div class="documentos-update">

    

    <?= $this->render('_form_alumno', [
        'model' => $model,
    ]) ?>


</div>