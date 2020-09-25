<?php 
use yii\widgets\Pjax;
use kartik\editable\Editable;
use yii\helpers\Html;
  ?>
<div style="overflow:auto;" >
<?php Pjax::begin(['id'=>'manita']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= kartik\grid\GridView::widget([
        'id'=>'detallerepoGrid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{editar}',
                'buttons' => [
	
                 'editar' => function ($url,$model) {
			    $url = \yii\helpers\Url::to(['updatedetallerepo','id'=>$model->id,'nombregrilla'=>'detalleRepoGrid']);
                             return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['class'=>'botonAbre']);
                            }
                        ],
            ],
           
            'nombre_campo',
             'aliascampo',
            //'tipodato',
            [
                        'class' => 'kartik\grid\EditableColumn',
                
                        'editableOptions'=>[
                            'pjaxContainerId'=>'manita',
                            //'format' => Editable::FORMAT_BUTTON,
                            'inputType' => Editable::INPUT_DROPDOWN_LIST,
                          'data'=>['1'=>'Yes','0'=>'No'],  
                                            ],
                        'attribute' => 'esdetalle',
                            //'pageSummary' => 'Total',
                            'vAlign' => 'middle',
                            //'width' => '50px',
                ],
            [
                        'class' => 'kartik\grid\EditableColumn',
                         
                        'editableOptions'=>[
                             'pjaxContainerId'=>'manita',
                            ///'model'=>NEW \frontend\modules\sta\models\Alumnos(),
                            'ajaxSettings'=>[
                                'url'=>'',
                                'type'=>'post',
                                //'data'=>['alo'=>'hola'],
                               // 'data'=>['modelo'=>'Talleresdet'],
                            ],
                            'pjaxContainerId'=>'manita',
                            //'format' => Editable::FORMAT_BUTTON,
                            'inputType' => Editable::INPUT_DROPDOWN_LIST,
                             'data'=>['cour'=>'courier','xbriyaz'=>'xbriyaz','verdana'=>'verdana','arial'=>'arial'], 
                                            ],
                        'attribute' => 'font_family',
                            //'pageSummary' => 'Total',
                            'vAlign' => 'middle',
                            //'width' => '50px',
                ],
            [
                        'class' => 'kartik\grid\EditableColumn',
                
                        'editableOptions'=>[
                             'pjaxContainerId'=>'manita',
                          //  'format' => Editable::FORMAT_BUTTON,
                            'inputType' => Editable::INPUT_DROPDOWN_LIST,
                             'data'=>['1'=>'Yes','0'=>'No'], 
                                            ],
                        'attribute' => 'visiblecampo',
                            //'pageSummary' => 'Total',
                            'vAlign' => 'middle',
                            //'width' => '50px',
                ],
	    [
                        'class' => 'kartik\grid\EditableColumn',
                        'editableOptions'=>[
                             'pjaxContainerId'=>'manita',
                                            ],
                        'attribute' => 'left',
                            //'pageSummary' => 'Total',
                            'vAlign' => 'middle',
                            //'width' => '50px',
                ],  
            [
                        'class' => 'kartik\grid\EditableColumn',
                        'editableOptions'=>[
                             'pjaxContainerId'=>'manita',
                                            ],
                        'attribute' => 'top',
                            //'pageSummary' => 'Total',
                            'vAlign' => 'middle',
                            //'width' => '50px',
                ],
		  
		   		  
		   'lbl_left',
		   'lbl_top',
		   'lbl_font_size',
		   
		   'visiblelabel',
		   'lbl_font_color',
		   'visiblecampo',
		  
                ],
        ]
    ); ?>

<?php Pjax::end(); ?>
  </div>  