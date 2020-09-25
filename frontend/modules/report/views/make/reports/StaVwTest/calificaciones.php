<?php
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use yii\helpers\Html,yii\helpers\Url;
 //use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
//use kartik\editable\Editable;
//use kartik\grid\GridView ;
use frontend\modules\sta\helpers\comboHelper;

?>


    <div style="width:300px;">
  
    <?php // echo $thigrids->render('_search', ['model' => $searchModel]); ?>

    
   
   <?php 

   $gridColumns = [
             
                            

[  'attribute' => 'valor',
    'label' => false, 
],
[  'attribute' => 'descripcion', 
    'label' => false, 
], 

      
];
   
   
   
   
   ?>
        <?php 
       
        echo GridView::widget([
            'showHeader'=> false,
             'id' => 'kv-grid-demo',
        'dataProvider' => (new \frontend\modules\sta\models\StaTestcaliSearch())->searchByTestSimple($model->codtest),
         'summary' => '',
        // 'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
        //'filterModel' => $searchAlumnos,
        'columns' => $gridColumns,
           //  'pjax' => true, // pjax is set to always true for this demo
            //'toggleDataContainer' => ['class' => 'btn-group mr-2'],
           /* 'panel' => [
        'type' => GridView::TYPE_WARNING,
        //'heading' => $heading,
    ],*/
    
    ]);
        //Pjax::end();
        ?>
        
    

    

    </div>
