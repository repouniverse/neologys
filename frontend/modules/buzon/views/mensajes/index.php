<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\buzon\models\BuzonMensajesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Buzon Mensajes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buzon-mensajes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Buzon Mensajes'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'departamento_id',
            'mensaje:ntext',
            'estado',
            //'prioridad',
            //'fecha_registro',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
