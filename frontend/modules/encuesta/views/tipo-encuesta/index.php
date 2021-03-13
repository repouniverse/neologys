<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\encuesta\models\EncuestaTipoEncuestaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tipos de Encuesta');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="encuesta-tipo-encuesta-index">
   
    <h4><?= Html::encode($this->title) ?></h4>
    <div class="box box-success"></div>
    
   
    <p>
        <?= Html::a(Yii::t('app', 'Create Encuesta Tipo Encuesta'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre_tipo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
