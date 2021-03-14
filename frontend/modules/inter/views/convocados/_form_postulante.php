<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\inter\Module as m;
use yii\helpers\Url;
use kartik\tabs\TabsX;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\helpers\h;
use kartik\date\DatePicker;
use common\widgets\cbodepwidget\cboDepWidget as ComboDep;
use common\helpers\ComboHelper;
use common\widgets\linkajaxgridwidget\linkAjaxGridWidget;
use common\models\masters\Alumnos;
use common\widgets\selectwidget\selectWidget;
?>
<div class="inter-convocados-form">
    <br>
    <?php $postulante=$model->postulante;  ?>
    <?php
    $paisResidencia = \common\models\masters\Universidades::findOne($model->universidad_id)->codpais;    //$model->studentPais($model->universidad_id);
    $modelP->paisresidencia = $paisResidencia;
    $form = ActiveForm::begin
    (
        [
            'id'=>'biForm',
            'fieldClass'=>'\common\components\MyActiveField',
            'action'=>Url::to(['/inter/convocados/fill-ficha','id'=>$model->id]),
        ]
    );
    ?>
    <div class="box-header">
        <div class="col-md-12">
            <div class="form-group no-margin">
                <?= Html::submitButton('<span class="fa fa-save"></span>     '.m::t('verbs', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
    <div class="box-body">

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <?= $form->field($model, 'alumno_id')->
            label(m::t('labels','Code'))->
            textInput(['value'=>$postulante->{$postulante->nameFieldCode()},'disabled'=>true])
            ?>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">

            <?= $form->field($model, 'alumno_id')->
            label(m::t('labels','Student'))->
            textInput(['value'=>$postulante->fullName(false),'disabled'=>true])
            ?>
        </div>


        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'universidad_id')->
            label(m::t('labels','Original University'))->
            textInput(['value'=>$model->universidad->nombre,'disabled'=>true])
            ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'facultad_id')->
            label(m::t('labels','Faculty'))->
            textInput(['value'=>$model->facultad->desfac,'disabled'=>true])
            ?>

        </div>
        <!--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <?php /*$form->field($model, 'depa_id')->
                           label(m::t('labels','Departament'))->
                           textInput(['value'=>$model->depa->nombredepa,'disabled'=>true])*/
        ?>
             </div> -->

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'alumno_id')->
            label(m::t('labels','Mail'))->
            textInput(['value'=>$postulante->mail,'disabled'=>true])
            ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'carrera_id')->textInput(['disabled'=>true,'value'=>$postulante->carrera->nombre,'maxlength' => true]) ?>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'motivos',['enableAjaxValidation'=>true])->
            label(m::t('labels','Reasons for applying'))->
            textarea()
            ?>
        </div>


        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <p class="text-fuchsia"><?=m::t('labels','Add Universities to Apply')?></p>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <p>
                    <?php $url= Url::to(['/inter/convocados/modal-new-opuniv','id'=>$model->id,
                        'gridName'=>'OpcionesUniversidad','idModal'=>'buscarvalor']);
                    echo Html::a('<span class="glyphicon glyphicon-plus"></span>',
                        $url, ['class'=>'botonAbre btn btn-success btn-sm ']);
                    ?>
                </p>
            </div>
            <?php Pjax::begin(['id'=>'OpcionesUniversidad']); ?>
            <?= GridView::widget(
                [
                    'id'=>'migrillax',
                    'dataProvider' => new \yii\data\ActiveDataProvider(
                        [
                            'query'=> \frontend\modules\inter\models\InterOpuniv::find()->
                            andWhere(['convocatoria_id'=>$model->id])
                        ]),
                    'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
                    'columns' =>
                        [
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{update}{delete}',
                                'buttons' =>
                                    [
                                        'update' => function($url, $model)
                                        {
                                            $options =
                                                [
                                                    'title' => m::t('verbs', 'Update'),
                                                    'data-pjax'=>'0',
                                                    'class'=>'botonAbre'
                                                ];
                                            $url= Url::to(['modal-edit-opuniv','id'=>$model->id,
                                                'gridName'=>'OpcionesUniversidad','idModal'=>'buscarvalor']);
                                            return Html::a('<span class="btn btn-info btn-sm glyphicon glyphicon-pencil"></span>', $url, $options);
                                        },
                                        'delete' => function($url, $model)
                                        {
                                            $url=Url::to(['delete-univ-convo','id'=>$model->id]);
                                            $options =
                                                [
                                                    'family'=>'holas',
                                                    'id'=>$model->id,
                                                    'title' =>$url
                                                ];
                                            return Html::a('<span class="btn btn-danger btn-sm glyphicon glyphicon-remove"></span>', '#', $options/*$options*/);
                                        }
                                    ]
                            ],
                            [
                                'attribute'=>'Universidad',
                                'value'=> function($model)
                                {
                                    return $model->univop->nombre;
                                }
                            ],
                            [
                                'attribute'=>m::t('labels','Country'),
                                'format'=>'raw',
                                'value'=> function($model)
                                {
                                    $codpais= $model->univop->codpais;
                                    return Html::img('@web/img/flags/32/'.$codpais.'.png');
                                }
                            ],
                            'prioridad',
                        ],
                ]);
            ?>
            <?php
            echo linkAjaxGridWidget::widget(
                [
                    'id'=>'sdsds',
                    'idGrilla'=>'OpcionesUniversidad',
                    'family'=>'holas',
                    'type'=>'POST',
                    'evento'=>'click',
                    'posicion'=> \yii\web\View::POS_END
                ]);
            ?>
            <?php Pjax::end(); ?>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <p class="text-fuchsia"><?=m::t('labels','Add languages skills')?></p>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <p>
                    <?php
                    $url= Url::to(['modal-new-idioma','id'=>$model->id,'gridName'=>'OpcionesIdiomas','idModal'=>'buscarvalor']);
                    echo Html::a('<span class="btn btn-success btn-sm glyphicon glyphicon-plus"></span>', $url, ['class'=>'botonAbre']);
                    ?>
                </p>
            </div>
            <?php Pjax::begin(['id'=>'OpcionesIdiomas']); ?>
            <?= GridView::widget(
                [
                    'id'=>'migrillax',
                    'dataProvider' => new \yii\data\ActiveDataProvider(
                        [
                            'query'=> \frontend\modules\inter\models\InterIdiomasalu::find()->
                            andWhere(['convocatoria_id'=>$model->id])
                        ]),
                    'tableOptions'=>['class'=>'table table-condensed table-hover table-bordered table-striped'],
                    'columns' =>
                        [
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{update}{delete}',
                                'buttons' =>
                                    [
                                        'update' => function($url, $model)
                                        {
                                            $options =
                                                [
                                                    'title' => m::t('verbs', 'Update'),
                                                    'data-pjax'=>'0',
                                                    'class'=>'botonAbre'
                                                ];
                                            $url= Url::to(['modal-edit-idioma','id'=>$model->id,
                                                'gridName'=>'OpcionesIdiomas','idModal'=>'buscarvalor']);
                                            return Html::a('<span class="btn btn-info btn-sm glyphicon glyphicon-pencil"></span>', $url, $options);
                                        },
                                        'delete' => function($url, $model)
                                        {
                                            $url=Url::to(['delete-op-idioma','id'=>$model->id]);
                                            $options =
                                                [
                                                    'family'=>'holas',
                                                    'id'=>$model->id,
                                                    'title' =>$url
                                                ];
                                            return Html::a('<span class="btn btn-danger btn-sm glyphicon glyphicon-remove"></span>', '#', $options/*$options*/);
                                        }
                                    ]
                            ],
                            [
                                'attribute'=>m::t('labels','Language'),
                                'value'=> function($model)
                                {
                                    return frontend\modules\inter\helpers\ComboHelper::getIdioma($model->idioma);
                                }
                            ],
                            [
                                'attribute'=>m::t('labels','Skill'),
                                'format'=>'raw',
                                'value'=> function($model)
                                {
                                    return frontend\modules\inter\helpers\ComboHelper::getNivelIidioma('codnivel');
                                }
                            ],

                        ],
                ]);
            ?>
            <?php
            echo linkAjaxGridWidget::widget(
                [
                    'id'=>'sdrtrsds',
                    'idGrilla'=>'OpcionesIdiomas',
                    'family'=>'holas',
                    'type'=>'POST',
                    'evento'=>'click',
                    'posicion'=> \yii\web\View::POS_END
                ]);
            ?>
            <?php Pjax::end(); ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($modelP, 'ap')->textInput() ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($modelP, 'am')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($modelP, 'nombres')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?=$form->field($modelP, 'tipodoc')->
            dropDownList($modelP->comboDataField('tipodoc'),['prompt'=>'--'.m::t('verbs','Choose a Value')."--",])
            ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($modelP, 'numerodoc')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?php ?>
            <?= $form->field($modelP, 'cumple',['enableAjaxValidation'=>true])->
            widget(DatePicker::class,
                [
                    'language' => h::app()->language,
                    'pluginOptions'=>
                        [
                            'format' => h::gsetting('timeUser', 'date')  ,
                            'changeMonth'=>true,
                            'changeYear'=>true,
                            'yearRange'=>"-99:+0",
                        ],
                    'options'=>['class'=>'form-control']
                ]) ?>
        </div>
        <!--<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <?php ?>
                <?PHP /*ECHO $form->field($modelP, 'fecingreso')->
                    widget(DatePicker::class,
                    [
                        'language' => h::app()->language,
                        'pluginOptions'=>
                        [
                            'format' => h::gsetting('timeUser', 'date'),
                            'changeMonth'=>true,
                            'changeYear'=>true,
                            'yearRange'=>'1980:'.date('Y'),
                        ],
                        'options'=>['class'=>'form-control']
                    ])
                */?>
            </div> -->
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($modelP, 'telfijo')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($modelP, 'telmoviles')->textInput(['maxlength' => true]) ?>
        </div>




        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <?= $form->field($modelP, 'sexo')->
            dropDownList(ComboHelper::getCboSex(),
                ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",])
            ?>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <?= $form->field($modelP, 'estcivil')->
            dropDownList(ComboHelper::getCboEstCivil(),
                ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",])
            ?>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <?= $form->field($modelP, 'pais')->
            dropDownList(ComboHelper::getCboPaises(),
                ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",])
            ?>
        </div>

        <!--  Aqui cej zala division para datros de dmcicio   -->



        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="text-green"><?php echo h::awe('user').h::space(10). m::t('labels','Datos de Localización'); ?></p>
            <hr style="border: 1px dashed #4CAF50;">
        </div>

        <?php
        if (!$postulante->isExternal())
        {
            ?>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <?=$form->field($modelP, 'paisresidencia')->
                dropDownList(ComboHelper::getCboPaises(),['prompt'=>'--'.m::t('verbs','Choose a Value')."--",'', 'disabled'=>true,])
                ?>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <?= ComboDep::widget(
                    [
                        'model'=>$modelP,
                        'form'=>$form,
                        'data'=> ComboHelper::getCboDepartamentos(),
                        'campo'=>'depdir',
                        'idcombodep'=>'personas-provdir',
                        /* 'source'=>[ //fuente de donde se sacarn lso datos
                             /*Si quiere colocar los datos directamente
                              * para llenar el combo aqui , hagalo coloque la matriz de los datos
                              * aqui:  'id1'=>'valor1',
                              *        'id2'=>'valor2,
                              *         'id3'=>'valor3,
                              *        ...
                              * En otro caso
                              * de la BD mediante un modelo
                              */
                        /*Docbotellas::className()=>[ //NOmbre del modelo fuente de datos
                                        'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select
                                        'camporef'=>'descripcion',//columna a mostrar
                                        'campofiltro'=>'codenvio'/* //cpolumna
                                         * columna que sirve como criterio para filtrar los datos
                                         * si no quiere filtrar nada colocwue : false | '' | null
                                         *

                         ]*/
                        'source'=>[\common\models\masters\Ubigeos::className()=>
                            [
                                'campoclave'=>'codprov' , //columna clave del modelo ; se almacena en el value del option del select
                                'camporef'=>'provincia',//columna a mostrar
                                'campofiltro'=>'coddepa'
                            ]
                        ],
                    ])
                ?>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <?= ComboDep::widget(
                    [
                        'model'=>$modelP,
                        'form'=>$form,
                        'data'=> ($modelP->isNewRecord)?[]:ComboHelper::getCboProvincias($modelP->depdir),
                        'campo'=>'provdir',
                        'idcombodep'=>'personas-distdir',
                        /* 'source'=>[ //fuente de donde se sacarn lso datos
                             /*Si quiere colocar los datos directamente
                              * para llenar el combo aqui , hagalo coloque la matriz de los datos
                              * aqui:  'id1'=>'valor1',
                              *        'id2'=>'valor2,
                              *         'id3'=>'valor3,
                              *        ...
                              * En otro caso
                              * de la BD mediante un modelo
                              */
                        /*Docbotellas::className()=>[ //NOmbre del modelo fuente de datos
                                        'campoclave'=>'id' , //columna clave del modelo ; se almacena en el value del option del select
                                        'camporef'=>'descripcion',//columna a mostrar
                                        'campofiltro'=>'codenvio'/* //cpolumna
                                         * columna que sirve como criterio para filtrar los datos
                                         * si no quiere filtrar nada colocwue : false | '' | null
                                         *

                         ]*/
                        'source'=>[\common\models\masters\Ubigeos::className()=>
                            [
                                'campoclave'=>'coddist' , //columna clave del modelo ; se almacena en el value del option del select
                                'camporef'=>'distrito',//columna a mostrar
                                'campofiltro'=>'codprov'
                            ]
                        ],
                    ])
                ?>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <?= $form->field($modelP, 'distdir')->
                dropDownList(($modelP->isNewRecord)?[]:ComboHelper::getCboDistritos($modelP->provdir),
                    ['prompt'=>'--'.m::t('verbs','Choose a Value')."--",])
                ?>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <?= $form->field($modelP, 'domicilio')->textInput(['maxlength' => true]) ?>
            </div>
            <?php
        }
        else
        {
            ?>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <?= $form->field($modelP, 'lugarresidencia')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <?= $form->field($modelP, 'domicilio')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="form-group field-alumnos-nsemestres">
                    <label class="control-label" for="codcontpaisresid">Contacto Pais Residencia</label>
                    <input type="text" id="codcontpaisresid" class="form-control" name="codcontpaisresid">

                    <div class="help-block"></div>
                </div>
                <?php
                //                        echo selectWidget::widget
                //                             (
                //                                [
                //                                    'model'=>$modelP,
                //                                    'form'=>$form,
                //                                    'campo'=>'codcontpaisresid',
                //                                    'ordenCampo'=>8,
                //                                    'addCampos'=>[7,5],
                //                                ]
                //                            );
                ?>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <?= $form->field($modelP, 'parentcontpaisresid')->textInput(['maxlength' => true]) ?>
            </div>



            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <?= $form->field($modelP, 'telpaisorigen')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="form-group field-alumnos-nsemestres">
                    <label class="control-label" for="alumnos-nsemestres">Nro de semestres</label>
                    <input type="text" id="alumnos-nsemestres" class="form-control" name="Alumnos[nsemestres]">

                    <div class="help-block"></div>
                </div>
            </div>


            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <?= $form->field($modelP, 'polizaseguroint')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <?= $form->field($modelP, 'telefasistencia')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <?= $form->field($modelP, 'tipogrado')->textInput(['maxlength' => true]) ?>
            </div>
            <!-- -->
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="form-group field-alumnos-fecingreso">
                    <label class="control-label" for="alumnos-fecingreso">Fecha de ingreso</label>
                    <input type="text" id="alumnos-fecingreso" class="form-control" name="Alumnos[fecingreso]">

                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="form-group field-alumnos-ftermino">
                    <label class="control-label" for="alumnos-ftermino">Fecha de término</label>
                    <input type="text" id="alumnos-ftermino" class="form-control" name="Alumnos[ftermino]">

                    <div class="help-block"></div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <?= $form->field($modelP, 'domicilio')->label( m::t('labels','Domicilio Pais Residencia'))->textInput(['maxlength' => true]) ?>
            </div>

            <?php
        }
        ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="text-green"><?php echo h::awe('usd').h::space(10). m::t('labels','Financiamiento'); ?></p>
            <hr style="border: 1px dashed #4CAF50;">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="form-group field-alumnos-nsemestres">
                <label class="control-label" for="alumnos-beca">Beca:</label>
                <input type="text" id="alumnos-beca" class="form-control" name="alumnos-beca">

                <div class="help-block"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="form-group field-alumnos-nsemestres">
                <label class="control-label" for="alumnos-prestamo">Préstamo:</label>
                <input type="text" id="alumnos-prestamo" class="form-control" name="alumnos-prestamo">

                <div class="help-block"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="form-group field-alumnos-nsemestres">
                <label class="control-label" for="alumnos-propio">Financiamiento Propio:</label>
                <input type="text" id="alumnos-propio" class="form-control" name="alumnos-propio">

                <div class="help-block"></div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="form-group field-alumnos-nsemestres">
                <label class="control-label" for="alumnos-otro">Otro:</label>
                <input type="text" id="alumnos-otro" class="form-control" name="alumnos-otro">

                <div class="help-block"></div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="text-green"><?php echo h::awe('user').h::space(10). m::t('labels','Additional Data'); ?></p>
            <hr style="border: 1px dashed #4CAF50;">
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($modelP, 'alergias')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($modelP, 'gruposangu')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <?= $form->field($modelP, 'usoregulmedic')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <?php
            if(!$postulante->isExternal() && $modelP->codgrupo=='300'){

                ?>





                <?php echo TabsX::widget
                (
                    [
                        'position' => TabsX::POS_ABOVE,
                        'bordered'=>true,
                        'align' => TabsX::ALIGN_LEFT,
                        'encodeLabels'=>false,
                        'items' =>
                            [
                                [
                                    'label'=>'<i class="fa fa-home"></i> '.m::t('labels','Events'),
                                    'content'=> $this->render('_tab_eventos_inter',['model'=>$postulante,'modelPersona' => $modelP,]),
                                    'active' => true,
                                    'options' => ['id' => 'myveryownID3'],
                                ],
                                [
                                    'label'=>'<i class="fa fa-home"></i> '.m::t('labels','Languages'),
                                    'content'=> $this->render('_tab_idiomas',['model'=>$postulante,'modelPersona' => $modelP,]),
                                    // 'active' => true,
                                    'options' => ['id' => 'myvuyuynID3'],
                                ],
                                [
                                    'label'=>'<i class="fa fa-home"></i> '.m::t('labels','Publications'),
                                    'content'=> $this->render('_tab_publicaciones',['model'=>$postulante,'modelPersona' => $modelP,]),
                                    // 'active' => true,
                                    'options' => ['id' => 'my4vyuynID3'],
                                ],

                            ],
                    ]
                );
                ?>


            <?php  } ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
