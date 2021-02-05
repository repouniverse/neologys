<?php

use yii\helpers\Html;
use common\helpers\h;

/* @var $this yii\web\View */
/* @var $model frontend\modules\tramdoc\models\Matriculareact */

$this->title = Yii::t('base_labels', 'REGISTRAR SOLICITUD');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'Matriculareacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matriculareact-create">

    <h4><?=h::awe('envelope-open-o').h::space(10).Html::encode($this->title) ?></h4>
    <div class="box box-success">
    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
