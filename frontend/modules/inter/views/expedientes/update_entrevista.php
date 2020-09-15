<?php

use yii\helpers\Html;
use frontend\modules\inter\Module as m;
/* @var $this yii\web\View */
/* @var $model common\models\Documentos */

$this->title = m::t('labels', 'Attention Date: {name}', ['name' => $model->plan->descripcion,]);
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Candidates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = m::t('labels', 'File');
?>
    <h4><?= Html::encode($this->title) ?></h4>
    <div class="documentos-update">
        <?= $this->render('_form_entrevista', ['model' => $model, 'persona'=>$persona]) ?>
    </div>