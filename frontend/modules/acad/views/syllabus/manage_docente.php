<?php
    use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
    use yii\helpers\Url;
    use common\helpers\h;
    use common\models\masters\Personas;
    use common\helpers\ComboHelper;
    use yii\helpers\Html;
    use yii\widgets\Pjax;
    use yii\grid\GridView;
    use yii\widgets\ActiveForm;
    use kartik\tabs\TabsX;
    use kartik\date\DatePicker;
    use common\widgets\inputajaxwidget\inputAjaxWidget;
    use frontend\modules\maestros\MaestrosModule as m;
    use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
    use common\widgets\buttonajaxwidget\buttonAjaxWidget;
    use common\models\masters\Ubigeos;
?>

<div class="box box-success">
    <div id="advertencia_doc"></div>
 <?php echo \common\widgets\spinnerWidget\spinnerWidget::widget();    ?>
    <?php $form = ActiveForm::begin(
                                    [
                                        //'action'=>'GET'
                                       // 'id' => 'docentes-form',
                                       // 'action'
                                       'method'=>'GET',
                                        'enableAjaxValidation' => true,
                                       // 'fieldClass' => 'common\components\MyActiveField',
                                    ]
                                   ); 
    ?>
    
    <div class="box-body">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'codoce')->textInput(['disabled'=>true,'maxlength' => true]) ?>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">    
            <?= $form->field($model, 'ap')->textInput(['disabled'=>true,]) ?>
        </div>
        
        
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'nombres')->textInput(['disabled'=>true,'maxlength' => true]) ?>
        </div>
        
        
        
               
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <?php 
             ECHO $form->field($model, 'correo')->textInput(['disabled'=>true,'maxlength' => true]);
           
            ?>
           
        </div>
        
        
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?=$form->field($model, 'categoria')->
                      dropDownList(ComboHelper::getCboCategoriaDocente(),['prompt'=>'--'.yii::t('base_verbs','Choose a Value')."--",'disabled'=>true,])
            ?>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <?php ActiveForm::end(); ?>         
          
        
      
     
       
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  

        
            <?php echo TabsX::widget
                  (
                    [
                        'position' => TabsX::POS_ABOVE,
                        'bordered'=>true,
                        'align' => TabsX::ALIGN_LEFT,
                        'encodeLabels'=>false,
                        'items' =>
                        [
                            [
                                'label'=>'<i class="fa fa-home"></i> '.yii::t('base_labels','Plan'),
                                'content'=> $this->render('_tab_docente_plan',[
                                                                'model'=>$model,
                                                                'searchModel' => $searchModel,
                                                                'dataProvider' => $dataProvider,
                                                                            ]),
                                'active' => true,
                                'options' => ['id' => 'myveryownID3'],
                            ],
                            [
                                'label'=>'<i class="fa fa-home"></i> '.yii::t('base_labels','Courses'),
                                'content'=> $this->render('_tab_docente_curso',['model'=>$model,]),
                               // 'active' => true,
                                'options' => ['id' => 'myvuyuynID3'],
                            ],
                            
                            
                        ],
                    ]
                  );  
            ?> 

        
 
        </div>  

         </div>     
             
             
        
       
 
   
     <?php 
            echo inputAjaxWidget::widget([
      'id_input'=>'docentes-numerodoc',
            'tipo'=>'get',
            'evento'=>'change',
      'isHtml'=>true,
            'idGrilla'=>'advertencia_doc',
            'ruta'=>Url::to(['/maestros/default/verify-duplicate-person']),          
           //'posicion'=> \yii\web\View::POS_END           
        
            ]);
           ?>
    <?php echo buttonAjaxWidget::widget(
       [  
            'id'=>'btn-register',
            'idGrilla'=>'america',
            'ruta'=>Url::to(['/inter/convocados/ajax-register-doce','id'=>$model->id]),          
           //'posicion'=> \yii\web\View::POS_END           
        ]  
   );   ?>
 </div>
