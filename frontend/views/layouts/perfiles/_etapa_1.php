<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\h;

//use frontend\modules\inter\Module as m;
?>
<div class="btn-group">   
          <?php $url=Url::toRoute(['/inter/convocados/fill-ficha','id'=>$convocatoria->id]);  ?>      
              <?=Html::a(h::awe('list').h::space(10).yii::t('base_labels','Fill in Personal Data'),$url,['target'=>'_blank','data-pjax'=>'0','class'=>"btn btn-danger"])?>
            
</div> 


