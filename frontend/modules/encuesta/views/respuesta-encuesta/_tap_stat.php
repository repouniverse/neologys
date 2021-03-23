<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\tabs\TabsX;
use common\helpers\h;
use yii\widgets\ActiveForm;
use common\widgets\inputajaxwidget;
?>
<?php $form = ActiveForm::begin(); ?>
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
                                'label'=>'<i class="fa fa-users"></i> '.yii::t('base_labels','Encuestados'),
                                'content'=> $this->render('respuestas', [
                                    'identidad_unidad' => $identidad_unidad ]),
                                'active' => true,
                                'options' => ['id' => 'myvnID3'],
                            ],
                            [
                                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> '.yii::t('base_labels','Preguntas'),
                                'content'=> $this->render('_stat', [
                                    'identidad_unidad' => $identidad_unidad ]),
                                    'active' => false,
                                    'options' => ['id' => 'movrfggfwnrerID4'],
                            ],
                            
                            
                        ],
                    ]
                  );  
            ?>
 <?php ActiveForm::end(); ?>

