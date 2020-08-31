<?php

use yii\helpers\Html;
use frontend\modules\maestros\MaestrosModule as m;

/* @var $this yii\web\View */
/* @var $model common\models\Documentos */

$this->title = m::t('labels', 'Update Documents: {name}', [
    'name' => $model->codocu,
]);
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Documents'), 'url' => ['index-docu']];

$this->params['breadcrumbs'][] = m::t('verbs', 'Update');
?>
<h4><?= Html::encode($this->title) ?></h4>
<div class="documentos-update">
<div class="box box-success">
    

    <?= $this->render('_form_docu', [
        'model' => $model,
    ]) ?>

</div>
</div>