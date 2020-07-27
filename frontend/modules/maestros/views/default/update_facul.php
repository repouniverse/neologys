<?php
use yii\helpers\Html;

use backend\modules\base\Module as m;
/* @var $this yii\web\View */
/* @var $model common\models\masters\Combovalores */

$this->title = yii::t('base.verbs', 'Edit : {name}', [
    'name' => $model->desfac,
]);
$this->params['breadcrumbs'][] =['label' => yii::t('base.labels', 'Field Settings'), 'url' => ['index-facul']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = yii::t('base.verbs', 'Update');
?>
<div class="combovalores-update">

   <h4><span class="fa fa-edit"></span><?= "   -    ".Html::encode($this->title) ?></h4>
<div class="box box-body box-success">

    <?= $this->render('_form_facul', [
        'model' => $model,
    ]) ?>
</div>
</div>
