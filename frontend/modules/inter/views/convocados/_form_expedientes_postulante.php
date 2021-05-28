<?php

use common\widgets\buttonajaxwidget\buttonAjaxWidget as btnAjax;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\h;
use frontend\modules\inter\Module as m;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use frontend\modules\inter\models\InterExpedientes;

?>

<?php
Pjax::begin(['id' => 'pjaxuno', 'timeout' => false]);
?>
.
<?php
$porcentajeAvance = $model->porcAvanceUploads($model::STAGE_UPLOADS);

if ($porcentajeAvance < 100) {
    ?>
    <div class="progress">
        <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $porcentajeAvance ?>%"
             aria-valuenow="<?= $porcentajeAvance ?>" aria-valuemin="0"
             aria-valuemax="100"> <?= m::t('labels', 'Progress stage:') . h::space(10) . $porcentajeAvance ?>%
        </div>
    </div>
    <?php
} else { //Si ha subido todos los Uploads
    $model->sendEmailUploads();
    if (!h::session()->has('envi_correo') && h::request()->isAjax)
        h::session()->set('envi_correo', $model->sendEmailUploads());
    ?>
    <div class="alert alert-info"><?= m::t('validaciones', 'You have completed the documents stage. In 24 hours you will receive the validation') ?></div>
    <?php
}
?>
<br>
<br>
<?= GridView::widget([
    'dataProvider' => new ActiveDataProvider([
        'query' => InterExpedientes::find()->andWhere([
            'convocado_id' => $model->id, 'orden' => $model->currentStage()])->orderBy(['secuencia' => SORT_ASC]),
    ]),
    //'summary' => '',
    'tableOptions' => ['class' => 'table table-condensed table-hover table-bordered table-striped'],
    // 'filterModel' => $searchModel,
    'columns' => [


        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{attach}',
            'buttons' => [
                'attach' => function ($url, $model) {
                    $url = \yii\helpers\Url::toRoute(['/finder/selectimage',
                        'isImage' => false,
                        'idModal' => 'imagemodal',
                        'idGrilla' => 'pjaxuno',
                        'extension' => \yii\helpers\Json::encode(array_merge(common\helpers\FileHelper::extDocs(), common\helpers\FileHelper::extImages())),
                        'modelid' => $model->id,
                        'nombreclase' => str_replace('\\', '_', get_class($model))]);
                    $options = [
                        'title' => m::t('labels', 'Upload file'),
                        //'aria-label' => Yii::t('rbac-admin', 'Activate'),
                        //'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                        'data-method' => 'get',
                        //'data-pjax' => '0',
                    ];
                    if ($model->codocu != '348' && $model->codocu != '378'  && $model->codocu != '326' && $model->codocu != '100')
                        return Html::button('<span class="glyphicon glyphicon-paperclip"></span>', ['href' => $url, 'title' => m::t('verbs', 'Attach file'), 'class' => 'botonAbre btn btn-danger']);
                    //return Html::a('<span class="btn btn-success glyphicon glyphicon-pencil"></span>', Url::toRoute(['view-profile','iduser'=>$model->id]), []/*$options*/);


                },
                'view' => function ($url, $model) {
                    $options = [
                        'title' => m::t('verbs', 'View'),
                    ];
                    return Html::a('<span class="btn btn-warning btn-sm glyphicon glyphicon-search"></span>', $url, $options/*$options*/);
                },

            ]
        ],

        'documento.desdocu',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{Record}',
            'buttons' => [
                'Record' => function ($url, $model) {
                    return ($model->codocu == 121) ? Html::a('Descargar modelo', 'https://sisfcctp.usmp.edu.pe/frontend/web/declaracion_jurada_outgoing.docx', ['data-pjax' => '0', 'target' => '_blank', 'style' => 'font-size:14px']) : '';
                },
            ]
        ],

        'clase',
        ['attribute' => 'estado',
            'format' => 'raw',
            'value' => function ($model) {
                return $model->flagStatus();
            }
        ],
        ['attribute' => 'Adjunto',
            'format' => 'raw',
            'value' => function ($model) {
                return $model->flagAttach();
            }
        ]


    ],
]); ?>

<?PHP
/*ECHO btnAjax::widget([

]);*/

echo btnAjax::widget([
    'id' => 'btn_expe',
    'idGrilla' => 'pjaxuno',
    'ruta' => Url::to(['/inter/convocados/ajax-crea-expedientes', 'id' => $model->id]),
    //'posicion'=> \yii\web\View::POS_END
]);


?>


<?php
Pjax::end();
?>
    


