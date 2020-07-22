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
                      <th colspan="3"><p class="text-green"><span class="fa fa-paperclip"></span>      Material de la sesión</p></th> 
                    
                  </tr>
                  <tr>
                      <th>Nombre Archivo</th> 
                      <th>Tipo</th> 
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
                  <td><?=Html::a($file->name,$file->getUrl(), ['data-pjax'=>'0'])?></td>
                  <td><?=$file->type?></td>
                  <td><?=Html::a('<i style="font-size:2em;color:orange;"><span class="fa '.FileHelper::getIconDocs($file->type).'"></span></i>',$file->getUrl(), ['data-pjax'=>'0'])?></td>
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