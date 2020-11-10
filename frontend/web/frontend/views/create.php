<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CarrerasTest */

$this->title = Yii::t('base_labels', 'Create Carreras Test');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'Carreras Tests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carreras-test-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>