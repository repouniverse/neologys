<?php

use yii\helpers\Html;
use common\helpers\comboHelper;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\grid\GridView;
use common\models\masters\Matricula;
use yii\data\ActiveDataProvider;

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
	<?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider(['query'=>Matricula::find()->select(['id','curso_id'])->where(['alumno_id'=>$modelalumno->id])]),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['value'=>function($model){return $model->curso->codcur;}],
            ['value'=>function($model){return $model->curso->descripcion;}],
            ['value' => function($model){return $model->asesorcurso->persona->fullName();}],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
</div>
   

     <?=$form->field($model, 'asesor_id')->
                      dropDownList(comboHelper::getCboAsesores(),['prompt'=>'--'.Yii::t('base_verbs','Choose a Value')."--",])
            ?>


    <?= $form->field($model, 'activo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
