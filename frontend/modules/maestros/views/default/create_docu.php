<?php
use yii\helpers\Html;
use frontend\modules\maestros\MaestrosModule as m;

/* @var $this yii\web\View */
/* @var $model common\models\Documentos */

$this->title = m::t('labels', 'Create Documents');
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Documents'), 'url' => ['index-docu']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentos-create">
<h4><?= Html::encode($this->title) ?></h4>
   <div class="box box-success">
    

    <?= $this->render('_form_docu', [
        'model' => $model,
    ]) ?>

</div></div>
