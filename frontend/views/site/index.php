<?php
use frontend\views\layouts\perfiles\alumnoAsset;
use common\helpers\h;
use yii\helpers\Url;
use conquer\jvectormap\JVectorMapWidget;
use yii\helpers\Html;
alumnoAsset::register($this);

?>
    
<h4><i style="font-size:30px;"><?=h::awe('globe').'</i>'.h::space(10).yii::t('base_labels','Welcome to International Module')?></h4>
<div class="box body body-success">
<div class="row">
       <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <div class="small-box bg-green-gradient">
            <div class="inner">
              <h3>60</h3>

              <p><?php echo yii::t('base_labels','Students') ?></p>
            </div>
            <div class="icon">
                <span style="color:white;opacity:0.5;"><i class="fa fa-file"></i></span>
            </div>
            <?php 
            //$url=Url::to(['cantidades-en-riesgo']);
            echo Html::a(yii::t('base_labels','Detalles').'<i class="fa fa-arrow-circle-right"></i>','trtr', ['class'=>"botonAbre small-box-footer"]);
            ?>
            
          </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">  
           <div class="small-box bg-yellow-gradient">
            <div class="inner">
              <h3>45</h3>

              <p><?php 
            
              echo yii::t('base_labels','Program') ?></p>
            </div>
            <div class="icon">
                <span style="color:white;opacity:0.5;"><i class="fa fa-user"></i></span>
            </div>
            <?php 
            //$url=Url::to(['cantidades-en-riesgo']);
            echo Html::a(yii::t('base_labels','Detalles').'<i class="fa fa-arrow-circle-right"></i>',Url::to(['/inter/programa']), ['class'=>"small-box-footer"]);
            ?>
            
          </div>
         </div> 
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">  
             <div class="small-box bg-light-blue">
            <div class="inner">
              <h3>45</h3>

              <p><?php 
            
              echo yii::t('base_labels','Teachers') ?></p>
            </div>
            <div class="icon">
                <span style="color:white;opacity:0.5;"><i class="fa fa-user"></i></span>
            </div>
            <?php 
            //$url=Url::to(['cantidades-en-riesgo']);
            echo Html::a(yii::t('base_labels','Detalles').'<i class="fa fa-arrow-circle-right"></i>','trtr', ['class'=>"botonAbre small-box-footer"]);
            ?>
            
          </div>
        </div>     
</div>        
             
      




<div class="map-container">
    <div id="world-map" class="jvmap-smart">   
<?php echo JVectorMapWidget::widget([
    //'id'=>'map1',
    'map'=>'world_mill_en',
    
    'options'=>[
        'backgroundColor'=>'#d9dde2;',
        'width'=>'600',
        'height'=>'600'
        ],
    
    'htmlOptions'=>[
        'id'=>'map1',
                ],
]); ?>
    
        
        
        
        
        
        <br>
     
</div>
</div>
</div>