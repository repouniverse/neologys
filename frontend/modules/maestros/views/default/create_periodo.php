<?php

use yii\helpers\Html;
use frontend\modules\maestros\MaestrosModule as m;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Periodos */

$this->title = m::t('labels', 'Create Periods');
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Periods'), 'url' => ['index-periodo']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="periodos-create">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <?= $this->render('_form_periodo', [
        'model' => $model,
    ]) ?>

</div>
</div>