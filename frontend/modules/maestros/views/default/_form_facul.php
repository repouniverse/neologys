<?php
use common\helpers\h;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\helpers\ComboHelper;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use backend\modules\base\Module as m;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
 USE yii\widgets\Pjax;
 use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model common\models\masters\Combovalores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="combovalores-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
        <?= Html::submitButton('<span class="fa fa-save"></span>    '.yii::t('base.verbs', 'Save'), ['class' => 'btn btn-success']) ?>
         <?=($model->isNewRecord)?'':common\widgets\auditwidget\auditWidget::widget(['model'=>$model])?>
        </div>
    </div>
    
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
     <?= $form->field($model, 'universidad_id')->
            dropDownList(ComboHelper::getCboUniversidades(),
                  ['prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                    // 'class'=>'probandoSelect2',
                      //'disabled'=>($model->isBlockedField('codpuesto'))?'disabled':null,
                        ]
                    ) ?>
        </div>
  
    
     <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
       <?= $form->field($model, 'codfac')->textInput(['maxlength' => true]) ?>
         
    </div>
    
    
    
    <div class="col-lg-3 col-md-8 col-sm-6 col-xs-12">
        <?= $form->field($model, 'desfac')->textInput(['maxlength' => true]) ?>
    </div>
    
   

    <?php ActiveForm::end(); ?>
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php echo ".";  ?>
    </div>
<?php if(!$model->isNewRecord) {  ?>
<?php Pjax::begin(['id'=>'grilla-facus','timeout'=>false]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

    <?= GridView::widget([
        'id'=>'mi-grilla',
        'dataProvider' => new \yii\data\ActiveDataProvider(
                [
                    'query'=> \common\models\masters\Departamentos::find()->andWhere(['codfac'=>$model->codfac])
                ]
                ),
        //'filterModel' => $searchModel,
        'columns' => [
             [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}{update}',
                'buttons' => [
                   
                         'update' => function ($url,$model) {
			    $url= Url::to(['modal-update-depa','id'=>$model->coddepa,'gridName'=>'grilla-facus','idModal'=>'buscarvalor']);
                             //echo  Html::button(yii::t('base.verbs','Modificar Rangos'), ['href' => $url, 'title' => yii::t('sta.labels','Agregar Tutor'),'id'=>'btn_contacts', 'class' => 'botonAbre btn btn-success']); 
                            return Html::a('<span class="btn btn-success btn-sm glyphicon glyphicon-pencil"></span>', $url, ['class'=>'botonAbre']);
                            },
                          
                         'delete' => function ($url,$model) {
			    $url = Url::toRoute($this->context->id.'/ajax-detach-psico',['id'=>$model->coddepa]);
                             return Html::a('<span class="btn btn-danger btn-sm glyphicon glyphicon-trash"></span>', '#', ['title'=>$url,/*'id'=>$model->codparam,*/'family'=>'holas','id'=> \yii\helpers\Json::encode(['id'=>$model->codfac,'modelito'=> str_replace('@','\\',get_class($model))]),/*'title' => 'Borrar'*/]);
                            }
                    ]
                ],
            'coddepa',
            'nombredepa',
            //'parametro',
            
            //'valor1',
            //'valor2',

            
        ],
    ]); ?>
    
    <?php 
   echo linkAjaxGridWidget::widget([
         
            'idGrilla'=>'migrillaPjaxS',
            'family'=>'holas',
          'type'=>'POST',
           'evento'=>'click',
           'posicion'=> \yii\web\View::POS_END
           
        ]); 
   ?>
    
    
    <?php Pjax::end(); ?>
      <p>
         <?php $url= Url::to(['modal-new-depa','id'=>$model->codfac,'gridName'=>'grilla-facus','idModal'=>'buscarvalor']);
                             //echo  Html::button(yii::t('base.verbs','Modificar Rangos'), ['href' => $url, 'title' => yii::t('sta.labels','Agregar Tutor'),'id'=>'btn_contacts', 'class' => 'botonAbre btn btn-success']); 
                            echo Html::a('<span class="btn btn-success btn-sm glyphicon glyphicon-plus"></span>', $url, ['class'=>'botonAbre']);
                              ?>           
       </p>
<?php } ?>
</div>
