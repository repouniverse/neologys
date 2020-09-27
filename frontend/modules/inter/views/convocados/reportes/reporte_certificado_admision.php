<?php
use yii\helpers\Html;
use yii\helpers\Url;

//$query= frontend\modules\sta\models\StaResultados::find()->where(['examen_id'=>$examenesId]);

   
   echo Html::img(Url::base().'/img/modules/inter/logo-international.jpg');
   
?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

      <div class="titulo">CERTIFICADO DE ADMISION</div>

<div class="afiliacion">

</div>

<br>
<br>
<br>
<br>
<br>

<div class="parrafo-medio">
    Se expide el presente certificado al alumno <B><?=$postulante->fullName()  ?> </B>por 
    haber pasado satisfactoriamente el proceso de evaluación para formar parte del 
    program de intercambio internacional, en el periodo 2020-I.
</div>


<div class="afiliacion">
</div>
<div class="afiliacion">
    <br>
</div>

<br>
<br>