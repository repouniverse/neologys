<?php
use common\helpers\h;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use frontend\modules\maestros\MaestrosModule as m;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use yii\widgets\Pjax;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model common\models\masters\Combovalores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="combovalores-form"> 
<?php $nombreGrilla= 'fer_sal';  ?>
<?php Pjax::begin(['id'=>$nombreGrilla,'timeout'=>false]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

    <?= GridView::widget([
        'id'=> uniqid(),
        'dataProvider' => new \yii\data\ActiveDataProvider(
                [
                    'query'=> \common\models\masters\Carreras::find()->andWhere(['facultad_id'=>$model->id])
                ]
                ),
        //'filterModel' => $searchModel,
        'columns' => [
             [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}{update}',
                'buttons' => [
                   
                         'update' => function ($url,$model) use($nombreGrilla) {
			    $url= Url::to(['modal-edit-carrera','id'=>$model->id,'gridName'=>$nombreGrilla,'idModal'=>'buscarvalor']);
                             //echo  Html::button(yii::t('base.verbs','Modificar Rangos'), ['href' => $url, 'title' => yii::t('sta.labels','Agregar Tutor'),'id'=>'btn_contacts', 'class' => 'botonAbre btn btn-success']); 
                            return Html::a('<span class="btn btn-success btn-sm glyphicon glyphicon-pencil"></span>', $url, ['class'=>'botonAbre']);
                            },
                          
                         'delete' => function ($url,$model) {
			    $url = Url::toRoute($this->context->id.'/ajax-detach-psico',['id'=>$model->id]);
                             return Html::a('<span class="btn btn-danger btn-sm glyphicon glyphicon-trash"></span>', '#', ['title'=>$url,/*'id'=>$model->codparam,*/'family'=>'holas','id'=> \yii\helpers\Json::encode(['id'=>$model->id,'modelito'=> str_replace('@','\\',get_class($model))]),/*'title' => 'Borrar'*/]);
                            }
                    ]
                ],
            'codesp',
            'nombre',
            'acronimo',
            
            //'valor1',
            //'valor2',

            
        ],
    ]); ?>
    
    <?php 
   echo linkAjaxGridWidget::widget([
         
            'idGrilla'=>$nombreGrilla,
            'family'=>'holas',
          'type'=>'POST',
           'evento'=>'click',
           'posicion'=> \yii\web\View::POS_END
           
        ]); 
   ?>
    
    
    <?php Pjax::end(); ?>
      <p>
         <?php $url= Url::to(['modal-new-carrera','id'=>$model->id,'gridName'=>$nombreGrilla,'idModal'=>'buscarvalor']);
                             //echo  Html::button(yii::t('base.verbs','Modificar Rangos'), ['href' => $url, 'title' => yii::t('sta.labels','Agregar Tutor'),'id'=>'btn_contacts', 'class' => 'botonAbre btn btn-success']); 
                            echo Html::a('<span class="btn btn-success btn-sm glyphicon glyphicon-plus"></span>', $url, ['class'=>'botonAbre']);
                              ?>           
       </p>

</div>

