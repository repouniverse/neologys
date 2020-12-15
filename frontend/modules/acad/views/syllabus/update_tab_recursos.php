<?php

?>

<div class="box-body">

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <?php echo $form->field($model, 'recursos_didac')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 2],
       'preset' => 'standard'
        ]);
   ?>
 </div>
        
    </div>   
  
    
       


    
    
    
    


