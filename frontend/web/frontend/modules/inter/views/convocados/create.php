<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterConvocados */

$this->title = Yii::t('base_labels', 'Create Inter Convocados');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'Inter Convocados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inter-convocados-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>