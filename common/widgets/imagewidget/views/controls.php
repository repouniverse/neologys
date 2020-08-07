<?php 
use yii\helpers\Html;
?>
<div class="cuadrazo">
<div class="img-thumbnail cuaizquierdo">
   <?= Html::img($urlImage,[
    'width'=>$ancho,
      'height'=>$alto,  
]) ?> 
</div>
   <div class=" cuaderecho">
     <?php if(!$isNew) {  ?>
        <?php if($numeroImages >0) {  ?>
         <div class="absolute"><?=$numeroImages?></div>
        <?php }  ?>
     <?php 
        $url=$urlModal;
 
        echo  Html::button('<span class="glyphicon glyphicon-pencil"></span>', ['href' => $url, 'title' => 'Editar Adjunto', 'class' => 'botonAbre btn btn-success']); 
        ?>
       
       <span class="btn btn-warning btn-gh glyphicon glyphicon-zoom-in"></span>
     <?php }else{  ?>
       <span class="glyphicon glyphicon-alert"></span>
       <?=$mensaje?>
 <?php }  ?>
   </div> 
</div>





