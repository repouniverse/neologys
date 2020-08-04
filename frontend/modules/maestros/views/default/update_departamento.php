<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Documentos */

$this->title = Yii::t('app', 'Update Departament: {name}', [
    'name' => $model->coddepa.' - '.$model->nombredepa,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Departaments'), 'url' => ['index-departamentos']];

$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<h4><?= Html::encode($this->title) ?></h4>
<div class="documentos-update">
<div class="box box-success">
    

    <?= $this->render('_form_departamento', [
        'model' => $model,
    ]) ?>

</div>
</div>