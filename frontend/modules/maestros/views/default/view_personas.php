<?php
    use kartik\detail\DetailView;
    use yii\helpers\Html;
    use frontend\modules\maestros\MaestrosModule as m;
    
    $this->title = m::t('verbs','View {name}',['name'=>$model->nombrecompleto]);
    $this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Persons'), 'url' => ['index-persona']];
    $this->params['breadcrumbs'][] = $model->id;
    \yii\web\YiiAsset::register($this);
?>
    <h4> </h4>
    <div class="trabajadores-view">
        <div class="box box-success">
        <div class="box-body">
        <p>
            <?= Html::a(m::t('verbs', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </p>
        <?php 
            echo DetailView::widget(
                [
                    'formOptions' => 
                    [
                        'id' => 'trabajadores-form',
                        'enableAjaxValidation' => true,
                        'fieldClass' => 'common\components\MyActiveField',
                    ] ,
                    'model'=>$model,
                    'condensed'=>true,
                    'hover'=>true,
                    'mode'=>DetailView::MODE_VIEW,
                    'panel'=>
                    [
                        'heading'=>m::t('labels','Person' ).'  '. $model->codigoper,
                        'type'=>DetailView::TYPE_WARNING,
                    ],
                    'attributes'=>
                    [
                        [
                            'group'=>true,
                            'label'=>m::t('labels','Person Information'),
                            'groupOptions'=>['class'=>'alert alert-warning']
                        ],
                        'nombres',        
                        'ap',
                        'am',
                        'numerodoc',
                        [
                            'group'=>true,
                            'label'=>m::t('labels','Work Data'),
                            'groupOptions'=>['class'=>'alert alert-warning']
                        ],  
                        ['attribute'=>'cumple', 'type'=>DetailView::INPUT_DATE],
                        ['attribute'=>'fecingreso', 'type'=>DetailView::INPUT_DATE],
                        'domicilio',
                        'telfijo',
                        'telmoviles',
                        'referencia',
                    ]
                ]);
        ?>    
        </div>
    </div>
</div>
