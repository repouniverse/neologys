
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
use kartik\widgets\SwitchInput;
use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\h;
use frontend\modules\sta\helpers\comboHelper;
use yii\widgets\Pjax;


$this->title = 'Profile';
//$this->params['breadcrumbs'][] = $this->title;
?>
 <?php
 $url= Url::to(['agrega-universidad','id'=>$model->id,'gridName'=>'dsde','idModal'=>'buscarvalor']);
   echo  Html::button(yii::t('base_verbs','Add university'), ['href' => $url, 'title' => yii::t('sta.labels','Agregar Tutor'),'id'=>'btn_contacts', 'class' => 'botonAbre btn btn-success']); 
?> 
<div class="row">
  <?PHP Pjax::begin(['id'=>'dsde','timeout'=>false]) ?>
    <br> 
              <?php 
              $i=0;
              foreach($useruniversidades as $useruniversidad) { 
                // vr_dump($userfacultad->facultad->desfac);
                 // echo $userfacultad->facultad->desfac."<br>";
                  echo $this->render('checkboxfacultad',['i'=>$i,'form'=>$form,'useruniversidad'=>$useruniversidad]);
               $i++;
               } ?> 
 <?PHP Pjax::end(); ?>
</div>
    

