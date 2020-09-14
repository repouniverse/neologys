
<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use frontend\modules\inter\Module as m;
    use common\models\masters\Personas;
    use common\helpers\ComboHelper;
    use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
    use common\models\masters\Facultades;
    use common\models\masters\Carreras;
        use frontend\modules\inter\models\InterPrograma ;
          use frontend\modules\inter\models\InterModos ;
           use frontend\modules\inter\models\InterEtapas ;
       
?>

<div class="alumnos-search">
    <?php $form = ActiveForm::begin(
                  [
                   'action' => ['index-plans'],
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

    <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">          
        <?= ComboDep::widget
            (
                [
                    'model'=>$model,               
                    'form'=>$form,
                    'data'=> ComboHelper::getCboUniversidades(),
                    'campo'=>'universidad_id',
                    'idcombodep'=>'interplansearch-facultad_id',               
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
                    'data'=> [],
                    'campo'=>'facultad_id',
                    'idcombodep'=>'interplansearch-programa_id',               
                    'source'=>
                    [
                    InterPrograma::className()=>
                        [
                            'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                            'camporef'=>'descripcion',//columna a mostrar 
                            'campofiltro'=>'facultad_id'  
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
                    'data'=> [],
                    'campo'=>'programa_id',
                    'idcombodep'=>'interplansearch-modo_id',               
                    'source'=>
                    [
                    InterModos::className()=>
                        [
                            'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                            'camporef'=>'descripcion',//columna a mostrar 
                            'campofiltro'=>'programa_id'  
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
                    'data'=> [],
                    'campo'=>'modo_id',
                    'idcombodep'=>'interplansearch-etapa_id',               
                    'source'=>
                    [
                    InterEtapas::className()=>
                        [
                            'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select 
                            'camporef'=>'descripcion',//columna a mostrar 
                            'campofiltro'=>'modo_id'  
                        ]
                    ],
                ]
           )
        ?>
    </div>
    
     <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
         <?= 
            $form->field($model, 'etapa_id')->
                         dropDownList
                         (
                         [],['prompt'=>'--'.m::t('verbs','Choose a Value')."--",]
                         )
        ?>
    </div>
    
    
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
         <?= 
            $form->field($model, 'codocu')->
                         dropDownList
                         (
                         ComboHelper::getCboDocuments(),['prompt'=>'--'.m::t('verbs','Choose a Value')."--",]
                         )
        ?>
    </div>
    
    
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <?= $form->field($model, 'descripcion') ?>        
    </div>
    
   
    <?php ActiveForm::end(); ?>
</div>
