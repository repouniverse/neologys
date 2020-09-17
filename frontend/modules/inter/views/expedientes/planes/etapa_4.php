<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use frontend\modules\inter\Module as m;
    use yii\helpers\Url;
    use yii\grid\GridView;
    use yii\widgets\Pjax;
    use common\helpers\h;
  
    use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
    use common\helpers\ComboHelper;

    use common\models\masters\Alumnos;
?>
<div class="inter-convocados-form">
    <div class="box-body">
       <?php echo $this->render('encabezado',['model'=>$model,'identidad'=>$identidad]); ?>
    </div>
   
    <?php 
           $form = ActiveForm::begin
                    (
                        [
                            'id'=>'biForm',
                            //'fieldClass'=>'\common\components\MyActiveField',
                        ]
                    ); 
        ?>
    
    
    
    <?php ActiveForm::end(); ?>
        
</div>
