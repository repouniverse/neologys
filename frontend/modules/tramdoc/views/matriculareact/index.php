<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\tramdoc\models\MatriculareactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('base_labels', 'Matriculareacts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matriculareact-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('base_labels', 'Create Matriculareact'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'nro_matr',
            'codigo',
            'carrera_id',
            'dni',
            'apellido_paterno',
            'apellido_materno',
            'nombres',
            //'email_usmp:email',
            //'email_personal:email',
            //'celular',
            //'telefono',
            //'mensaje:ntext',
            'fecha_solicitud',
            //'fecha_registro',
            'cta_sin_deuda_pendiente_check',
            //'cta_sin_deuda_pendiente_obs:ntext',
            'cta_pago_tramite_check',
            'cta_pago_tramite_adjunto',
            //'cta_pago_tramite_obs:ntext',
            'ora_record_notas_check',
            'ora_record_notas_adjunto',
            //'ora_record_notas_obs:ntext',
            'aca_cursos_aptos_check',
            'aca_cursos_aptos_adjunto',
            //'aca_cursos_aptos_observaciones:ntext',
            'ora_cursos_aptos_check',
            //'ora_cursos_aptos_obs:ntext',
            'oti_cursos_aptos_check',
            //'oti_cursos_aptos_obs:ntext',
            'oti_notifica_email_check:email',
            //'oti_notifica_email_obs:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
