<?php

use yii\helpers\Html;
use backend\modules\base\Module as m;
/* @var $this yii\web\View */
/* @var $model common\models\masters\GrupoParametros */

$this->title = m::t('labels', 'Create Parameters Group');
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Parameters Group'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-parametros-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>