<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Documentos */

$this->title = Yii::t('base.labels', 'Create group people');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base.labels', 'Groups'), 'url' => ['index-grupopersonas']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentos-create">
<h4><?= Html::encode($this->title) ?></h4>
   <div class="box box-success">
    

    <?= $this->render('_form_grupopersonas', [
        'model' => $model,
    ]) ?>

</div></div>
