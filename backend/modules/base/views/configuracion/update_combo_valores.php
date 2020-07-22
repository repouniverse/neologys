<?php

use yii\helpers\Html;
use backend\modules\base\Module as m;
/* @var $this yii\web\View */
/* @var $model common\models\masters\Combovalores */



/* @var $this yii\web\View */
/* @var $model common\models\masters\Combovalores */

$this->title = m::t('verbs', 'Edit : {name}', [
    'name' => $model->valor,
]);
$this->params['breadcrumbs'][] =['label' => m::t('labels', 'Field Settings'), 'url' => ['index-campos-valores']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = m::t('messages', 'Update');
?>
<div class="combovalores-update">

   <h4><span class="fa fa-edit"></span><?= "   -    ".Html::encode($this->title) ?></h4>
<div class="box box-body box-success">

    <?= $this->render('_form_combo_valores', [
        'model' => $model,
    ]) ?>
</div>
</div>
