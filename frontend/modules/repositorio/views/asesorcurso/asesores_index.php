<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\masters\AsesoresCursoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Asesores Cursos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asesores-curso-index">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
    <p>
        <?= Html::a(Yii::t('app', 'Create Asesores Curso'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute'=>'nombre'],
            ['attribute'=>'seccion'],
            ['attribute'=>'apasesor'],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
</div>
