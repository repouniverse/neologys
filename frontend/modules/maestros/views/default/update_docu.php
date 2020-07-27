<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Documentos */

$this->title = Yii::t('app', 'Update Documentos: {name}', [
    'name' => $model->codocu,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documentos'), 'url' => ['index-docu']];

$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<h4><?= Html::encode($this->title) ?></h4>
<div class="documentos-update">
<div class="box box-success">
    

    <?= $this->render('_form_docu', [
        'model' => $model,
    ]) ?>

</div>
</div>