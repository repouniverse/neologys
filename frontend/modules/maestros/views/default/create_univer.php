<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Sociedades */

$this->title = Yii::t('base.verbs', 'Create University');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.labels', 'Universities'), 'url' => ['index-univer']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sociedades-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form_univer', [
        'model' => $model,
    ]) ?>

</div>

