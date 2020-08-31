<?php

use yii\helpers\Html;
use frontend\modules\maestros\MaestrosModule as m;
/* @var $this yii\web\View */
/* @var $model common\models\Sociedades */

$this->title = m::t('labels', 'Create Person');
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Persons'), 'url' => ['index-personas']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sociedades-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form_personas', [
        'model' => $model,
    ]) ?>

</div>

