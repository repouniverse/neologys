<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\encuesta\models\EncuestaRespuestaEncuestaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Encuesta Respuesta Encuestas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="encuesta-respuesta-encuesta-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Encuesta Respuesta Encuesta'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_pregunta',
            'id_persona_encuesta',
            'respuesta',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
