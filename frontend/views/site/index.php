<?php

use common\helpers\h;

use yii\helpers\Url;


use yii\helpers\Html;



?>
    
<h4><i style="font-size:30px;"><?=h::awe('globe').'</i>'.h::space(10).yii::t('base_labels','Welcome to International Module')?></h4>
<div class="box body body-success">
<div class="row">
         
</div>        
             
 <?php 
 echo $this->render('mapa_mundi');
 ?>     






     

</div>