<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\inter\models\InterConvocadosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('base_labels', 'Inter Convocados');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inter-convocados-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('base_labels', 'Create Inter Convocados'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'universidad_id',
            'facultad_id',
            'depa_id',
            'modo_id',
            //'codperiodo',
            //'codocu',
            //'programa_id',
            //'clase',
            //'status',
            //'secuencia',
            //'alumno_id',
            //'docente_id',
            //'persona_id',
            //'identidad_id',
            //'codalu',
            //'codigo1',
            //'codigo2',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
