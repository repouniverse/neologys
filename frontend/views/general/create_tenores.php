<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Tenores */

$this->title = Yii::t('base_labels', 'Create text');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'Texts'), 'url' => ['index-tenores']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tenores-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form_tenores', [
        'model' => $model,
    ]) ?>

</div>
</div>