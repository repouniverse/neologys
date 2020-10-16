<?php

use yii\helpers\Html;
use frontend\modules\maestros\MaestrosModule as m;
/* @var $this yii\web\View */
/* @var $model common\models\Documentos */

$this->title = m::t('labels', 'Update Departament: {name}', [
    'name' => $model->coddepa.' - '.$model->nombredepa,
]);
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Departaments'), 'url' => ['index-departamentos']];

$this->params['breadcrumbs'][] = m::t('verbs', 'Update');
?>
<h4><?= Html::encode($this->title) ?></h4>
<div class="documentos-update">
<div class="box box-success">
    

    <?= $this->render('_form_departamento', [
        'model' => $model,
    ]) ?>

</div>
</div>