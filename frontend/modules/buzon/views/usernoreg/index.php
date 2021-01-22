<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\buzon\models\BuzonUserNoregSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Buzon User Noregs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buzon-user-noreg-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Buzon User Noreg'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'ap',
            'am',
            'dni',
            //'email:email',
            //'celular',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
