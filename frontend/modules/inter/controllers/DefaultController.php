<?php

namespace frontend\modules\inter\controllers;
USE frontend\modules\inter\models\AuthWithQuestionForm;
use common\helpers\h;
use common\models\masters\Alumnos;
use common\filters\ActionIsPersonaFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\db\Query;
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
    
    public function behaviors()
        {
            return [
                    'isPerson' => [
                    'class' => ActionIsPersonaFilter::className(),
                    'only' => ['postulacion'],
                    
                             ],
                        ];
           }
    
    
    /*
     * Gestiona unalista de alumnos extraneros que 
     * no han sido convocados */
     
     public function actionPreExternalStudents()
    {
         $tableConvocados='{{%inter_convocados}}';
         
        $provider=new ActiveDataProvider([
                    'query'=> Alumnos::find()->andWhere([
                        '<>','universidad_id',h::currentUniversity()
                            ])->andWhere([
                                'not in',
                                'id',(new Query())->
                                    select('alumno_id')->from($tableConvocados)->
                                    where(['not', ['alumno_id' => null]])
                                    ])
                    /*->andWhere(['unidest_id'=>h::currentUniversity()])*/,
                   ] ) ;
    // echo Alumnos::find()->andWhere(['<>','universidad_id',h::currentUniversity()])->andWhere(['not in','id',(new Query())->select('alumno_id')->from($tableConvocados)])->createCommand()->rawSql;die();
       return  $this->render('enespera',['provider'=>$provider]);
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
    
    public function actionRutas(){
        $array=\common\helpers\ComboHelper::getCboGrupoPersonas();
        var_dump(array_keys($array));die();
         \frontend\modules\inter\models\InterPrograma::createMagicPrograma(13,54, '2021-II', '158');
    DIE();
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
                                    //return $this->redirect(['auth-end-first','code'=>$model->codigo,'corre o'=>$model->email]);
                                    return $this->render('base_wait',['code'=>$model->codigo,'correo'=>$model->email]);
                                //}else{
                                  
                                  //}
                                } 
                         return  $this->render('base_add',['model'=>$model]);
            
        }else{
           return $this->redirect(['base_auth']);
        
           }
        }
     
        
        
   public function actionAuthEndFirst(){
       $code=h::request()->get('code');
       $correo=h::request()->get('correo');
      return $this->render('base_final',['code'=>$code,'correo'=>$correo]);
   }  

   
   public function actionVerifyEmailTokenAuth($id){
       $this->layout="install";
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
                    $postulante=$model->modelPostulante;
                    if(is_null($postulante))
                     return $this->render('base_error_datos_url');
                    $postulante->sinceraCorreo($correo);
                    //Como ya validó el token , aqui si creamos el usuario
                    //si no existe  y le mandamos paa que sresetee el password//
                   $model->sendEmailToCreateUser();
                   return $this->render('base_final',['model'=>$model]);
                  // return $this->redirect(['/site/request-password-reset']);
                   
             }
        }
        
  /*public function actionPostulacion(){
      $identidad=h::user()->profile->persona->identidad;
      if($identidad->isConvocado())
       return $this->render('panel_alumno_internacional',['identidad'=>$identidad]);
       return $this->render('noconvocado',['identidad'=>$identidad]);
   
      }*/
      
      /*Verificando la identidad del usuario*/
  public function actionPostulacion(){    
      /*Si el`profile apunta a la person*/
   if(!is_null(($persona=h::user()->profile->persona))){
     if(!is_null($grupo=GrupoPersonas::findOne($persona->codgrupo))){
         if(!is_null($identidad=$persona->identidad)){             
                // echo $grupo->layout; die();              
                return $this->render($grupo->layout,['identidad'=>$identidad]);
                }else{
               ///Layout para personas sin identidad
                return $this->render('noidentidad',['persona'=>$persona]); 
                }
         
            }else{
                /*Es un usuario sin referencia a un grupo de personas*/
                return $this->goHome();
            }
    }else{
        //echo "ewdsdsds"; die();
        /*Es un usuario sin referencia a persona*/
       return $this->goHome();
    }
  }
}
