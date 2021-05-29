<?php


namespace restapi\controllers;

use common\models\masters\Personas;
use restapi\models\LoginForm;
use restapi\models\User;
use yii\rest\Controller;

class SiteController extends Controller
{
    public function actionLogin()
    {
        $model = new LoginForm();
        if($model->load(\Yii::$app->request->post(), '') && ($token = $model->login())) {
            $profile = User::findByUsername($model->username)->getProfile();
            return ['token' => $token, 'username' => $model->username, 'persona_id' => $profile->persona_id, 'codgrupo' => $profile->getPersona()->one()->codgrupo];
        }else {
            return $model;
        }
    }

}