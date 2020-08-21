<?php
use yii\helpers\Html;
use frontend\modules\maestros\MaestrosModule as m;

$this->title = m::t('labels', 'Create Teacher');
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Teachers'), 'url' => ['index-docentes']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentos-create">
    <h4><?= Html::encode($this->title) ?></h4>
    <div class="box box-success">    
        <?= $this->render('_form_docente', ['model' => $model,]) ?>
    </div>
</div>
