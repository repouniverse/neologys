<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\buzon\models\BuzonAdministradores */

$this->title = Yii::t('app', 'Create Buzon Administradores');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Buzon Administradores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buzon-administradores-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
