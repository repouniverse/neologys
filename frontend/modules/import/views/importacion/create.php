<?php

use yii\helpers\Html;
use frontend\modules\import\ModuleImport as m;
/* @var $this yii\web\View */
/* @var $model frontend\modules\import\models\ImportCargamasiva */

$this->title = m::t('m_import', 'Create Import');
$this->params['breadcrumbs'][] = ['label' => m::t('m_import', 'Imports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="import-cargamasiva-create">

    <h4><?= Html::encode($this->title) ?></h4>

    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


    
</div>