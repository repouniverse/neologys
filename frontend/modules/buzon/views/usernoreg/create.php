<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\buzon\models\BuzonUserNoreg */

$this->title = Yii::t('app', 'Create Buzon User Noreg');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Buzon User Noregs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buzon-user-noreg-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
