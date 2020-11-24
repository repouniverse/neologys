<?php
use common\helpers\h;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php

   $this->title = yii::t('base_labels', 'Other profile');
    $this->params['breadcrumbs'][] = ['label' => yii::t('base_labels', 'Users'), 'url' => ['index']];
   // $this->params['breadcrumbs'][] = ['label' => yii::t('base_labels', 'My Profile'), 'url' => ['profile']];
    //$this->params['breadcrumbs'][] = m::t('verbs', 'Update');
?>

<div class="siteee-login">
    <h4><?= Html::encode($this->title) ?></h4>

    
    <div class="box box-success">
        <div class="alert bg-warning">
            <?=yii::t('base_errors','{fullname} at the moment you are not in the application process for the mobility program.',['fullname'=>$identidad->fullName()] )?>

        </div>

    </div>
</div>
