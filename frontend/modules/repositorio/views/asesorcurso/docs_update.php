<?php

use yii\helpers\Html;
//use yii\helpers\Url;
use yii\helpers\Json;
use common\helpers\comboHelper;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\grid\GridView;

use common\models\masters\Matricula;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use frontend\modules\repositorio\models\RepositorioAsesoresCursoDocs;

/* @var $this yii\web\View */
/* @var $model common\models\masters\AsesoresCurso */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
echo \common\widgets\spinnerWidget\spinnerWidget::widget();
?>
<div class="asesores-curso-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
       



        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php Pjax::begin(['id' => 'mis_files']); ?>
            <?php
            //$idsInPlanes= common\models\masters\PlanesEstudio::find()
            //->select(['curso_id'])->andWhere(['tipoproceso'=>'100'])->column();
            // echo $this->render('_search', ['model' => $searchModel]); 
            //var_dump($idsInPlanes); die();
            /*echo Matricula::find()->select(['id','curso_id','seccion','periodo'])->
                where(['alumno_id'=>$modelalumno->id])->andWhere(['curso_id'=>$idsInPlanes])->createCommand()->rawSql;die();*/
            ?>

            <?= GridView::widget([
                'dataProvider' => new ActiveDataProvider([
                    'query' => RepositorioAsesoresCursoDocs::find()
                        ->andWhere([
                            'asesores_curso_id' => $model->id,
                            'activo' => '1',
                            'publico' => '1'
                        ]),
                ]),
                'summary' => '',
                'columns' => [

                    'codocu',


                    [
                        'value' => function ($model) {
                            return $model->documento->desdocu;
                        }
                    ],


                    [
                        'class' => 'yii\grid\ActionColumn',
                        //'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
                        'template' => '{attach}',
                        'buttons' => [

                            'attach' => function ($url, $model) {

                                if (!$model->hasAttachments()) {
                                    $url = Url::toRoute([
                                        '/finder/selectimage',
                                        'isImage' => false,
                                        'idModal' => 'imagemodal',
                                        'idGrilla' => 'mis_files',
                                        'modelid' => $model->id,
                                        'extension' => Json::encode(['pdf']),
                                        'nombreclase' => str_replace('\\', '_', get_class($model))
                                    ]);
                                    $options = [
                                        'title' => Yii::t('base_labels', 'Upload File'),
                                        //'aria-label' => Yii::t('rbac-admin', 'Activate'),
                                        //'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                                        'data-method' => 'get',
                                        //'data-pjax' => '0',
                                    ];
                                    return Html::button('<span class="glyphicon glyphicon-paperclip"></span>', ['href' => $url, 'class' => 'botonAbre btn btn-success']);
                                } else {
                                    //$url=$model->urlFirstFile;
                                    return Html::a('<span class="glyphicon glyphicon-save"></span>', $model->urlFirstFile, ['data-pjax' => '0', 'class' => 'btn btn-warning']);
                                }
                                //return Html::a('<span class="btn btn-success glyphicon glyphicon-pencil"></span>', Url::toRoute(['view-profile','iduser'=>$model->id]), []/*$options*/);

                            },

                        ]

                    ],




                ],
            ]); ?>
            
            <?php Pjax::end(); ?>
        </div>


    </div>



    <?php ActiveForm::end(); ?>


</div>