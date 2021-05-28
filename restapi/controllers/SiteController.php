<?php


namespace restapi\controllers;

use restapi\models\LoginForm;
use yii\rest\Controller;

class SiteController extends Controller
{
    public function actionLogin()
    {
        $model = new LoginForm();
        if($model->load(\Yii::$app->request->post(), '') && ($token = $model->login())) {
            return ['token' => $token, 'username' => $model->username, 'rememberMe' => $model->rememberMe];
        }else {
            return $model;
        }
    }

}