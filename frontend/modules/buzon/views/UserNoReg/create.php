<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\buzon\models\UserNoReg */

$this->title = Yii::t('base_labels', 'Create User No Reg');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'User No Regs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-no-reg-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
