<?php

use yii\helpers\Html;
use common\helpers\comboHelper;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\grid\GridView;
//use kartik\grid\GridView;
use common\models\masters\Matricula;
use common\models\FormatoDocs;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\helpers\Url;
 use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;

/* @var $this yii\web\View */
/* @var $model common\models\masters\AsesoresCurso */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
echo \common\widgets\spinnerWidget\spinnerWidget::widget();
?>
<h4><?=yii::t('base_labels','Advisor panel')?></h4>
<div class="box box-succes">
<div class="box-body">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-6"> 
	    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	 <?php //echo $form->field($modelDocente, 'id')->label(\Yii::t('base_labels','Race'))->textInput(['disabled'=>true,'value'=> $modelDocente->carrera->nombre]) ?>	
	 </div> 
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
	 <?= $form->field($modelDocente, 'id')->label(\Yii::t('base_labels','Full Name'))->textInput(['disabled'=>true,'value'=> $modelDocente->fullName()]) ?>
	 </div>
	 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	 <?= $form->field($modelDocente, 'codoce')->label(\Yii::t('base_labels','Registration number'))->textInput(['disabled'=>true]) ?>	
	 </div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6"> 
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <br>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                 <?php 
                echo Html::img($modelDocente->image($modelDocente->codoce),['width'=>180,'height'=>240, 'class'=>"img-thumbnail cuaizquierdo"]);
                    ?>
            </div>
	   
	
	</div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <?php 
    $docus=FormatoDocs::find()->where(['in','codocu',['159','160']])->all();
        foreach($docus as $docu){
           ?>
            <a href="<?=$docu->urlFirstFile?>" class="btn btn-danger btn-sm" >
                <span class="glyphicon glyphicon-download"></span>
                   <?=yii::t('base_verbs','Download').' '.strtolower($docu->descripcion)?>
            </a>
            
         <?PHP 
        }   
        
        ?> 
        </div>
    
        <div style="margin-top: 10px;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
        <?php 
    $docus2=FormatoDocs::find()->where(['in','codocu',['161','162']])->all();
        foreach($docus2 as $docu){
            if($docu->codocu == '162'){
                if ($docu->hasAttachments()) {
                    $url = Url::toRoute([
                        '/finder/selectimage',
                        'isImage' => false,
                        'idModal' => 'imagemodal',
                        'idGrilla' => 'mi_grilla',
                        'modelid' => $docu->id,
                        'extension' => Json::encode(['docx']),
                        'nombreclase' => str_replace('\\', '_', get_class($docu))
                    ]);
                    $options = [
                        'title' => Yii::t('base_labels', 'Upload File'),
                        //'aria-label' => Yii::t('rbac-admin', 'Activate'),
                        //'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                        'data-method' => 'get',
                        //'data-pjax' => '0',
                    ];
                     
                    echo Html::button('<span class="glyphicon glyphicon-paperclip"></span>', ['href' => $url, 'class' => 'botonAbre btn btn-success']);
                } else {
                    //$url=$model->urlFirstFile;
                     echo Html::a('<span class="glyphicon glyphicon-save"></span>', $docu->urlFirstFile, ['data-pjax' => '0', 'class' => 'btn btn-warning']);
                }
            }
           ?>
            <a href="<?=$docu->urlFirstFile?>" class="btn btn-info btn-sm" >
                <span class="glyphicon glyphicon-download"></span>
                   <?=yii::t('base_verbs','Download').' '.strtolower($docu->descripcion)?>
            </a>
            
         <?PHP 
        }   
        
        ?> 

        <?php 
            
        
        ?>
        </div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
	<?php Pjax::begin(['id'=>'mi_grilla']); ?>
    
            
        
            
    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query'=> frontend\modules\repositorio\models\RepoVwAsesoresAsignados::find()->
                andWhere([
                    'docente_id'=>$modelDocente->id,
                    //'activo'=>'1'
                    ]),
                        ]),
            'summary'=>'',
            'columns' => [
                   
                    //'codcur',
                    'descripcion',
                    'seccion',
                   'codesp',
                   'codalu',
                    'ap',
                    'nombres',
                [
                    'format'=>'raw',
                    'value'=>function($model){
                       $links=$model->listAttachedFiles();
                       $cadenaHtml='';
                       foreach($links as $codocu=>$link){
                          $cadenaHtml.=Html::a($codocu,$link,['data-pjax'=>'0','class'=>'btn btn-success']).'<br>';
                       }
                       return $cadenaHtml;
                    },
                ],
                 
                [
                    'format'=>'raw',
                    'value'=>function($model){                       
                         return Html::a('<span class="glyphicon glyphicon-folder-open"></span>',Url::to(['manage-attachments','id'=>$model->id]),['data-pjax'=>'0','class' => 'btn btn-warning']);         
                       
                    },
                ]            
                            
                            
                            
                            
                            
           
              ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
        
        
     
</div>
   


    <?php ActiveForm::end(); ?>


</div>
 </div>

