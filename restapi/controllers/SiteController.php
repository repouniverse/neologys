<?php


namespace restapi\controllers;

use common\models\masters\Personas;
use common\models\masters\Trabajadores;
use restapi\models\LoginForm;
use restapi\models\User;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
        ];

        return $behaviors;
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if($model->load(\Yii::$app->request->post(), '') && ($token = $model->login())) {
            $profile = User::findByUsername($model->username)->getProfile();
            $trabajador = Trabajadores::findOne(['persona_id' => $profile->persona_id]);

            $carrera_id = null;
            $depa_id = null;

            if($trabajador) {
                $carrera_id = $trabajador->carrera_id;
                $depa_id = $trabajador->depa_id;
            }

            return [
                'token' => $token,
                'username' => $model->username,
                'persona_id' => $profile->persona_id,
                'codgrupo' => $profile->getPersona()->one()->codgrupo,
                'carrera_id' => $carrera_id,
                'depa_id' => $depa_id,
            ];
        }else {
            //return $model
            return ['status' => 'without_profile'];
        }
    }

    public function actionCreateUserNew()
    {
        $params=$_REQUEST;
        $user = new \common\models\User();
        $user->attributes = $params;
        $user->password= '123456 ';
        $user->save();
        return $params;
    }
}