<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\masters\AsesoresCursoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Error');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asesores-curso-index">

    <h4><?= Html::encode($this->title) ?></h4>
<div class="box box-success">
   
<div class="bg-warning">
<?=Yii::t('base_errors','You are not a student') ?>

</div>
</div>
