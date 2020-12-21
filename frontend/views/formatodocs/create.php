<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FormatoDocs */

$this->title = Yii::t('base_labels', 'Create Formato Docs');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'Formato Docs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="formato-docs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
