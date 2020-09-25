<?php 
use yii\helpers\Html;
use frontend\modules\report\Module;
?>
<a href="<?=Module::urlReport($idReporte, $idFiltro)?>" target="<?=($newPage)?"_blank":""  ?>" class="btn btn-success btn-lg ">
        <i class="glyphicon glyphicon-paste " aria-hidden="true"></i> <?=yii::t('report.labels','Reporte')?>
</a>

 




