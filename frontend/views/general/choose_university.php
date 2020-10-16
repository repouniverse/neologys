<?php
use common\models\masters\Universidades;
use common\helpers\ComboHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
?>
<?php


/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\sta\models\AulasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('base_verbs', 'Choose University');

?>
<div class="box box-body">

<div class="aulas-index">
    
 
   
    <div style='overflow:auto;'>
   
        <?php

$gridColumns = [

[
    
    'attribute' => 'codpais',    
   
],
[
    
    'attribute' => 'nombres',   
    'format'=>'raw',
    'value'=>function($model){
     return Html::a($model->nombre,Url::to(['selected-university','id'=>$model->id]));
    }
   
],


];

    
  echo GridView::widget([
    'id' => 'kv-grid-demo',
    'dataProvider' =>new \yii\data\ActiveDataProvider([
        'query'=> Universidades::find(),
    ]),
      'summary'=>'',
   
    'columns' => $gridColumns, // check the configuration for grid columns by clicking button above
    
]);  

?>
        
 </div>       
</div>
  
</div>


