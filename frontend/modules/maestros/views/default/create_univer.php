<?php
    use yii\helpers\Html;
    use frontend\modules\maestros\MaestrosModule as m;

$this->title = m::t('labels', 'Create University');
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Universities'), 'url' => ['index-univer']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sociedades-create">
    <h4><?= Html::encode($this->title) ?></h4>
    <?= $this->render('_form_univer', ['model' => $model,]) ?>
</div>

