<?php
use common\helpers\h;
use yii\helpers\Url;
use yii\helpers\Html;


?>
 <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">             
              <div  class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?php 
               echo \common\widgets\imagerenderwidget\imageRenderWidget::widget([
            
                'src'=>$identidad->image($identidad->code()),
                ]
                    ); ?>
              </div>
            
           <div  class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
              <div style="line-height: 100px;     color: #292628;
                    text-shadow: 0px 0px 2px rgb(186 139 189 / 94%);
     font-size: 19px;">
               <?=$identidad->fullName() ?>
               </div>
              </div>
 </div>
<div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
    <br><br><br>
  </div>   
<div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">             
              <div  class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <div class="info-box bg-teal-gradient">
                            <?php echo Html::a('<span class="info-box-icon"><i class="fa fa-globe"></i></span>',Url::to(['/inter/default/postulacion']),['style'=>'color:white;']); ?>
                            
                                <div class="info-box-content">
                                        <span class="info-box-text"><?=yii::t('base_labels','International')?></span>
                                        <br>

                                                            <div class="progress">
                                                            <div class="progress-bar" style="width: 0%"></div>
                                                            </div>
                                                            <span class="progress-description">
                                            
                                                            </span>
                                </div>
            <!-- /.info-box-content -->
                       </div>
              </div>
            
             <div  class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                     <div class="info-box bg-teal-gradient">
                            <?php echo Html::a('<span class="info-box-icon"><i class="fa fa-user-circle"></i></span>',Url::to(['/repositorio/asesorescurso/create']),['style'=>'color:white;']); ?>
                                <div class="info-box-content">
                                        <span class="info-box-text"><?=yii::t('base_labels','Advisory')?></span>
                                        <br>

                                                            <div class="progress">
                                                            <div class="progress-bar" style="width: 0%"></div>
                                                            </div>
                                                            <span class="progress-description">
                                            
                                                            </span>
                                </div>
            <!-- /.info-box-content -->
                       </div>
              </div>
              <div  class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                     <div class="info-box bg-teal-gradient">
                            <?php echo Html::a('<span class="info-box-icon"><i class="fa fa-cogs"></i></span>',Url::to(['/site/profile']),['style'=>'color:white;']); ?>
                            
                                <div class="info-box-content">
                                        <span class="info-box-text"><?=yii::t('base_labels','International')?></span>
                                        <br>

                                                            <div class="progress">
                                                            <div class="progress-bar" style="width: 0%"></div>
                                                            </div>
                                                            <span class="progress-description">
                                            
                                                            </span>
                                </div>
            <!-- /.info-box-content -->
                       </div>
              </div>
              
 </div>
<div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">             
              <div  class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        
              </div>
            
             <div  class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                    
              </div>
              <div  class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                 
              </div>
              <div  class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                         
              </div>
 </div>