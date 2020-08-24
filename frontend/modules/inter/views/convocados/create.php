<?php
    use yii\helpers\Html;
    use frontend\modules\inter\Module as m;
    
    $this->title = m::t('labels', 'Create Inter Summoned');
    $this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Inter Summoned'), 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="inter-convocados-create">
    <h4><?= Html::encode($this->title) ?></h4>
    <div class="box box-success">
        <?= $this->render('_form', ['model' => $model,]) ?>
    </div>
</div>