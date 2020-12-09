<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper;
use common\helpers\h;
use common\widgets\selectwidget\selectWidget;
use yii\grid\GridView;
use frontend\modules\acad\models\AcadSyllabusUnidades;
use yii\data\ActiveDataProvider;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model frontend\modules\acad\models\AcadSyllabus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acad-syllabus-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'plan_id')->textInput(['value'=>$model->plan->plan->descripcion,'disabled'=>true]) ?>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'codperiodo')->textInput(['value'=>$model->plan->plan->codperiodo,'disabled'=>true]) ?>
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'n_horasindep')->textInput() ?>
</div>
 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'curso_id')->textInput(['value'=>$model->plan->codcursocorto,'disabled'=>true]) ?>
</div>   
    
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'curso_id')->textInput(['value'=>$model->plan->curso->descripcion,'disabled'=>true]) ?>
</div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'docente_owner_id')->textInput(['value'=>$model->docenteOwner->fullName(),'disabled'=>true]) ?>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <?php echo $form->field($model, 'sumilla')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 2],
        'preset' => 'basic'
        ]);
   ?>
 </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php 
         $id_pjax_sumilla= 'grid_sumilla';
        $url= Url::to(['modal-crear-unidad','id'=>$model->id,'gridName'=>$id_pjax_sumilla,'idModal'=>'buscarvalor']);
        echo  Html::button(yii::t('base_verbs','Add unit'), ['href' => $url, 'title' => yii::t('base_verbs','Add unit'),'id'=>'btn_unidad', 'class' => 'botonAbre btn btn-success']); 
        
        
       
        Pjax::begin(['id'=>'grid_sumilla','timeout'=>false]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query'=> AcadSyllabusUnidades::find()->
                select(['descripcion','capacidad'])->andWhere(['syllabus_id'=>$model->id])
        ]),
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
                'descripcion',
                'capacidad',
            ['class' => 'yii\grid\ActionColumn',
                //'template' => Helper::filterActionColumn(['view', 'activate', 'delete']),
            'template' => '{edit}{delete}',
               'buttons' => [                    
                    'delete' => function ($url,$model){                   
                            $url = Url::toRoute(['/acad/syllabus/ajax-delete-unidad','id'=>$model->id]);
                              return Html::a('<span class="btn btn-danger glyphicon glyphicon-trash"></span>', 'javascript:void();', ['id'=>$model->id,'title'=>$url,'family'=>'holas']);
                             },                    
                        
                    ]
                ],
        ],
    ]); ?>

     <?php 
   echo linkAjaxGridWidget::widget([
           'id'=>'widgetgru545',
            'idGrilla'=>'grid_sumilla',
        //'otherContainers'=>['pajaxn_ui_segu'],
            'family'=>'holas',
          'type'=>'POST',
           'evento'=>'click',
       'posicion'=>\yii\web\View::POS_HEAD
            //'foreignskeys'=>[1,2,3],
        ]); 
   ?>   
        
        
        
    <?php Pjax::end(); ?>

        
    </div>   
    
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <?php echo $form->field($model, 'competencias')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 3],
        'preset' => 'basic'
        ]);
   ?>
 </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <?php echo $form->field($model, 'prog_contenidos')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 3],
        'preset' => 'basic'
        ]);
   ?>
 </div> 
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <?php echo $form->field($model, 'estrat_metod')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 3],
        'preset' => 'basic'
        ]);
   ?>
 </div> 
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <?php echo $form->field($model, 'recursos_didac')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 3],
        'preset' => 'basic'
        ]);
   ?>
 </div>  
    
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <?php echo $form->field($model, 'fuentes_info')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 3],
        'preset' => 'basic'
        ]);
   ?>
 </div>  
    
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    <?= $form->field($model, 'formula_id')->textInput() ?>
</div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('base_labels', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
