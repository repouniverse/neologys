<?php

use yii\helpers\Html;
use common\helpers\comboHelper;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\grid\GridView;
use common\models\masters\Matricula;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
 use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;

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
	 <?= $form->field($modelalumno, 'id')->label(\Yii::t('base_labels','Race'))->textInput(['disabled'=>true,'value'=> $modelalumno->carrera->nombre]) ?>	
	 </div> 
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
	 <?= $form->field($modelalumno, 'id')->label(\Yii::t('base_labels','Full Name'))->textInput(['disabled'=>true,'value'=> $modelalumno->fullName()]) ?>
	 </div>
	 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	 <?= $form->field($modelalumno, 'codalu')->label(\Yii::t('base_labels','Registration number'))->textInput(['disabled'=>true]) ?>	
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
                <h4><?php if($tienecursos)echo yii::t('base_labels','To select your adviser, please press the button that appears next to the Name')?></h4>
            </div>
    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query'=>$modelalumno->cursosQuery()->select(['id','curso_id','seccion','periodo']),
                        ]),
            'summary'=>'',
            'columns' => [
           
            [
                'header'=>yii::t('base_labels','Code'),
                'value'=>function($model){return $model->curso->codcur;}],
            [    'header'=>yii::t('base_labels','Name course'),
                'value'=>function($model){return $model->curso->descripcion;}],
           // 'id',
            [    
                'attribute'=>'seccion',
               /* 'header'=>yii::t('base_labels','Section'),
                'value'=>function($model){return $model->seccion;}*/],
                        
           /* [ 
                
                'header'=>yii::t('base_labels','Assigned Adviser'),
                'value' => function($model){
            	if($model->hasAssesor()) 
            	return $model->asesorCurso->asesor->docente->fullName();
                return '';

            }],*/

            /*[
                'class' => 'yii\grid\ActionColumn',
                'template' => '{add}',
                'buttons' => [
                    'add' => function($url, $model) {                        
                        
                         },
                    ]
                ],*/
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
        
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
	<?php Pjax::begin(['id'=>'ajaxprofesores']); ?>
       <?php 
       $cursoMatriculado=$modelalumno->cursosQuery()->one();
     /* ECHO (new \yii\db\Query())->select(['a.id','a.curso_id','a.seccion','a.docente_id'])->
              from('{{%docente_curso_seccion}} a')-> 
              innerJoin('{{%docentes}} b','a.docente_id=b.id')->
              innerJoin('{{%asesores}} x','x.docente_id=b.id')
              ->andWhere(['curso_id'=>$cursoMatriculado->curso_id,'seccion'=>$cursoMatriculado->seccion])
       ->createCommand()->rawSql; DIE();*/
       ?>
    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query'=> common\models\masters\DocenteCursoSeccion::find()
                ->alias('t')->select(['x.id','t.curso_id','t.seccion','t.docente_id'])->
              distinct()-> 
              innerJoin('{{%docentes}} b','t.docente_id=b.id')->
              innerJoin('{{%asesores}} x','x.docente_id=b.id')
              ->andWhere([
                  'curso_id'=>$cursoMatriculado->curso_id,
                  'seccion'=>$cursoMatriculado->seccion
                      ]),
            
                   ]),
                     
            'summary'=>'',
            'columns' => [
           
          
           // 'id',
           
            [    
                //'attribute'=>'seccion',
                'header'=>yii::t('base_labels','Adviser'),
                'value'=>function($model){
        
          // return \yii\Helpers\Json::encode($model->attributes);
        return $model->docente->fullName();
        
                }
            ],
                        
           

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{add}',
                'buttons' => [
                    'add' => function($url, $model) use($cursoMatriculado,$modelalumno) {  
                    $tieneAsesor= \frontend\modules\repositorio\models\RepoVwAsesoresAsignados::find()
                            ->andWhere([
                                    'asesor_id'=>$model->id,
                                    
                                   /* 'curso_id'=>$cursoMatriculado->curso_id,
                                    'seccion'=>$cursoMatriculado->seccion,
                                    'carrera_id'=>$modelalumno->carrera->id,
                                    'matricula_id'=>$cursoMatriculado->id, */
                     ])->exists();
                    
                       /* $options = [
                            'title' => yii::t('base_verbs', 'Update'), 'data-pjax'=>'0', 'class'=>'botonAbre btn btn-primary btn-sm' ]; 
                                      $url=Url::to(['/repositorio/asesorcurso/modal-asesorcurso','id'=>$model->id,'gridName'=>'mi_grilla','idModal'=>'buscarvalor']);
                                     
                                      return Html::a('<span class="glyphicon glyphicon-plus"></span>'.yii::t('base_verbs','Add Assesor'), $url, $options);
                         */
                            if($tieneAsesor){
                                return '<i style="color:green;font-size:18px;"><span class="fa fa-check"></span></i>';          
                              
                            }else{
                             $url = Url::toRoute([$this->context->id.'/ajax-asigna-asesor','id'=>$model->id,'idMat'=>$cursoMatriculado->id]);
                              return Html::a('<span class="fa fa-plus"></span>Agregar Asesor', '#', ['id'=>$model->id,'title'=>$url,'family'=>'holas','class'=>'btn btn-primary btn-sm']);           
                               
                            }
                          
                              
                              
                         },
                    ]
                ],
        ],
    ]); ?>

      <?php 
   echo linkAjaxGridWidget::widget([
           'id'=>'srttrwidgetgruidBancos',
            'idGrilla'=>'ajaxprofesores',
       //'otherContainers'=>['grupo-pjax'],
            'family'=>'holas',
          'type'=>'POST',
           'evento'=>'click',
       'posicion'=>\yii\web\View::POS_END
            //'foreignskeys'=>[1,2,3],
        ]); 
   ?>      
            
            
    <?php Pjax::end(); ?>
</div>
</div>
   


    <?php ActiveForm::end(); ?>


</div>