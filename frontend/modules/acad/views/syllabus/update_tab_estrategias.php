<?php

?>

<div class="box-body">


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <?php echo $form->field($model, 'estrat_metod')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 2],
       'preset' => 'full'
        ]);
   ?>
 </div>
        
    </div>   
  
    
       


    
    
    
    

