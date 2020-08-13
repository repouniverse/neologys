<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\base\Module as m;
/* @var $model \app\models\forms\ConfigurationForm */
/* @var $this \yii\web\View */

$this->title = m::t('labels', 'Manage Application Settings');
?>
<?php $form = ActiveForm::begin(); ?>

<?php echo $form->field($model, 'appName'); ?>

<?php echo $form->field($model, 'adminEmail'); ?>

<?php echo Html::submitButton(m::t('verbs', 'Save'), ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end(); ?>
