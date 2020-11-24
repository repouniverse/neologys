<?php

use common\helpers\h;

use yii\helpers\Url;


use yii\helpers\Html;



?>
    
<h4><i style="font-size:30px;"><?=h::awe('globe').'</i>'.h::space(10).yii::t('base_labels','Welcome to International Module')?></h4>
<div class="box body body-success">
<div class="row">
    <div class="alert bg-warning">
            <?=yii::t('base_errors','{fullname} at the moment you are not in the application process for the mobility program.',['fullname'=>$identidad->fullName()] )?>

        </div>     
</div>        
             
 <?php 
 echo $this->render('mapa_mundi');
 ?>     






     

</div>