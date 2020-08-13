<?php

use yii\helpers\Html;
use backend\modules\base\Module as m;
/* @var $this yii\web\View */
/* @var $model common\models\masters\GrupoParametros */

$this->title = m::t('labels', 'Update Parameters Group: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Parameters Group'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = m::t('verbs', 'Update');
?>
<div class="grupo-parametros-update">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
