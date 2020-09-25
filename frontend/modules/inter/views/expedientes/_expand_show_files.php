<?php
use common\helpers\FileHelper;
use yii\Helpers\Url;
use yii\Helpers\Html;
yii::error('A punto de recorrer  ',__FUNCTION__);
foreach($model->files as $file){
    //yii::error('recorreindo buecle  ',__FUNCTION__);
    //echo $model->id."<br>";
   if(FileHelper::isImage($file->getPath())){
  ?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <DIV STYLE="width:400px;height:600px; background-color: white;">
        <?php echo Html::img($file->getUrl(),[400,600]);   ?>
    </DIV> 
    
</div>
<?php
   }else{
       //yii::error('es un pdf ',__FUNCTION__);
 ?>
   <div STYLE="background-color: white;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?=Html::a('<i style="font-size:8em;color:orange;"><span class="fa '.FileHelper::getIconDocs($file->type).'"></span></i>',$file->getUrl(), ['data-pjax'=>'0'])?>
   </div>    
 <?php      
   }
 }
?>

