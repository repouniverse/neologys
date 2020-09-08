<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use frontend\modules\maestros\MaestrosModule as m;
    use common\models\masters\Personas;
    use common\helpers\ComboHelper;
    use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
    use common\models\masters\Facultades;
    use common\models\masters\Carreras;
?>

<div class="alumnos-search">
    <?php $form = ActiveForm::begin(
                  [
                   'action' => ['index-alumnos'],
                   'method' => 'get',
                   'options' => ['data-pjax' => 1],
                  ]); 
    ?>
    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <div class="form-group">
            <?= Html::submitButton("<span class='fa fa-search'></span>".m::t('verbs', 'Search'), ['class' => 'btn btn-primary']) ?>
             <?= Html::a(m::t('labels', 'Create Student'), ['create-alumnos'], ['class' => 'btn btn-success']) ?>
          
        </div>
    </div>

    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <?= $form->field($model, 'codalu') ?>        
    </div>
    
     <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <?= $form->field($model, 'ap') ?>
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?= $form->field($model, 'nombres') ?>
    </div>
    
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
         <?= 
            $form->field($model, 'tipodoc')->
                         dropDownList
                         (
                            Personas::comboDataField('tipodoc'),['prompt'=>'--'.m::t('verbs','Choose a Value')."--",]
                         )
        ?>
    </div>
    
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <?= $form->field($model, 'numerodoc') ?>        
    </div>
     
    <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">          
        <?= ComboDep::widget
            (
                [
                    'model'=>$model,               
                    'form'=>$form,
                    'data'=> ComboHelper::getCboUniversidades(),
                    'campo'=>'universidad_id',
                    'idcombodep'=>'alumnossearch-facultad_id',               
                    'source'=>
                    [
                        Facultades::className()=>
                        [
                            'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                            'camporef'=>'desfac',//columna a mostrar 
                            'campofiltro'=>'universidad_id'  
                        ]
                    ],
                ]
           )
        ?>
    </div>
        
    <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">          
        <?= ComboDep::widget
            (
                [
                    'model'=>$model,               
                    'form'=>$form,
                    'data'=> ($model->isNewRecord)?[]:ComboHelper::getCboFacultades($model->universidad_id),
                    'campo'=>'facultad_id',
                    'idcombodep'=>'alumnossearch-carrera_id',               
                    'source'=>
                    [
                        Carreras::className()=>
                        [
                            'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                            'camporef'=>'nombre',//columna a mostrar 
                            'campofiltro'=>'facultad_id'  
                        ]
                    ],
                ]
           )
        ?>
    </div>
        
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">    
        <?= $form->field($model, 'carrera_id')->
                         dropDownList(ComboHelper::getCboCarreras($model->facultad_id),
                                      ['prompt'=>'--'.m::t('verbs','Choose a value')."--",]
                                     )
        ?>
    </div>
   
    <?php ActiveForm::end(); ?>
</div>
