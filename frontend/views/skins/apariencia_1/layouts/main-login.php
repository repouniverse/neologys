<?php
use frontend\assets\AppAsset;
use yii\helpers\Html;
frontend\views\skins\apariencia_1\AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet">
    <link href="https://fcctp.usmp.edu.pe/css/web.css" rel="stylesheet">
    <link href="https://fcctp.usmp.edu.pe/css/estilos_for_forms.css" rel="stylesheet">
    <link href="https://fcctp.usmp.edu.pe/lib/fontawesome/css/all.css" rel="stylesheet">

    <style>
        fieldset {
            background-color: #efefef;
        }

        legend {
            background: #861D2F;
            width: inherit;
            /* Or auto */
            color: #fff;
            padding: 10px;
            font-size: 15px;
        }
    </style>
</head>
<body class="login-page">
<header>
    <!-- CABECERA -->
    <div class="container-fluid ctnr-slider">
        <div class="container cntr-logo">
            <div class="row">
                <div class="col-md-6 col-xs-4">
                    <a class="navbar-brand logo" href="https://fcctp.usmp.edu.pe/site/"><img
                                src="https://fcctp.usmp.edu.pe/images/v2/img/logo.png" width="100%"></a>
                </div>
                <div class="col social">
                    <div class="cntr-icos ">

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- FIN CABECERA -->
</header>

<main>
    <div class="container box-page-container c-p-content pt-4">
        <?php $this->beginBody() ?>
        <?= $content ?>
        <?php $this->endBody() ?>
    </div>
</main>

<!-- FOOTER -->
<footer>
    <div class="container-fluid bgfooter">
        <div class="container">


            <div class="row medio">
                <div class="col-lg-4 col-sm-12 col-12">
                    <div class="copy">Copyright ©2021. Facultad de Ciencias de la Comunicación, Turismo y
                        Psicología, USMP. Todos los derechos reservados
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12 col-12">

                </div>
                <div class="col-lg-4 col-sm-12 col-12">
                    <div class="acre text-center">

                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- FIN FOOTER -->
</body>
</html>
<?php $this->endPage() ?>
