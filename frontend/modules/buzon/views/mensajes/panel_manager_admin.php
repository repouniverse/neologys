<?php

use yii\helpers\Html;
use common\helpers\comboHelper;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\grid\GridView;
//use kartik\grid\GridView;
use common\models\masters\Matricula;
use common\models\FormatoDocs;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use frontend\modules\repositorio\models\RepoVwAsesoresAsignados;
$mizona2='pajaxn_ui2';

 Pjax::begin(['id'=>$mizona2,'timeout'=>false]); 
/* @var $this yii\web\View */
/* @var $model common\models\masters\AsesoresCurso */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
echo \common\widgets\spinnerWidget\spinnerWidget::widget();
?>
<h4><?= yii::t('base_labels', 'Panel administrador de Asesores') ?></h4>

<div class="box box-succes">

    <div class="box-body">
    
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="overflow: auto;overflow-y: hidden;">
                




                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'options' => ['style' => 'widht : 25%'],
                    'summary' => '',
                    'columns' => [

                        //'codcur',
                        'descripcion',
                        'apasesor',
                        'nombresasesor',
                        'seccion',
                        'codesp',
                        'codalu',
                        'ap',
                        'am',
                        'nombres',
                        [
                            'format' => 'raw',
                            'value' => function ($model) {
                                $links = $model->listAttachedFiles();
                                $cadenaHtml = '';
                                foreach ($links as $codocu => $link) {
                                    $cadenaHtml .= Html::a($codocu, $link, ['data-pjax' => '0', 'class' => 'btn btn-success']) . '<br>';
                                }
                                return $cadenaHtml;
                            },
                        ],

                        [
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::a('<span class="glyphicon glyphicon-folder-open"></span>', Url::to(['manage-attachments', 'id' => $model->id]), ['data-pjax' => '0', 'class' => 'btn btn-warning']);
                            },
                        ]
                    ],
                ]); ?>
            </div>
            <?php 
   echo linkAjaxGridWidget::widget([
           'id'=>'widgetgruidBancos',
            'idGrilla'=>$mizona2,
        'otherContainers'=>['pajaxn_ui_segu'],
            'family'=>'holas2',
          'type'=>'POST',
           'evento'=>'click',
       'posicion'=>\yii\web\View::POS_END
            //'foreignskeys'=>[1,2,3],
        ]); 
   ?>


    <?php Pjax::end(); ?>



        </div>
    </div>
</div>