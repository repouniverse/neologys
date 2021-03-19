<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use mdm\admin\models\BizRule;
use yii\captcha\Captcha;
use unclead\multipleinput\MultipleInput;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </p>



    <div class="contenido">
        <form action="">
            <div class="row">
                <div class="col-md-12" class="header">
               <?= $form->field($model, 'cordi')->widget(MultipleInput::className(), [
            'min' => 1,
            'max' => 4,
            'columns' => [
                [
                    'name'  => 'docente',
                    'title' => 'Docente',
                    'options'=>[
                        'placeholder' => 'Nombre del Docente'
                    ]

                ],
                [
                    'name'  => 'curso',
                    'title' => 'Curso',
                    'options'=>[
                        'placeholder' => 'Nombre del Curso'
                    ]
                ],
                [
                    'name'  => 'seccion',
                    'title' => 'Sección',
                    'options'=>[
                        'placeholder' => 'Sección'
                    ]
                ]
            ]

        ])->label(false);
        ?> <br>
                    <input type="text" placeholder="TIPOS DE ROLES"> <br>
                    <button>Asignar</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 content">
                    <h2>BUSCADOR</h2>
                    <div class="content">
                        <input type="text" placeholder="FILTRO1">
                        <input type="text" placeholder="FILTRO1">
                        <input type="text" placeholder="FILTRO1">
                        <input type="text" placeholder="FILTRO1">
                        <input type="text" placeholder="FILTRO1">
                        <input type="text" placeholder="FILTRO1">
                    </div>
                </div>

            </div>
        </form>
    </div>



</div>

</div>

<style>
    .header {
        display: flex;
        flex-direction: column;
    }

    .content {
        display: flex;
        flex-direction: column;
    }

    .contenido {
        display: flex;
        flex-direction: column;
        width: 80%;
        justify-content: center;
        align-items: center;
        border: 1px solid black;
    }
</style>