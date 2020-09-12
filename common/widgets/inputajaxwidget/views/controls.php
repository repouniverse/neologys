<?php 
use yii\helpers\Html;
?>
<?php
if(!array_key_exists('prompt', $inputOptions))
$inputOptions['prompt']= '--'.$widget::t('messages','Choose a value')."--";

?>
 <?= $form->field($model,$campo)->
            dropDownList($data,
                   $inputOptions
                    ) ?>
 




