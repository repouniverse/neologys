   <?php 
   use common\helpers\ComboHelper;

       use frontend\modules\maestros\MaestrosModule as m;
       use common\widgets\selectwidget\selectWidget;
   ?>
        
       <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($modelPersona, 'lugarnacimiento')->textInput(['maxlength' => true]) ?>
        </div>
           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($modelPersona, 'telpaisorigen')->textInput(['maxlength' => true]) ?>
        </div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($modelPersona, 'codcontpaisorigen')->textInput(['maxlength' => true]) ?>
        </div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($modelPersona, 'parentcontpaisorigen')->textInput(['maxlength' => true]) ?>
        </div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($modelPersona, 'parentcontpaisorigen')->textInput(['maxlength' => true]) ?>
        </div>

        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">    
            <?= $form->field($modelPersona, 'paisresidencia')->
                       dropDownList(\frontend\modules\inter\helpers\ComboHelper::getCboPaises(),
                                   ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",])
            ?>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($modelPersona, 'lugarresidencia')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12"> 
     <?php 
  // $necesi=new Parametros;
    echo selectWidget::widget([
           // 'id'=>'mipapa',
            'model'=>$modelPersona,
            'form'=>$form,
            'campo'=>'codcontpaisresid',
         'ordenCampo'=>5,
         'addCampos'=>[7,8,17],
        ]);  ?>

           </div> 
<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12"> 
     <?php 
     
  // $necesi=new Parametros;
    echo selectWidget::widget([
           // 'id'=>'mipapa',
            'model'=>$modelPersona,
            'form'=>$form,
            'campo'=>'codresponsable',
         'ordenCampo'=>8,
         'addCampos'=>[7,9],
        ]);  ?>

 </div>  
       <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($modelPersona, 'telefasistencia')->textInput(['maxlength' => true]) ?>
        </div>