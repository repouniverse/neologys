<?php

use yii\helpers\Html;
use frontend\modules\maestros\MaestrosModule as m;
/* @var $this yii\web\View */
/* @var $model common\models\Documentos */

$this->title = m::t('labels', 'Update Teacher: {name}', ['name' => $model->codoce.' - '.$model->fullName(),]);
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Teachers'), 'url' => ['index-docentes']];
$this->params['breadcrumbs'][] = m::t('verbs', 'Update');
?>
    <h4><?= Html::encode($this->title) ?></h4>
    <div class="documentos-update">
        <?= $this->render('_form_docente', ['model' => $model,]) ?>
    </div>