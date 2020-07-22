<?php 
use yii\helpers\Html;
?>
<?php 
 $url=\yii\helpers\Url::toRoute(['/'.$controllerName.'/'.$actionName,'isImage'=>false,'idModal'=>'imagemodal','modelid'=>$model->{$attribute},'nombreclase'=> str_replace('\\','_',$model::className())]);
      
 echo Html::button('<span class="fa fa-list"></span>', ['href' => $url, 'title' => 'Auditoría', 'class' => 'botonAbre btn btn-success']);
  //return Html::a('<span class="btn btn-success glyphicon glyphicon-pencil"></span>', Url::toRoute(['view-profile','iduser'=>$model->id]), []/*$options*/);
                     
                       
?>
