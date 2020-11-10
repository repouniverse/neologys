<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MailingModel */

$this->title = Yii::t('base_labels', 'Create Mailing Model');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'Mailing Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mailing-model-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>