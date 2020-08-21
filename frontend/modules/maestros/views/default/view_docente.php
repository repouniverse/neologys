<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\modules\maestros\MaestrosModule as m;

$this->title = $model->fullname();
$this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Teachers'), 'url' => ['index-docentes']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="documentos-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(m::t('verbs', 'Update'), ['update-docentes', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>        
    </p>
    <?= DetailView::widget
        (   
            [
                'model' => $model,
                'attributes' => 
                [
                    'codoce',
                    'ap',
                    'am',
                    'nombres',
                    ['attribute'=>m::t('labels', 'University'),
                     'value'=> function($model)
                               {
                                return $model->universidad->nombre;
                               }
                    ],
                    ['attribute'=>m::t('labels', 'Faculty'),
                     'value'=> function($model)
                               {
                                return $model->facultad->desfac;
                               }
                    ],
                ],
            ]
        )
    ?>
</div>
    