<?php
//use dosamigos\chartjs\ChartJs;

use common\helpers\h;
use common\helpers\FileHelper;
use yii\helpers\Html;
  ?>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr >
                      <th colspan="6">
                          <p class="text-green"><span class="fa fa-paperclip"></span><?= yii::t('base_labels','Attached Files') ?></p>
                      </th> 
                    
                  </tr>
                  <tr>
                      <th>Adjunto</th> 
                      <th>Nombre Archivo</th> 
                      <th>Tipo</th> 
                      <th></th>
                      <th></th>
                      <th>Tamaño</th>
                     
                  </tr>
                  </thead>
                  <tbody>
                      
                   <?php 
                   $i=1;
          foreach ($model->files as $file) {
          
               ?>
              <tr> 
                  <td>
                   <?php 
                     $url=\yii\helpers\Url::toRoute(['/finder/selectimage',
                             'isImage'=>false,'idModal'=>'imagemodal',
                             'idGrilla'=>'pjaxuno','modelid'=>$model->id,
                              //'extension'=> \yii\helpers\Json::encode(array_merge(common\helpers\FileHelper::extDocs(),common\helpers\FileHelper::extImages())),
                             'nombreclase'=> str_replace('\\','_',get_class($model))]);
                        $options = [
                            'title' => Yii::t('sta.labels', 'Subir Archivo'),
                            //'aria-label' => Yii::t('rbac-admin', 'Activate'),
                            //'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                            'data-method' => 'get',
                            //'data-pjax' => '0',
                        ];
                        echo Html::button('<span class="glyphicon glyphicon-paperclip"></span>', ['href' => $url, 'title' => yii::t('base_verbs','Attach file'), 'class' => 'botonAbre btn btn-danger']);
                        //return Html::a('<span class="btn btn-success glyphicon glyphicon-pencil"></span>', Url::toRoute(['view-profile','iduser'=>$model->id]), []/*$options*/);
                     ?> 
                      
                      
                  </td>
                  <td><?=Html::a($file->name,$file->getUrl(), ['data-pjax'=>'0'])?></td>
                  <td><?=$file->type?></td>
                  <td><?=Html::a('<i style="font-size:2em;color:orange;"><span class="fa '.FileHelper::getIconDocs($file->type).'"></span></i>',$file->getUrl(), ['data-pjax'=>'0'])?></td>
                    <td>
                     <?=(FileHelper::isImage($file->getPath()))?Html::img($file->getUrl(),['width'=>100, 'height'=>80, 'class'=>'img-thumbnail cuaizquierdo']):'' ?>
                    </td>  
                  <td>
                     <?= FileHelper::formatBytes($file->size)?>
                    </td>
              </tr> 
           <?php $i++;} ?>   
                      
               
                  
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
 </div>   
<br>
<br>
<br>
<br>
<br>
<br>
<hr style="border: 1px dashed #4CAF50;" >

<br>
<br>