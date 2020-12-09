<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    //use frontend\modules\inter\Module as m;
    use yii\helpers\Url;
    use yii\grid\GridView;
    use yii\widgets\Pjax;
    use common\helpers\h;
    //use kartik\date\DatePicker;
    use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
    use common\helpers\ComboHelper;
    use common\widgets\selectwidget\selectWidget;
    use common\widgets\spinnerWidget\spinnerWidget;
    use common\widgets\inputajaxwidget\inputAjaxWidget;
    ///use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
?>
<div class="inter-convocados-form">
    <?php echo spinnerWidget::widget();  ?>
    <br>
        <?php $form = ActiveForm::begin(
                      [
                        'id'=>'biForm',
                        ///'fieldClass'=>'\common\components\MyActiveField',
                      ]); ?>
        
        <div class="box-body"> 
  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"> 
        <?= ComboDep::widget(
                    [
                        'model'=>$model,               
                        'form'=>$form,
                        'data'=> ComboHelper::getCboCarreras(h::gsetting('general','MainUniversity')),
                        'campo'=>'carrera_id',
                        'idcombodep'=>'cabeceraasignacionsyllabus-plan_id',
                        
                        'source'=>[\common\models\masters\Planes::className()=>
                                    [
                                        'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                                        'camporef'=>'descripcion',//columna a mostrar 
                                        'campofiltro'=>'carrera_id'  
                                    ]
                                  ],
                    ])
                ?>
    </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">    
                <?= $form->field($model, 'plan_id')->
                           dropDownList([],
                                        ['prompt'=>'--'.yii::t('base_verbs','Choose a Value')."--",])
                ?>
            </div>
            
            
            
        <?php ActiveForm::end(); ?>
        </div> 
    
    
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
     <?php echo selectWidget::widget([
           // 'id'=>'mipapa',
            'model'=>$model,
            'form'=>$form,
            'campo'=>'docente_id',
         'ordenCampo'=>1,
         'addCampos'=>[9,10,11,13],
        'inputOptions'=>[/*'enableAjaxValidation'=>true*/],
        ]);
                
           ?>
        </div>
    <?php echo inputAjaxWidget::widget([
        'ruta'=>Url::to(['ajax-prueba']),
        'tipo'=>'POST',
        'id_input'=>"cabeceraasignacionsyllabus-plan_id",//Es el id DOM del que invoca
        'evento'=>'change',
        'isHtml'=>true,
        'idGrilla'=>'pjax-syllabus',
        
    ]); ?>
    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?php Pjax::begin(['id'=>'pjax-syllabus','timeout'=>false])   ?>
        
   
    <?php Pjax::end()   ?>
    
    </div>
    
</div>


