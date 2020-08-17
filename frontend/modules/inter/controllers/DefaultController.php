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
       // $this->layout='install';
        $model = new AuthWithQuestionForm();        
        $model->setScenario($model::SCE_AUTH_BASE);
        
        if (h::request()->isAjax && $model->load(h::request()->post())) {
                h::response()->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
        }
         yii::error($model->load(Yii::$app->request->post()));
         yii::error( $model->login());
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
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
       // $this->layout='install';
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
                            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                                //$sesion=h::session()->set('login',$model->codigo);
                                //if($modelPostulante->sinceraCorreo($model->email)){
                                      $model->sendEmailToVerifyMail($model->codigo);
                                    return $this->redirect(['auth-end-first','code'=>$model->codigo,'correo'=>$model->email]);
                                   
                                //}else{
                                  
                                  //}
                                } 
                         return  $this->render('base_add',['model'=>$model]);
            
        }else{
           return $this->redirect(['base_auth','model'=>$model]);
        
           }
        }
     
        
        
   public function actionAuthEndFirst(){
       $code=h::request()->get('code');
       $correo=h::request()->get('correo');
      return $this->render('base_final',['code'=>$code,'correo'=>$correo]);
   }  

   
   public function actionVerifyEmailTokenAuth($id){
       $codalu= base64_decode($id);
       $modo_id=base64_decode(h::request()->get('modo_id'));
      
       
       /*
        * OJO AQUI FALTA MEJORAR , ALGUN UUAIRO PUEDE ALTERARÇ
        * EL CORREO POR LA URL E INVALIDAR EL PROCESO, PERO SOLO 
        * ABORTARIA EL REGISTRO , NO PUEDE HACER NADA REPECTRO 
        * A LA SEGURIDAD 
        */
        $correo=base64_decode(h::request()->get('param'));
        
        
        
        $cadenatoken=h::request()->get('token');
        
       // var_dump($codalu,$modo_id,$correo,$cadenatoken);die();
        $token=\common\components\token\Token::compare('auten', 'token_'.$codalu, $cadenatoken);
                     if(is_null($token)){
                                return  $this->render('base_error',[/*'model'=>$cita,'numeroPreguntas'=>$numeroPreguntas*/]); 
                 }else{              
                    $model=New AuthWithQuestionForm();
                    $model->setAttributes([
                            'modo_id'=>$modo_id+0,
                            'codigo'=>$codalu,
                            'email'=>$correo]);
                    //var_dump($modo_id,$model->attributes);die();
                    //actualiza el correo em la tabla postulante//
                    
                    $model->modelPostulante->sinceraCorreo($correo);
                    //Como ya validó el token , aqui si creamos el usuario
                    //si no existe  y le mandamos paa que sresetee el password//
                   $model->sendEmailToCreateUser();
                   return $this->redirect(['/site/request-password-reset']);
                   
             }
        }    
}
