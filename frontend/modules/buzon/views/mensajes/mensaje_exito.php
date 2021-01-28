<?php

use yii\helpers\Html;
use common\helpers\h;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\modules\buzon\models\BuzonMensajes */

echo Html::img('../../../assets/USMP.png',
 [
     'style' =>  ['width' => '20%', 'margin-top' => '33px', 'margin-left' => '0%']
 ]
);


?>

<div>SE ENVIÓ CORRECTAMENTE SU MENSAJE</div>

<?php

$urlregistrado = Url::toRoute(['/buzon/mensajes/create']);
$urlnoregistrado = Url::toRoute(['/buzon/mensajes/createnr']);

    if (h::UserIsGuest()==false){  
        echo  Html::a('<span class="btn btn-danger">REGRESAR</span>', $urlregistrado, ['class' => 'btn-danger']);
    }else{
        echo  Html::a('<span class="btn btn-danger">REGRESAR</span>', $urlnoregistrado, ['class' => 'btn-danger']);
    }
    

?>