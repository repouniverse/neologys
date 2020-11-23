<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Asesores */

$this->title = Yii::t('app', 'Create Asesores');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Asesores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asesores-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
	
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

</div>
