<?php

use yii\helpers\Html;
use common\helpers\h;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\modules\buzon\models\BuzonMensajes */
?>

<div class="contenido">
    <div class="contenido-img">

    
        <?php
            echo Html::img('../../../assets/USMP.png',
            [
                'style' =>  ['width' => '100%', 'margin-top' => '33px', 'margin-left' => '0%'],
                
            ]
        );

        ?>
    </div>




<div class="mensaje-correcto">SE ENVIÓ CORRECTAMENTE SU MENSAJE</div>

<?php

$urlregistrado = Url::toRoute(['/buzon/mensajes/create']);
$urlnoregistrado = Url::toRoute(['/buzon/mensajes/createnr']);

    if (h::UserIsGuest()==false){  
        echo  Html::a('<span">REGRESAR</span>', $urlregistrado, ['class' => 'btn-danger btn-lg boton-regreso']);
    }else{
        echo  Html::a('<span">REGRESAR</span>', $urlnoregistrado, ['class' => 'btn-danger boton-regreso']);
    }

?>

</div>

<style>
.contenido{
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding-bottom: 150px;
}

.contenido-img{
    width: 30%;
}

.boton-regreso{
    margin-top: 20px;
   padding: 15px;
}

.mensaje-correcto{
    font-size: 17px;
    text-align: center;
}

@media (max-width: 415px){
    .imagen-exitoso{
        width: 100%;
    }
    .contenido-img{
    width: 80%;
    }
    

}

</style>