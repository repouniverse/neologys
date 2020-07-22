<?php 
use yii\helpers\Html;
use common\helpers\h;
?>
<div class="contenedoruser">
    <div class="elementosuser">
        <?= Html::img($src,['class'=>'img'.$forma.$size]) ?>
    </div>
    <div class="elementosuser">
        <?php $cad= ($longName)?h::UserLongName():'';
          echo $cad.'  -  ('.h::userName().')';
        ?>
    </div>
</div>


