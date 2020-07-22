<?php
use yii\helpers\Html;
$this->title = Yii::t('sta.labels', 'Create Alumnos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('sta.labels', 'Alumnos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alumnos-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form_grupos_parametros', [
        'model' => $model,
    ]) ?>

</div>
</div>



