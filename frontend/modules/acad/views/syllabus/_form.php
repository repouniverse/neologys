<?php
use kartik\editable\Editable;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper;
use common\helpers\h;
use common\widgets\selectwidget\selectWidget;
//use yii\grid\GridView;
use frontend\modules\acad\models\AcadSyllabusUnidades;
use frontend\modules\acad\models\AcadSyllabusCompetencias;
use yii\data\ActiveDataProvider;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use common\widgets\inputajaxwidget\inputAjaxWidget;
use yii\widgets\Pjax;
use frontend\modules\acad\Module as m;
/* @var $this yii\web\View */
/* @var $model frontend\modules\acad\models\AcadSyllabus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box-body">

   
        
    
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'plan_id')->textInput(['value'=>$model->plan->plan->descripcion,'disabled'=>true]) ?>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'codperiodo')->textInput(['value'=>$model->plan->plan->codperiodo,'disabled'=>true]) ?>
</div>

<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
    <?= $form->field($model, 'n_horasindep')->textInput() ?>
</div>

 <?php echo ucfirst(strtolower(m::cicleInLetters(10)));  ?>
    
 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
    <?= $form->field($model, 'curso_id')->textInput(['value'=>$model->plan->codcursocorto,'disabled'=>true]) ?>
</div>   
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'curso_id')->textInput(['value'=>$model->plan->curso->descripcion,'disabled'=>true]) ?>
</div> 

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'docente_owner_id')->textInput(['value'=>$model->docenteOwner->fullName(),'disabled'=>true]) ?>
</div>
    
 
    
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php 
        //echo $model->id; 
        //$identidad_syllabus=$model->id;
         $id_pjax_docentes= 'grid_docentes';
        $url= Url::to(['modal-add-teacher','id'=>$model->id,'gridName'=>$id_pjax_docentes,'idModal'=>'buscarvalor']);
        echo  Html::button(yii::t('base_verbs','Add teacher'), ['href' => $url, 'title' => yii::t('base_verbs','Add teacher'),'id'=>'btn_teacher', 'class' => 'botonAbre btn btn-success']); 
        
        
       
        Pjax::begin(['id'=>$id_pjax_docentes,'timeout'=>false]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query'=> frontend\modules\acad\models\AcadSyllabusDocentes::find()->
                select(['id','docente_id','activo'])->andWhere(['syllabus_id'=>$model->id])
        ]),
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
               ['attribute'=>'docente_id',
                   'value'=>function($model){
                    return $model->docente->fullName();
                   }
                   ],
            ['class' => 'yii\grid\ActionColumn',
                //'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
            'template' => '{edit}{delete}{contenido}',
               'buttons' => [                    
                    'delete' => function ($url,$model){                   
                            $url = Url::toRoute(['/acad/syllabus/ajax-delete-unidad','id'=>$model->id]);
                              return Html::a('<span class="btn btn-danger glyphicon glyphicon-trash"></span>', 'javascript:void();', ['id'=>$model->id,'title'=>$url,'family'=>'holas']);
                             }, 
                    ]
                ],
        ],
    ]); ?>
        
    <?php Pjax::end(); ?>

        
    </div>   
    
   
  
 
   
 
 
 

   

</div>
