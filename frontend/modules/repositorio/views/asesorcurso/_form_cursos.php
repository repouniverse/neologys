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
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?= $form->field($modelalumno, 'id')->label(\Yii::t('base_labels', 'Race'))->textInput(['disabled' => true, 'value' => $modelalumno->carrera->nombre]) ?>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?= $form->field($modelalumno, 'id')->label(\Yii::t('base_labels', 'Full Name'))->textInput(['disabled' => true, 'value' => $modelalumno->fullName()]) ?>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?= $form->field($modelalumno, 'codalu')->label(\Yii::t('base_labels', 'Registration number'))->textInput(['disabled' => true]) ?>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <br>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                <?php
                echo Html::img($modelalumno->image($modelalumno->codalu), ['width' => 180, 'height' => 240, 'class' => "img-thumbnail cuaizquierdo"]);
                ?>
            </div>


        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php Pjax::begin(['id' => 'mi_grilla']); ?>
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
                    'query' => frontend\modules\repositorio\models\RepoVwAsesoresAsignados::find()->andWhere(['alumno_id' => $modelalumno->id]),
                ]),
                'summary' => '',
                'columns' => [
                    [
                        'columnKey'=>'codcur',
                        'class' => 'kartik\grid\ExpandRowColumn',
                        'width' => '50px',
                        
                        'value' => function ($model, $key, $index, $column) {
                            return GridView::ROW_COLLAPSED;
                        },
                        'detail' => function ($model, $key, $index, $column) {                    
                            // $dataProvider= \frontend\modules\acad\models\AcadContenidoSyllabusSe  
                            return $this->render('docs_update', [
                                'model' => $model,

                            ]);
                        
                        },
                        'expandOneOnly' => true
                    ],

                    'codcur',
                    'descripcion',
                    'seccion',
                    'periodo'

                ],
            ]); ?>
            <?php
            echo linkAjaxGridWidget::widget(
                [
                    'id' => 'sdsds',
                    'idGrilla' => 'mi_grilla',
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



    <?php ActiveForm::end(); ?>


</div>