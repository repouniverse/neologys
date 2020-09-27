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
        if($model->hasAttachments())
        echo  Html::a('<span class="glyphicon glyphicon-download-alt"></span>', $model->files[0]->url, ['title' => 'Descargar','data-pjax'=>'0', 'class' => ' btn btn-warning']); 
        ?>
       
       
     <?php }else{  ?>
       <span class="glyphicon glyphicon-alert"></span>
       <?=$mensaje?>
 <?php }  ?>
   </div> 
</div>





