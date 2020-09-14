<?php
use common\helpers\h;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Trabajadores */

$this->title = Yii::t('base_labels', 'Update Worker: {name}', [
    'name' => $model->codtra.'-'.$model->persona->fullName(),
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'Workers'), 'url' => ['index-trabajadores']];
//$this->params['breadcrumbs'][] = ['label' => $model->codigoper, 'url' => ['view-persona', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('base_errors', 'Update');
?>
<div class="trabajadores-update">

    <h4><?= h::awe('wrench').h::space(10).Html::encode($this->title) ?></h4>

    <?= $this->render('_form_trabajadores', [
        'model' => $model,
    ]) ?>

</div>
