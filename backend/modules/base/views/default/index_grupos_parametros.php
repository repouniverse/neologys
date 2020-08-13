<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\modules\base\Module AS m;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\sta\models\AlumnosController */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = m::t('verbs', 'Create');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="alumnos-index">

    <h4><?= Html::encode($this->title) ?></h4>
    
    <div class="box box-success">
     <div class="box-body">
   
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(m::t('verbs', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div style='overflow:auto;'>
   
   
</div>
   

   

<?php

$gridColumns = [
  'nombretabla','valor'
];
 Pjax::begin(['timeout'=>false]); 
    
  echo GridView::widget([
    'id' => 'kv-grid-demo',
    'dataProvider' => new \yii\data\ActiveDataProvider(
            [
                'query'=> common\models\masters\Combovalores::find()->andWhere(['nombreTabla'=>$nombreTabla]),
            ]),
   // 'filterModel' => $searchModel,
    'columns' => $gridColumns, // check the configuration for grid columns by clicking button above
   
    
    // parameters from the demo form
   /* 'bordered' => $bordered,
    'striped' => $striped,
    'condensed' => $condensed,
    'responsive' => $responsive,
    'hover' => $hover,*/
   
]);  

?>
     <?php Pjax::end(); ?>
    </div>
   </div>     