<?php

namespace backend\modules\base\controllers;
use backend\modules\base\Module as m;
use yii\web\Controller;
use common\models\masters\Combovalores;
use yii2mod\settings\models\SettingModel;
/**
 * Default controller for the `base` module
 */
class DefaultController extends Controller
{
   
     public function actions()
    {
        return [
            'manage-settings' => [
                'class' => \yii2mod\settings\actions\SettingsAction::class,
                // also you can use events as follows:
                'on beforeSave' => function ($event) {
                    // your custom code
                },
                'on afterSave' => function ($event) {
                    // your custom code
                },
               // 'seccion'=>'base.base',
                'modelClass' => \common\models\settings\ConfigurationForm::class,
            ],
        ];
    }
    
    
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        
       $model= new  Combovalores();
       
      
        
        return $this->render('index');
    }
    
    public function actionGrupoParametros(){
        
        $nombreTabla=str_replace('}}','', str_replace('{{%','',SettingModel::tableName()));
      return $this->render('index_grupos_parametros',
              [
                  'nombreTabla'=>$nombreTabla
              ]);  
    }
    
     public function actionCreaGrupoParametros(){
        $model = new Combovalores();

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($model);
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }ELSE{
           // PRINT_R($model->getErrors());DIE();
        }

        return $this->render('crea_grupo_parametro', [
            'model' => $model,
        ]);
    }
    
    
    
}
