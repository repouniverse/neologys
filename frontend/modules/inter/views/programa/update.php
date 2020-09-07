<?php
    use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
    use kartik\tabs\TabsX;
    use frontend\modules\inter\Module as m;
    use yii\widgets\Pjax;
    use yii\grid\GridView;
    use yii\helpers\Url;
    use yii\helpers\Html;
    echo \common\widgets\spinnerWidget\spinnerWidget::widget();

    $this->title = m::t('labels', 'Update Inter Program: {name}', ['name' => $model->id,]);
    $this->params['breadcrumbs'][] = ['label' => m::t('labels', 'Inter Programs'), 'url' => ['index']];
    $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
    $this->params['breadcrumbs'][] = m::t('verbs', 'Update');
?>
    <div class="inter-programa-update">
        <h4><i class="fa fa-edit"></i><?= Html::encode($this->title) ?></h4>   
        <div class="box box-success">    
            <?php echo TabsX::widget
                  (
                    [
                        'position' => TabsX::POS_ABOVE,
                        'bordered'=>true,
                        'align' => TabsX::ALIGN_LEFT,
                        'encodeLabels'=>false,
                        'items' =>
                        [
                            [
                                'label'=>'<i class="fa fa-home"></i> '.m::t('labels','Main'),
                                'content'=> $this->render('_form',['model' => $model]),
                                'active' => true,
                                'options' => ['id' => 'myveryownID3'],
                            ],
                            [
                                'label'=>'<i class="fa fa-users"></i> '.m::t('labels','Types'),
                                'content'=> $this->render('_modos',['model' => $model]),
                                'active' => false,
                                'options' => ['id' => 'myveryovrwnID4'],
                            ],       
                            [
                                'label'=>'<i class="fa fa-users"></i> '.m::t('labels','Evaluators'),
                                'content'=> $this->render('_evaluadores',['model' => $model]),
                                'active' => false,
                                'options' => ['id' => 'myveryggvrwnID68'],
                            ],
                            [
                                'label'=>'<i class="fa fa-users"></i> '.m::t('labels','Stages'),
                                'content'=> $this->render('_etapas',['model' => $model]),
                                'active' => false,
                                'options' => ['id' => 'myverygererrwnID68'],
                            ],
                        ],
                    ]
                  );  
            ?>
        </div>
    </div>