<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\encuesta\models\EncuestaEncuestaGeneralSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Encuesta Encuesta Generals');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="encuesta-encuesta-general-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Encuesta Encuesta General'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'titulo_encuesta',
            'id_tipo_usuario',
            'id_tipo_encuesta',
            'descripcion',
            //'numero_preguntas',
            //'id_dep_encargado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
