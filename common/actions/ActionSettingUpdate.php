<?php

/* 
 * Creado por JRamírez 24/07/2020
 * Action que permite a cualquier controlador
 * colcaor este action para que 
 * Edite el parametro de settings
 */


namespace common\actions;

use Yii;
use yii\base\Action;
use yii\base\InvalidConfigException;
//use yii\base\Model;
use yii\helpers\ArrayHelper;
//use common\helpers\FileHelper;
//use yii2mod\settings\events\FormEvent;

/**
 * Class SettingsAction
 *
 * @package yii2mod\settings\actions
 */
class ActionSettingUpdate extends Action
{
    /**
     * Event is triggered before the settings will be saved.
     * Triggered with \yii2mod\settings\events\FormEvent.
     */
    const EVENT_BEFORE_SAVE = 'beforeSave';

    /**
     * Event is triggered after the settings have been saved successfully.
     * Triggered with \yii2mod\settings\events\FormEvent.
     */
    const EVENT_AFTER_SAVE = 'afterSave';

    /**
     * @var string Nombreclase para 
     */
    
    /*
     * El nomdbe la clase search para mostrar 
     */
   // public $searchClass = 'yii2mod\settings\models\search\SettingSearch';
    
    //public $seccion=null; //Poriedad para filtrar la seccion de los setting si es null no filtra nada
    
    
    public $modelClass;

    /**
     * @var callable a PHP callable that will be called for save the settings.
     * If not set, [[saveSettings()]] will be used instead.
     * The signature of the callable should be:
     *
     * ```php
     * function ($model) {
     *      // $model is the object which will be used to validate the attributes
     * }
     * ```
     */
    //public $saveSettings;

    /**
     * @var callable a PHP callable that will be called to prepare a model.
     * If not set, [[prepareModel()]] will be used instead.
     * The signature of the callable should be:
     *
     * ```php
     * function ($model) {
     *      // $model is the object which will be used to validate the attributes
     * }
     * ```
     */
    //public $prepareModel;

   
    /**
     * @var string message to be set on successful save a model
     */
    public $successMessage = 'Settings have been saved successfully.';

    /**
     * @var string the name of the settings view
     */
    //public $view = 'index-settings';
    
    /**
     * @var string the name of the settings view
     */
    //public $classView = 'common\views\models\search\index-settings';

     public $updateView=null;
   // public $nameView='index-settings';
    public $actionRedirect=null;
    /**
     * @var array additional view params
     */
    //public $viewParams = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
       // var_dump($this->seccion);
        parent::init();
       if ($this->actionRedirect === null) {
           throw new InvalidConfigException('The "ActionRedirect" property must be set.');
       }
        if ($this->updateView === null) {
           throw new InvalidConfigException('The "UpdateView" property must be set.');
       }
    }

    /**
     * Renders the settings form.
     *
     * @return string
     */
    public function run($id)
    {
       $model = $this->modelClass;
       $model::findOne($id);
       
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', $this->successMessage);

            return $this->redirect([$this->actionRedirect]);
        } else {
            return $this->render($this->updateView, [
                'model' => $model,
            ]);
        }
        
    }

   
    
}

