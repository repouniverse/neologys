<?php
use yii\helpers\Html;
use common\helpers\FileHelper;
$images=['png','jpg','jpeg'];

foreach($model->files as $file){?>
     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
 <?php  if($file->type=='pdf') { ?>
         <embed src=<?=$file->getModule()->getFilesDirPath($file->hash) . DIRECTORY_SEPARATOR . $file->hash . '.' . $file->type?> type="application/pdf" width="100%" height="600px" />
  <?php       }elseif(in_array($file->type,$images)){ 
          echo Html::img($file->path);
     } else{ 
         echo Html::a("<span class='fa fa-file'></span>");     
        }              ?>
     </div>     
<?php } ?>


