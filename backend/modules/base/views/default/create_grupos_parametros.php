<?php
use yii\helpers\Html;
use backend\modules\base\Module as m;

$this->title = m::t('labels', 'Create Student');
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Students'), 'url' => ['index']];
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



