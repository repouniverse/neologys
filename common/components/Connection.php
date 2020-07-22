<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\components;

use yii\db\Connection as conexion;
use common\traits\baseTrait;
use backend\components\Installer;
class Connection extends Conexion
{
   use baseTrait;
    public function init(){
          if(Installer::readEnv('APP_INSTALLED')=='false'){
            
              $this->dsn ='mysql:host=127.0.0.1;dbname=geus';
              $this->username = 'root';
              $this->password = '';
              $this->charset = 'utf8';
          }else{
            $this->dsn = $this->gSettingSafe('database', 'dsn','mysql:host=localhost;dbname=geus');
            $this->username = $this->gSettingSafe('database', 'username','root');
            $this->password = $this->gSettingSafe('database', 'password','');
             $this->charset = 'utf8';           
             //$this->tablePrefix=$this->gSettingSafe('database', 'tableprefix','a345_');; 
          }
        return parent::init();
    }
    
    
}
