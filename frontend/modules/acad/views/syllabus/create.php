<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\acad\models\AcadSyllabus */

$this->title = Yii::t('base_labels', 'Create Acad Syllabus');
$this->params['breadcrumbs'][] = ['label' => Yii::t('base_labels', 'Acad Syllabi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acad-syllabus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
