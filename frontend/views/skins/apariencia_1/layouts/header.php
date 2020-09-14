<?php
use yii\helpers\Html;
use common\helpers\h;
/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>',\yii\helpers\Url::to([Yii::$app->user->resolveUrlAfterLogin()]), ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
              <?php require('notificaciones.php');   ?>   
                <?php require('favoritos.php');   ?>   
                
             <li class="dropdown user user-menu">
                    <a href="#" class="linkajustado" data-toggle="dropdown">
                        <i class="fa fa-user" aria-hidden="true"></i><?php  echo (h::UserIsGuest())?'':h::userName() /* \frontend\widgets\userwidget\userWidget::widget(['size'=>30,'longName'=>true])*/  ?>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <?= \common\widgets\userwidget\userWidget::widget(['size'=>100,
                                'orientacion'=>'vertical','longName'=>true])  ?>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?= Html::a(
                                    yii::t('base_labels','Profile'),
                                    ['/site/profile'],
                                    ['class' => 'btn btn-default btn-flat']
                                ) ?>
                                </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
               
                <!-- User Account: style can be found in dropdown.less -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
