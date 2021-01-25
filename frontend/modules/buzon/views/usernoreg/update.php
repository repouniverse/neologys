<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\buzon\models\UserNoReg */

$this->title = Yii::t('base_labels', 'Update User No Reg: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'User No Regs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('base_labels', 'Update');
?>
<div class="user-no-reg-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
