<?php
use common\widgets\calendarWidget\CalendarScheduleWidget;
use yii\web\JsExpression;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\modules\inter\models\InterEntrevistas;
use yii\widgets\ActiveForm;
use common\helpers\h;
use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\modules\inter\Module as m;
use common\widgets\buttonajaxwidget\buttonAjaxWidget;
/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Talleres */
/* @var $form yii\widgets\ActiveForm */
?>
<br>
<BR>

<div class="box box-success">
<div class="box-body">
<?php 
/* @var $this yii\web\View */
/* @var $model frontend\modules\sta\models\Talleres */
ECHO \common\widgets\spinnerWidget\spinnerWidget::widget();
/* @var $this yii\web\View */
/* @var $model frontend\modules\inter\models\InterConvocados */

$this->title = Yii::t('base_labels', 'Complete stage: {name}', [
    'name' => $model->persona->fullName(),
]);
//$this->params['breadcrumbs'][] = ['label' => substr($model->programa->descripcion,0,10), 'url' => ['/inter/programa/update', 'id' => $model->programa->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'My panel'), 'url' => [h::user()->resolveUrlAfterLogin()]];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
///$this->params['breadcrumbs'][] = Yii::t('base_labels', 'Update');
?>



 




  
   
      <?php 
//$plan=$current_expediente->plan;

echo $this->render('@frontend/modules/inter/views/convocados/_progress_convocado',['identidad'=>$model->persona->identidad]);
?> .. 
    <div  class="aviso-success">
        <?php echo m::t('labels','Congratulations, you have completed the stage {etapa}',['etapa'=> frontend\modules\inter\models\InterEtapas::findOne($model->rawCurrentStage())->descripcion]);    ?>
    </div>
        
</div>
    </div>
      