<?php
namespace common\controllers;
use Yii;
use common\helpers\h;
use yii\web\Controller;
//use yii\helpers\Html;/////
/**
 * CliproController implements the CRUD actions for Clipro model.
 */
class FinderController extends Controller
{
  public function actions() {
      parent::actions();
      return [
           
          'additem'=> [
                        'class' => 'common\actions\ActionAdditem',
                        //'property1' => 'value1',
                        //'property2' => 'value2',
                            ],
          
          'alert'=> [
                        'class' => 'common\actions\ActionAlert',
                        //'property1' => 'value1',
                        //'property2' => 'value2',
                            ],
          //'action1' => 'app\components\Action1',
             'busqueda' => [
                        'class' => 'common\actions\ActionGetDataFromModel',
                        //'property1' => 'value1',
                        //'property2' => 'value2',
                            ],
          'busquedamodal' => [
                        'class' => 'common\actions\ActionGetDataFromModal',
                        //'property1' => 'value1',
                        //'property2' => 'value2',
                            ],
          'searchselect' => [
                        'class' => 'common\actions\ActionSearchSelect',
                        //'property1' => 'value1',
                        //'property2' => 'value2',
                            ],
          'combodependiente'=> [
                        'class' => 'common\actions\ActionCombodependiente',
                        //'property1' => 'value1',
                        //'property2' => 'value2',
                            ]
          ,
          'selectimage'=> [
                        'class' => 'common\actions\ActionSelectImage',
                        //'property1' => 'value1',
                        //'property2' => 'value2',
                            ]
           ,
          'renderparam'=> [
                        'class' => 'common\actions\ActionRenderParam',
                        //'property1' => 'value1',
                        //'property2' => 'value2',
                            ],
          'audit'=> [
                        'class' => 'common\actions\ActionAudit',
                        //'property1' => 'value1',
                        //'property2' => 'value2',
                            ],
          'addmaletin'=> [
                        'class' => 'common\actions\ActionAddMaletin',
                        //'property1' => 'value1',
                        //'property2' => 'value2',
                            ],
          'flushmaletin'=> [
                        'class' => 'common\actions\ActionFlushMaletin',
                        //'property1' => 'value1',
                        //'property2' => 'value2',
                            ]
      ];
      
  }
 public function actionHola(){
     echo "hola ";
 }
}
