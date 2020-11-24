<?php

use yii\helpers\Html;
use common\helpers\comboHelper;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\grid\GridView;
use common\models\masters\Matricula;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\masters\AsesoresCurso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asesores-curso-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
	
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	 <?= $form->field($modelalumno, 'id')->label(\Yii::t('base_labels','Race'))->textInput(['disabled'=>true,'value'=> $modelalumno->carrera->nombre]) ?>	
	 </div> 
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
	 <?= $form->field($modelalumno, 'id')->label(\Yii::t('base_labels','Names'))->textInput(['disabled'=>true,'value'=> $modelalumno->fullName()]) ?>
	 </div>
	 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	 <?= $form->field($modelalumno, 'codalu')->textInput(['disabled'=>true]) ?>	
	 </div>
	</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
	<?php Pjax::begin(['id'=>'mi_grilla']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider(['query'=>Matricula::find()->select(['id','curso_id'])->where(['alumno_id'=>$modelalumno->id])]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'header'=>yii::t('base_labels','Code'),
                'value'=>function($model){return $model->curso->codcur;}],
            [    'header'=>yii::t('base_labels','Name'),
                'value'=>function($model){return $model->curso->descripcion;}],
            [
                'header'=>yii::t('base_labels','Assigned Assesor'),
                'value' => function($model){
            	if(is_null($asesorcurso=$model->asesorCurso)) return null;
            	return $model->asesorCurso->persona->fullName();

            }],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{add}',
                'buttons' => [
                    'add' => function($url, $model) {                        
                        $options = [
                            'title' => yii::t('base_verbs', 'Update'), 'data-pjax'=>'0', 'class'=>'botonAbre btn btn-primary btn-sm' ];        
                                                    
                                                $url=Url::to(['/repositorio/asesorescurso/modal-asesorcurso','id'=>$model->id,'gridName'=>'mi_grilla','idModal'=>'buscarvalor']);
                        return Html::a('<span class="glyphicon glyphicon-plus"></span>'.yii::t('base_verbs',' Add Assesor'), $url, $options);
                         
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