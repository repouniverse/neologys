<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Sociedades */

$this->title = Yii::t('base.verbs', 'Create Person');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.errors', 'Persons'), 'url' => ['index-personas']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sociedades-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form_personas', [
        'model' => $model,
    ]) ?>

</div>

