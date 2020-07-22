<?php
use backend\modules\base\Module as m;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\masters\Combovalores */

$this->title = m::t('verbs', 'Create');
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Field Settings'), 'url' => ['index-campos-valores']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="combovalores-create">

    <h4><span class="fa fa-file"></span><?= "   -    ".Html::encode($this->title) ?></h4>
<div class="box box-body box-success">
    <?= $this->render('_form_campo_valores', [
        'model' => $model,
    ]) ?>
</div>
</div>
