<?php
namespace common\models\base;
use \yii\web\ServerErrorHttpException;
use yii;
use common\traits\baseTrait;
trait modelBaseTrait {
    use baseTrait;
     static $section_settings='tables';
     static $name_field_status_settings='NameFieldStatus';
     static $name_field_codocu_settings='NameFieldDocu';
   abstract protected function getTableSchema();
   abstract protected function hasAttribute($attibute);
   //abstract protected function getPrimaryKey($arr);

   
   
    private function sizeColumn($attribute)
	{
            if($attribute===null or !$this->hasAttribute($attribute) )
                throw new ServerErrorHttpException(Yii::t('base_errors', 'Don\'t exists the attribute or constant "{atributo}" in this class {clase} ',['atributo'=>$attribute,'clase'=>static::class]));
    		return $this->getTableSchema()->getColumn($attribute)->size;
	}   
        
   /* private function maxValue($attributename,$condition=null,$parameters=null){
            if(!is_null($condition) && !is_null($parameters)){                
            }else{
                $condition="1=1";$parameters=[];
            }
             try{
                 $clase=static::class; 
               $valor=$clase::find()->where($condition,$parameters)
			->max($attributename); 
            } catch (Exception $ex) {                    
            } 
           // var_dump($valor);die();
            return (!is_null($valor))?$valor+0:0;
        }
    */
      public function Correlativo ($attribute,
                 $condition=null,
                 $parameters=null,
                 $prefijo=null,
                 $ancho=null) {
            $maxValue=$this->maxValue($attribute,$condition,$parameters);
            $maxValue=(is_null($maxValue))?'1':($maxValue+1).'';            
            
                    $widthColumn=$this->sizeColumn($attribute);
                if(!is_null($prefijo) and !is_null($ancho)){                
                        $ancho=($ancho > $widthColumn )?$widthColumn:$ancho; 
                        $this->checkPrefixField($attribute,$prefijo,$ancho);
                          
                    }
                    
                 if(is_null($prefijo) and !is_null($ancho)){
                     $prefijo=$this->getPrefijo();
                        $ancho=($ancho > $widthColumn )?$widthColumn:$ancho; 
                         $this->checkPrefixField($attribute,$prefijo,$ancho);
                        
                  }
                  
                if(!is_null($prefijo) and is_null($ancho)){
                            $ancho=$widthColumn;
                           $this->checkPrefixField($attribute,$prefijo,$ancho);
                          
                    }
                 if(is_null($prefijo) and is_null($ancho)){
                   $prefijo='';
                 $ancho=$widthColumn;
                   $this->checkPrefixField($attribute,$prefijo,$ancho);
                
                    }
               IF($maxValue=='1')
             return $prefijo.str_pad($maxValue,$ancho-strlen($prefijo),"0",STR_PAD_LEFT);
                return str_pad($maxValue,$ancho,"0",STR_PAD_LEFT);
             }
        
             
             private function checkPrefixField($attribute,$prefix,$width){
           $tamanocol=$this->sizeColumn($attribute)+0;
            if(strlen($prefix) >=$tamanocol  )throw new ServerErrorHttpException(Yii::t('error', 'The prefix field "{prefix}" is greater than width of attribute {attribute} ',['prefix'=>$prefix,'attribute'=>static::class]));
            //if($width+0 >=$tamanocol  )throw new ServerErrorHttpException(Yii::t('error', 'The prefix field "{prefix}" is greater than width of attribute {attribute} ',['prefix'=>$prefix,'attribute'=>static::class]));
    		
            if(strlen($prefix)+strlen($width) > $tamanocol ) throw new ServerErrorHttpException(Yii::t('error',
                    ' width ({lcolumn}) of column {columna} is too small to fill values with the size prefix ( {lprefix}) and size lenght ({lsize}) ',
                    ['lprefix'=>$prefix,'lsize'=>$width,'lcolumn'=>$tamanocol,'columna'=>$attribute  ]));
        }
        
        
        
        public function getAppModels($module = null)
        {
                if ($module === null) {
                        $module = Yii::$app;
                } elseif (is_string($module)) {
                    if(!yii::$app->hasModule($module))
                     throw new ServerErrorHttpException(Yii::t('models.error',
                    ' The Application doesn\'t have the  module \'{module}\'',
                    ['module'=>$module]));
                        $module = Yii::$app->getModule($module);
                        }
                $result = [];
                 $this->getModelRecursive($module, $result);
                    return array_unique($result);
         }
         
          protected function getModelRecursive($module, &$result)
    {
        //$token = "Get Route of '" . get_class($module) . "' with id '" . $module->uniqueId . "'";
       // Yii::beginProfile($token, __METHOD__);
        try {
            foreach ($module->getModules() as $id => $child) {
                if (($child = $module->getModule($id)) !== null) {
                    $this->getModelRecursive($child, $result);
                }
            }

          
            $namespace = trim($module->controllerNamespace, '\\') . '\\';
            $namespace=str_replace('controllers','models',$namespace);
            //var_dump($namespace);die();
            $this->getModelFiles($module, $namespace, '', $result);
            //agregando los modelos de common
            $namespace='common\models\masters\\';
            $this->getModelFiles($module, $namespace, '', $result);
            
            
           // $all = '/' . ltrim($module->uniqueId . '/*', '/');
           // $result[$all] = $all;
        } catch (\Exception $exc) {
            Yii::error($exc->getMessage(), __METHOD__);
        }
       // Yii::endProfile($token, __METHOD__);
    }

       protected function getModelFiles($module, $namespace, $prefix, &$result)
    {
        $path = Yii::getAlias('@' . str_replace('\\', '/', $namespace), false);
        //$token = "Get controllers from '$path'";
       // Yii::beginProfile($token, __METHOD__);
         
        
        try {
            if (!is_dir($path)) {
                return;
            }
            foreach (scandir($path) as $file) {
                if ($file == '.' || $file == '..') {
                    continue;
                }
                if (is_dir($path . '/' . $file) && preg_match('%^[a-z0-9_/]+$%i', $file . '/')) {
                    $this->getModelFiles($module, $namespace . $file . '\\', $prefix . $file . '/', $result);
                } else {
                    $baseName = basename($file);
                   
                    $name = strtolower(preg_replace('/(?<![A-Z])[A-Z]/', ' \0', $baseName));
                    $id = ltrim(str_replace(' ', '-', $name), '-');
                    $className = $namespace . $baseName;
                  
                    $className=strrev(substr(strrev($className),4));
                    //IF(class_exists($className))
                    // ECHO $className."<BR>";
                    //VAR_DUMP($className);
                    //echo $className."    ".(class_exists($className))?'   Existe ':'   no EXISTE '."<BR>";
                    if ( class_exists($className) && is_subclass_of($className, 'common\models\base\modelBase')) {
                         if( !method_exists($className, 'search'))  {
                            //ECHO $className."<BR>";
                                 $result[]=$className; 
                         }   
                           
                    }
                }
            }
        } catch (\Exception $exc) {
            Yii::error($exc->getMessage(), __METHOD__);
        }
        //Yii::endProfile($token, __METHOD__);
    }
    
    /*
     * Esta funcion rellena la clave primaraia de un modelo 
     * siempre que sea de columna simple y del tipo string 
     * ademas que se encuentre vac{io
     */
    public function setPrimaryKey($prefijo=null){
        $clave=$this->getPrimaryKey(true);
       if( count($clave)==1){
          foreach($clave as $nameField=>$valor){
              if($this->getTableSchema()->getColumn($nameField)->phpType=='string')
              if(is_null($valor) or empty($valor))
              $this->{$nameField}=$this->correlativo($nameField,null,null,$prefijo,null);
              return true;
          }
        }
       return false;
    }
     
  public function charToBoolean($value) {
      return ($value==='1')?true:false;
  }  
  
 
        
}
