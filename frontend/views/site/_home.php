<?php

use yii\helpers\Html;
use common\helpers\h;
use common\models\masters\Alumnos;
/* @var $this yii\web\View */
/* @var $model common\models\masters\AsesoresCurso */
$titulo=Yii::t('base_verbs', 'Bienvenido.');
   
$this->title =$titulo ;

?>
<h4><?=h::awe('user')?><?='  '.yii::$app->user->profile->persona->ap.'  '.'  '.yii::$app->user->profile->persona->am.'  '.Html::encode($this->title) ?></h4>

<div class="box box-body">

   
   

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3>
            BIENVENIDO AL SISTEMA DE TRÁMITE DOCUMENTARIO.
        </h3>
        <h4>
           Usted cuenta con los siguientes accesos.
        </h4>
    </div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?php $items = \common\components\MenuHelper::getAssignedMenu(
        yii::$app->user->id,
        null/*root*/,
        null,
        false/*refresh*/
    );

    ?>

    <?= dmstr\widgets\Welcome::widget(
        [
            'options' => ['class' => 'sidebar-menu', 'data-widget' => 'tree'],
            'items' => $items
        ]
    ) ?>

</div>
</div>