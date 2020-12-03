<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\acad\models\AcadSyllabusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('base_labels', 'Acad Syllabi');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acad-syllabus-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('base_labels', 'Create Acad Syllabus'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'plan_id',
            'codperiodo',
            'curso_id',
            'n_horasindep',
            //'docente_owner_id',
            //'datos_generales:ntext',
            //'sumilla:ntext',
            //'competencias:ntext',
            //'prog_contenidos:ntext',
            //'estrat_metod:ntext',
            //'recursos_didac:ntext',
            //'formula_id',
            //'fuentes_info:ntext',
            //'reserva1:ntext',
            //'reserva2:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
