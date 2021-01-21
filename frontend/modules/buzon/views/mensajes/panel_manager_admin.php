<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use frontend\modules\maestros\MaestrosModule as m;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use common\helpers\ComboHelper as combo;

echo \common\widgets\spinnerWidget\spinnerWidget::widget();
$this->title = yii::t('base_labels', 'Panel de Administrador Buzon');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="docentes-index">
    <h4> <?= Html::encode($this->title) ?> </h4>
    <div class="box box-success">
        <div class="box-body">
            <?php Pjax::begin(['id' => 'gridTraba']); ?>
            <?php
            $paises = combo::getCboPaises();
            $depas = combo::getCboDepartamentosFacu(1);
            ?>
            <?php echo $this->render('_search_panel_manager_admin', ['model' => $searchModel]); ?>
            .

            <?= GridView::widget(
                [
                    'dataProvider' => $dataProvider,
                    //'filterModel'=>$searchModel,
                    'tableOptions' => ['class' => 'table table-condensed table-hover table-bordered table-striped'],
                    'columns' =>
                    [
                        /*[
                            'attribute'=>'Pais',
                            'filter'=> $paises,
                            'group'=>true,
                            'value'=>function($model)
                                     {
                                        return $model->persona->pais;
                                     }                                 
                        ],*/
                        [
                            'attribute'=>'departamento_id',
                            'filter'=>$depas,
                            'group'=>true,
                            'value'=>function($model)
                                     {
                                        return $model->nombredepa;
                                     }                                
                        ],
                        'nombres',
                        'ap',
                        'am',
                        'email',
                        'mensaje'

                    ],
                ]
            );
            ?>
            <?php
            echo linkAjaxGridWidget::widget(
                [
                    'id' => 'sdsds',
                    'idGrilla' => 'gridTraba',
                    'family' => 'holas',
                    'type' => 'POST',
                    'evento' => 'click',
                    'posicion' => \yii\web\View::POS_END
                ]
            );
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>