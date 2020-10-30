<?php

use common\helpers\h;

use yii\helpers\Url;


use yii\helpers\Html;



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
                <span style="color:white;opacity:0.5;"><i class="fa fa-users"></i></span>
            </div>
            <?php 
            //$url=Url::to(['cantidades-en-riesgo']);
            echo Html::a(yii::t('base_labels','Details').'<i class="fa fa-arrow-circle-right"></i>','trtr', ['class'=>"botonAbre small-box-footer"]);
            ?>
            
          </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">  
           <div class="small-box bg-purple-gradient">
            <div class="inner">
              <h3>45</h3>

              <p><?php 
            
              echo yii::t('base_labels','Program') ?></p>
            </div>
            <div class="icon">
                <span style="color:white;opacity:0.5;"><i class="glyphicon glyphicon-scale"></i></span>
            </div>
            <?php 
            //$url=Url::to(['cantidades-en-riesgo']);
            echo Html::a(yii::t('base_labels','Details').'<i class="fa fa-arrow-circle-right"></i>',Url::to(['/inter/programa']), ['class'=>"small-box-footer"]);
            ?>
            
          </div>
         </div> 
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">  
             <div class="small-box bg-teal-gradient">
            <div class="inner">
              <h3>45</h3>

              <p><?php 
            
              echo yii::t('base_labels','Teachers') ?></p>
            </div>
            <div class="icon">
                <span style="color:white;opacity:0.5;"><i class="glyphicon glyphicon-list"></i></span>
            </div>
            <?php 
            //$url=Url::to(['cantidades-en-riesgo']);
            echo Html::a(yii::t('base_labels','Details').'<i class="fa fa-arrow-circle-right"></i>','trtr', ['class'=>"botonAbre small-box-footer"]);
            ?>
            
          </div>
        </div>     
</div>        
             
 <?php 
 echo $this->render('mapa_mundi');
 ?>     






     

</div>