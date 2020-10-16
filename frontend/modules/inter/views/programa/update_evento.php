<?php
ECHO \common\widgets\spinnerWidget\spinnerWidget::widget();
use yii\helpers\Html;
use frontend\modules\inter\Module as m;
/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterPrograma */

$this->title = m::t('labels', 'Update event: {name}', ['name' => $model->descripcion,]);
    $this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Events'), 'url' => ['index-eventos']];
    //$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
    $this->params['breadcrumbs'][] = m::t('verbs', 'Update');
?>
<div class="inter-programa-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form_evento', [
        'model' => $model,
    ]) ?>

</div>
</div>