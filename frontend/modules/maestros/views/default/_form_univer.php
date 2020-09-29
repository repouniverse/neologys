<?php
    use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
    use yii\helpers\Url;
    use common\helpers\h;
    use common\helpers\ComboHelper;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use kartik\date\DatePicker;
    use yii\widgets\Pjax;
    use yii\grid\GridView;
    use frontend\modules\maestros\MaestrosModule as m;
?>

<div class="box box-success">
    <?php $form = ActiveForm::begin
                  (
                    [
                        'id' => 'trabajadores-form',
                        'enableAjaxValidation' => true,
                        'fieldClass' => 'common\components\MyActiveField',
                    ]
                  );
    ?>
    
    
    <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                <?= Html::submitButton(m::t('verbs', 'Save'), ['class' => 'btn btn-success']) ?>
                <?=($model->isNewRecord)?'':common\widgets\auditwidget\auditWidget::widget(['model'=>$model])?>       
            </div>
        </div>
    </div>
       
    <div class="box-body">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">    
            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>    
            <?=$form->field($model, 'codpais')->label(m::t('labels','Country'))->
                      dropDownList
                      (
                        ComboHelper::getCboPaises(),
                        ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",]
                      )  
            ?>
        </div>
        
        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($model, 'acronimo')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($model, 'latitud')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($model, 'meridiano')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
            <?= \common\widgets\imagewidget\ImageWidget::widget(['name'=>'imagenrep','model'=>$model]); ?>
        </div>   
    
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'detalle')->textarea([]) ?>
        </div> 
        <?php ActiveForm::end(); ?>

        <?php if(!$model->isNewRecord) {  ?>
        <?php Pjax::begin(['id'=>'grilla-facus','timeout'=>false]); ?>
        <?= GridView::widget
            (
                [
                    'id'=>'mi-grilla',
                    'dataProvider' => new \yii\data\ActiveDataProvider
                    (
                        [
                            'query'=> \common\models\masters\Facultades::find()->andWhere(['universidad_id'=>$model->id])
                        ]
                    ),
        
                    'columns' => 
                    [
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{delete}{update}',
                            'buttons' => 
                            [                   
                                'update' => function ($url,$model) 
                                            {
                                                $url= Url::to(['modal-update-facultad','id'=>$model->id,'gridName'=>'grilla-facus','idModal'=>'buscarvalor']);
                                                return Html::a('<span class="btn btn-success btn-sm glyphicon glyphicon-pencil"></span>', $url, ['class'=>'botonAbre']);
                                            },                          
                                'delete' => function ($url,$model) 
                                            {
                                                $url = Url::toRoute($this->context->id.'/ajax-detach-psico',['id'=>$model->codfac]);
                                                return Html::a('<span class="btn btn-danger btn-sm glyphicon glyphicon-trash"></span>', '#', ['title'=>$url,/*'id'=>$model->codparam,*/'family'=>'holas','id'=> \yii\helpers\Json::encode(['id'=>$model->codfac,'modelito'=> str_replace('@','\\',get_class($model))]),]);
                                            }
                            ]
                        ],
                        'codfac',
                        'desfac',
                    ],
                ]
            ); 
        ?>
    
        <?php 
            echo linkAjaxGridWidget::widget
                 (
                    [        
                        'idGrilla'=>'migrillaPjaxS',
                        'family'=>'holas',
                        'type'=>'POST',
                        'evento'=>'click',
                        'posicion'=> \yii\web\View::POS_END           
                    ]
                 ); 
        ?>
    
    
    <?php Pjax::end(); ?>
        <p>
            <?php 
                $url= Url::to(['modal-new-facultad','id'=>$model->id,'gridName'=>'grilla-facus','idModal'=>'buscarvalor']);
                echo Html::a('<span class="btn btn-success btn-sm glyphicon glyphicon-plus"></span>', $url, ['class'=>'botonAbre']);
            ?>           
       </p>
    <?php } ?>
    </div>
</div>