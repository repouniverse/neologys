<?php
use frontend\modules\maestros\MaestrosModule AS m;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Sociedades */

$this->title = Yii::t('base.verbs', 'Create Foreing Person');
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Persons'), 'url' => ['index-personas']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sociedades-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form_personas_extranjero', [
        'model' => $model,
    ]) ?>

</div>



