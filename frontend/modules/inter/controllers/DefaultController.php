<?php

namespace frontend\modules\inter\controllers;
USE frontend\modules\inter\models\AuthWithQuestionForm;
use common\helpers\h;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\web\Controller;
use yii;
/**
 * Default controller for the `inter` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionBaseAuth(){
        {
        $this->layout='install';
        $model = new AuthWithQuestionForm();        
        $model->setScenario($model::SCE_AUTH_BASE);
        
        if (h::request()->isAjax && $model->load(h::request()->post())) {
                h::response()->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
        }
         yii::error($model->load(Yii::$app->request->post()));
         yii::error( $model->login());
        if ($model->load(Yii::$app->request->post())) {
            $session=h::session();
            $session['login.codigo'] = $model->codigo;
            $session['login.email'] = $model->email;
            $session['login.modo_id'] = $model->modo_id;
            //$sesion=->set('login',$model->codigo);
            return $this->redirect(['aditional-auth'/*,'cd'=>base64_encode($model->codigo)*/]);
        }

        return $this->render('base_auth', [
            'model' => $model,
        ]);
    }
    }
    
    public function actionAditionalAuth(){
        $this->layout='install';
        $sesion=h::session();
        if($sesion->has('login.codigo') && $sesion->has('login.email') ){          
                    $model = new AuthWithQuestionForm(); 
                        $model->setScenario($model::SCE_AUTH_ADITIONAL);
                        $model->codigo=$sesion['login.codigo'];
                         $model->email=$sesion['login.email'];
                         $model->modo_id=$sesion['login.modo_id'];
                         $modelPostulante=$model->modelPostulante;
                                if (h::request()->isAjax && $model->load(h::request()->post())) {
                                     h::response()->format = Response::FORMAT_JSON;
                                        return ActiveForm::validate($model);
                                        }
                            if ($model->load(Yii::$app->request->post())) {
                                //$sesion=h::session()->set('login',$model->codigo);
                                return $this->redirect(['final'/*,'cd'=>base64_encode($model->codigo)*/]);
                                } 
                         return  $this->render('base_add',['model'=>$model]);
            
        }else{
           return $this->redirect(['base_auth','model'=>$model]);
        
           }
        }
}
