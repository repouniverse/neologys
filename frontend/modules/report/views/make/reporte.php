<?=$contenidoSinGrilla?>
<div style="position:absolute; width:80%; left:<?php echo $modelo->x_grilla; ?>px; top:<?php echo $modelo->y_grilla; ?>px">
<?php // echo $hojaestilo; yii::app()->end();
//var_dump($modelo->tienecabecera);
// ?>
  <?php 
if(count($columnas)>0)
echo \yii\grid\GridView::widget([
        'id'=>'detallerepoGrid',
    'summary' => '',
    'emptyCell'=>'',
     'showFooter' => true,
          'tableOptions'=>[/*'class'=>'table table-responsive no-margin'*/],
               'dataProvider' => $dataProvider,        
        'columns' =>$columnas ,
    // 'pager' => ['options'=>['visible'=>false]],
        ]
    ); ?>


</div>



