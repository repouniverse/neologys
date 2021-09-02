<?php
namespace restapi\controllers;


use common\models\User;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\rest\Controller;
use yii\web\Response;

class UserController extends MyController
{
    public $modelClass = 'restapi\models\User';



    public function actions()
    {
        $actions = parent::actions();
//        unset($actions['index']);
//        unset($actions['view']);
//        unset($actions['create']);
//        unset($actions['update']);
//        unset($actions['delete']);
        return $actions;
    }

//    public function actionCreate()
//    {
//        $params=$_REQUEST;
//        $user = new \common\models\User();
//        $user->attributes = $params;
//        $user->password= '123456 ';
//        $user->save();
//        return $params;
//    }

    public function actionLogout()
    {
        $userID =\Yii::$app->user->getIdentity()->getId();
        $userModel = User::find()->where(['id'=>$userID])->one();
        if(!empty($userModel))
        {
            $userModel->access_token=null;
            $userModel->save(false);
        }
        \Yii::$app->user->logout(false);

        return [
            'name' => 'Unauthenticated',
            'code' => 200,
        ];
    }


}