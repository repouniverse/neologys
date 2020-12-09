<?php

use yii\helpers\Html;
use kartik\tabs\TabsX;
use common\helpers\h;
/* @var $this yii\web\View */
/* @var $model frontend\modules\acad\models\AcadSyllabus */

$this->title = Yii::t('base_labels', 'Update Acad Syllabus: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'Acad Syllabi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('base_labels', 'Update');
?>


    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-body">
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
                                'label'=>'<i class="fa fa-home"></i> '.yii::t('base_labels','Main'),
                                'content'=> $this->render('_form',['model' => $model]),
                                'active' => true,
                                'options' => ['id' => 'myvnID3'],
                            ],
                            [
                                'label'=>'<i class="'.h::awe('users').'"></i> '.yii::t('base_labels','Types'),
                                'content'=> $this->render('_aprobaciones',['model' => $model]),
                                'active' => false,
                                'options' => ['id' => 'movrwnID4'],
                            ],       
                            
                        ],
                    ]
                  );  
            ?>

</div>
