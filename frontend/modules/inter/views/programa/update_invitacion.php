<?php
ECHO \common\widgets\spinnerWidget\spinnerWidget::widget();
use yii\helpers\Html;
use frontend\modules\inter\Module as m;
/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterPrograma */

$this->title = m::t('labels', 'Update invitation: {name}', ['name' => $model->descripcion,]);
    $this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Invitations'), 'url' => ['index-invitaciones']];
    //$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
    $this->params['breadcrumbs'][] = m::t('verbs', 'Update');
?>
<div class="inter-programa-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form_invitacion', [
        'model' => $model,'programa'=>$programa,'docente'=>$docente
    ]) ?>

</div>
</div>