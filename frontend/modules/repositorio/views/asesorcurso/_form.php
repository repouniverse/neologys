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
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-6"> 
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
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6"> 
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <br>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                 <?php 
                echo Html::img($modelalumno->image($modelalumno->codalu),['width'=>180,'height'=>240, 'class'=>"img-thumbnail cuaizquierdo"]);
                    ?>
            </div>
	   
	
	</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
	<?php Pjax::begin(['id'=>'mi_grilla']); ?>
    <?php 
//$idsInPlanes= common\models\masters\PlanesEstudio::find()
        //->select(['curso_id'])->andWhere(['tipoproceso'=>'100'])->column();
// echo $this->render('_search', ['model' => $searchModel]); 
//var_dump($idsInPlanes); die();
/*echo Matricula::find()->select(['id','curso_id','seccion','periodo'])->
                where(['alumno_id'=>$modelalumno->id])->andWhere(['curso_id'=>$idsInPlanes])->createCommand()->rawSql;die();*/
?>
            <div class=" alert alert-light col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php if($tienecursos)echo yii::t('base_labels','To select your advisor, please press the button that appears next to the course')?>
            </div>
    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query'=>$modelalumno->cursosQuery()->select(['id','curso_id','seccion','periodo']),
                        ]),
            'summary'=>'',
            'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'header'=>yii::t('base_labels','Code'),
                'value'=>function($model){return $model->curso->codcur;}],
            [    'header'=>yii::t('base_labels','Name'),
                'value'=>function($model){return $model->curso->descripcion;}],
           // 'id',
            [    
                'attribute'=>'seccion',
               /* 'header'=>yii::t('base_labels','Section'),
                'value'=>function($model){return $model->seccion;}*/],
                        
            [ 
                
                'header'=>yii::t('base_labels','Assigned Assesor'),
                'value' => function($model){
            	if($model->hasAssesor()) 
            	return $model->asesorCurso->asesor->docente->fullName();
                return '';

            }],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{add}',
                'buttons' => [
                    'add' => function($url, $model) {                        
                        $options = [
                            'title' => yii::t('base_verbs', 'Update'), 'data-pjax'=>'0', 'class'=>'botonAbre btn btn-primary btn-sm' ]; 
                                      $url=Url::to(['/repositorio/asesorcurso/modal-asesorcurso','id'=>$model->id,'gridName'=>'mi_grilla','idModal'=>'buscarvalor']);
                                     if($model->hasAssesor()) return '';
                                      return Html::a('<span class="glyphicon glyphicon-plus"></span>'.yii::t('base_verbs','Add Assesor'), $url, $options);
                         
                         },
                    ]
                ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
        
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
	<?php Pjax::begin(['id'=>'ajaxprofesores']); ?>
       <?php 
       $cursoMatriculado=$modelalumno->cursosQuery()->one();
       ?>
    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query'=> \common\models\masters\DocenteCursoSeccion::find()
               ->select(['id','curso_id','seccion','docente_id'])->
               andWhere([
                   'curso_id'=>$cursoMatriculado->curso_id,
                  // 'docente_id'=>$cursoMatriculado->docente_id,
                   'seccion'=>$cursoMatriculado->seccion,
                   ]),
                        ]),
            'summary'=>'',
            'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
          
           // 'id',
            [    
                'attribute'=>'seccion',
               /* 'header'=>yii::t('base_labels','Section'),
                'value'=>function($model){return $model->seccion;}*/],
                        
           

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{add}',
                'buttons' => [
                    'add' => function($url, $model) {                        
                        $options = [
                            'title' => yii::t('base_verbs', 'Update'), 'data-pjax'=>'0', 'class'=>'botonAbre btn btn-primary btn-sm' ]; 
                                      $url=Url::to(['/repositorio/asesorcurso/modal-asesorcurso','id'=>$model->id,'gridName'=>'mi_grilla','idModal'=>'buscarvalor']);
                                     
                                      return Html::a('<span class="glyphicon glyphicon-plus"></span>'.yii::t('base_verbs','Add Assesor'), $url, $options);
                         
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