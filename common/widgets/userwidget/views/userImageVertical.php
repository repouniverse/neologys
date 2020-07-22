<?php 
use yii\helpers\Html;
use common\helpers\h;
?>
<div class="contenedoruser">
    <div class="filauser">
        <?= Html::img($src,['class'=>'img'.$forma.$size]) ?>
    </div>
    <div class="filauser">
        <?php $cad= ($longName)?h::UserLongName():'';
          echo $cad.'  -  ('.h::userName().')';
        ?>
       
    </div>
</div>


