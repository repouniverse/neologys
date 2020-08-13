<?php
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii2mod\editable\EditableColumn;
use yii2mod\settings\models\enumerables\SettingStatus;
use yii2mod\settings\models\enumerables\SettingType;
use yii2mod\settings\models\SettingModel;
use backend\modules\base\Module as m;
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $searchModel \yii2mod\settings\models\search\SettingSearch */

$this->title = m::t('labels', 'Settings').'-'.$seccion;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-index">
    <h4><?php echo Html::encode($this->title); ?></h4>
<div class="box box-success">
   <div class="box-body">
    <p><?php echo Html::a(m::t('labels', 'Create Setting'), ['create'], ['class' => 'btn btn-success']); ?></p>
    <?php Pjax::begin(['timeout' => 10000, 'enablePushState' => false]); ?>
    <?php echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                ],
                [
                    'attribute' => 'type',
                    'filter' => SettingType::listData(),
                    'filterInputOptions' => ['prompt' => m::t('labels', 'Select Type'), 'class' => 'form-control'],
                ],
               /* [
                    'attribute' => 'section',
                    'filter' => ArrayHelper::map(SettingModel::find()->select('section')->distinct()->all(), 'section', 'section'),
                    'filterInputOptions' => ['prompt' => Yii::t('yii2mod.settings', 'Select Section'), 'class' => 'form-control'],
                ],*/
                'key',
               // 'value:ntext',
                [
                    'class' => EditableColumn::class,
                    'attribute' => 'value',
                    'url' => ['ajax-edit-setting-value'],
                    'value' => function ($model) {
                        return $model->value;
                    },
                    //'type' => 'select',
                   /* 'editableOptions' => function ($model) {
                        return [
                            'source' => SettingStatus::listData(),
                            'value' => $model->status,
                        ];
                    },*/
                    //'filter' => SettingStatus::listData(),
                    //'filterInputOptions' => ['prompt' => Yii::t('yii2mod.settings', 'Select Status'), 'class' => 'form-control'],
                ],
               /* [
                    'class' => EditableColumn::class,
                    'attribute' => 'status',
                    'url' => ['edit-setting'],
                    'value' => function ($model) {
                        return SettingStatus::getLabel($model->status);
                    },
                    'type' => 'select',
                    'editableOptions' => function ($model) {
                        return [
                            'source' => SettingStatus::listData(),
                            'value' => $model->status,
                        ];
                    },
                    'filter' => SettingStatus::listData(),
                    'filterInputOptions' => ['prompt' => Yii::t('yii2mod.settings', 'Select Status'), 'class' => 'form-control'],
                ],*/
                [
                    'class' => EditableColumn::class,
                    'attribute' => 'description',
                    'url' => ['ajax-edit-setting-value'],
                    'value' => function ($model) {
                        return $model->description;
                    },
                    'type' => 'textarea',
                   /* 'editableOptions' => function ($model) {
                        return [
                            'source' => SettingStatus::listData(),
                            'value' => $model->status,
                        ];
                    },*/
                    //'filter' => SettingStatus::listData(),
                    //'filterInputOptions' => ['prompt' => Yii::t('yii2mod.settings', 'Select Status'), 'class' => 'form-control'],
                ],
                /*[
                    'header' => Yii::t('yii2mod.settings', 'Actions'),
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update}{delete}',
                ],*/
            ],
        ]
    ); ?>
    <?php Pjax::end(); ?>
</div>
    </div>
    </div>

