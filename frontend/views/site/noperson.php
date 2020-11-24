<?php
use common\helpers\h;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php

   $this->title = yii::t('base_labels', 'Other profile');
    $this->params['breadcrumbs'][] = ['label' => yii::t('base_labels', 'Users'), 'url' => ['view-users']];
   // $this->params['breadcrumbs'][] = ['label' => yii::t('base_labels', 'My Profile'), 'url' => ['profile']];
    //$this->params['breadcrumbs'][] = m::t('verbs', 'Update');
?>

<div class="siteee-login">
    <h4><?= Html::encode($this->title) ?></h4>

    
    <div class="box box-success">
        <div class="alert bg-warning">
            <?=yii::t('base_errors','Your user account "{user}" is not associated with a person',['user'=>h::userName()] )?>

        </div>

    </div>
</div>
