<?php
    use kartik\detail\DetailView;
    use yii\helpers\Html;
    use frontend\modules\maestros\MaestrosModule as m;
    use common\models\masters\Combovalores;

    $this->title = m::t('verbs','View {name}',['name'=>$model->fullname()]);
    $this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Teachers'), 'url' => ['index-docentes']];
    $this->params['breadcrumbs'][] = $model->id;
    \yii\web\YiiAsset::register($this);    
?>
<h4> </h4>
<div class="trabajadores-view">
    <div class="box box-success">
        <div class="box-body">
            <p>
                <?= Html::a(m::t('verbs', 'Update'), ['update-docentes', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            </p>
            <?php 
                echo DetailView::widget(
                    [
                        'formOptions' => 
                        [
                            'id' => 'docentes-form',
                            'enableAjaxValidation' => true,
                            'fieldClass' => 'common\components\MyActiveField',
                        ] ,
                        'model'=>$model,
                        'condensed'=>true,
                        'hover'=>true,
                        'mode'=>DetailView::MODE_VIEW,
                        'panel'=>
                        [
                            'heading'=>m::t('labels','Teacher' ).'  '. $model->codoce,
                            'type'=>DetailView::TYPE_WARNING,
                        ],
                        'attributes'=>
                        [
                            [
                                'group'=>true,
                                'label'=>m::t('labels','Teacher Information'),
                                'groupOptions'=>['class'=>'alert alert-warning']
                            ], 
                            'codoce',
                            'nombres',        
                            'ap',
                            'am',                            
                            [
                                'attribute'=>'universidad_id',
                                'label'=>m::t('labels', 'University'),
                                'value'=>$model->universidad->nombre,
                            ],
                            [
                                'attribute'=>'facultad_id',
                                'label'=>m::t('labels', 'Faculty'),
                                'value'=>$model->facultad->desfac,
                            ],
                            [
                                'attribute'=>'tipodoc',
                                'label'=>m::t('labels', 'Document Type'),
                                'value'=> $model->tipodocumento,
                            ],
                            'numerodoc',
                             
                            /*
                            [
                                'group'=>true,
                                'label'=>yii::t('base.labels','Work data'),
                                'groupOptions'=>['class'=>'alert alert-warning']
                            ],           
                            ['attribute'=>'cumple', 'type'=>DetailView::INPUT_DATE],
                            ['attribute'=>'fecingreso', 'type'=>DetailView::INPUT_DATE],
                            'domicilio',
                            'telfijo',
                            'telmoviles',
                            'referencia',                             
                            */
                        ]
                    ]);
            ?>
        </div>
    </div>
</div>