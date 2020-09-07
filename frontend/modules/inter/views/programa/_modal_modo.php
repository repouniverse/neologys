<?php
    use common\helpers\h;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use common\helpers\ComboHelper;
    use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
    use frontend\modules\inter\Module as m;
    use common\widgets\selectwidget\selectWidget;
?>
    <div class="box box-success">
        <div class="box-body">
            <div class="combovalores-form">
                <?php $form = ActiveForm::begin(['id'=>'form-pico', 'fieldClass'=>'\common\components\MyActiveField']); ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?= \common\widgets\buttonsubmitwidget\buttonSubmitWidget::widget
                        (
                            [
                                'idModal'=>$idModal,
                                'idForm'=>'form-pico',
                                'url'=> ($model->isNewRecord)?\yii\helpers\Url::to
                                        (
                                            [
                                                '/inter/programa/modal-new-modo','id'=>$model->programa_id
                                            ]
                                        ):\yii\helpers\Url::to(['/inter/programa/modal-edit-modo','id'=>$model->id]),
                                'idGrilla'=>$gridName, 
                            ]
                        )
                    ?>
                    <?=($model->isNewRecord)?'':common\widgets\auditwidget\auditWidget::widget(['model'=>$model])?>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?=$form->field($model, 'modelofuente')->
                        dropDownList
                        (
                            ComboHelper::getCboModels(),
                            [
                                'prompt'=>'--'.yii::t('base.verbs','Choose a Value')."--",
                            ]
                        )
                    ?>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <?= $form->field($model, 'acronimo')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
                    <?= $form->field($model, 'detalles')->textArea([]) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>