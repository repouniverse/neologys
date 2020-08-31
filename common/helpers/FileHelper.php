<?php
/*
 * Esta clase para ahorrar tiempo
 * Evitando escribir Yii::$app->
 */
namespace common\helpers;
use yii;
use common\helpers\h;
use yii\helpers\FileHelper as FileHelperOriginal;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;
class FileHelper extends FileHelperOriginal {
   
    const NOT_FOUND_MESSAGE='HTTP/1.1 404 Not Found';
    public static function extImages(){
        return ['jpg','bmp','png','jpeg','gif','svg','ico'];
    }
    
    
    public static function getModelsByModule($moduleName,$withExt=False){
        //$archivos=self::findFiles(yii::getAlias('@common/models')); 
        $archivox=[];
        //PRINT_R(self::getPathModules());DIE();
        $archivos=self::getModelsFromModules($moduleName);
        foreach($archivos as $k=>$valor){
            if($withExt){
               $archivox[]=self::normalizePath(str_replace(yii::getAlias('@root'),'',$valor),'\\');
         
            }else{
              $archivox[]=str_replace('.php','',self::normalizePath(str_replace(yii::getAlias('@root'),'',$valor),'\\'));
          
            }
            }
        return $archivox;
      }
      
    
    public static function getModels($withExt=False){
        //$archivos=self::findFiles(yii::getAlias('@common/models')); 
        $archivox=[];
        //PRINT_R(self::getPathModules());DIE();
        $archivos=array_merge(
                    self::findFiles(yii::getAlias('@common/models')),
                    self::findFiles(yii::getAlias('@backend/models')),
                    self::findFiles(yii::getAlias('@frontend/models')),
                    self::getModelsFromModules()
                );
        foreach($archivos as $k=>$valor){
            if($withExt){
               $archivox[]=self::normalizePath(str_replace(yii::getAlias('@root'),'',$valor),'\\');
         
            }else{
              $archivox[]=str_replace('.php','',self::normalizePath(str_replace(yii::getAlias('@root'),'',$valor),'\\'));
          
            }
            }
        return $archivox;
      }
     
      
      
      public static function getModelsFromModules($moduleName=null){
          $arreglo=[];
        foreach(self::getPathModules($moduleName) as $k=>$ruta){
           
           if (is_dir($ruta)){
                 //echo "l ruta  -> ".$ruta."<br>";
                    $arreglo=array_merge($arreglo, self::findFiles($ruta));
                        }
            }          
          return $arreglo;
      }
      
      
      
    public static function getPathModules($moduleName=null){
         $ff=[];
         $caminos=array_values(yii::$app->getModules()); 
         if(!is_null($moduleName)){
          //return  var_dump(yii::$app->getModules()[$moduleName]); 
            // print_r(array_values($caminos));die();
             //foreach($caminos as $calve=>$valor){
         $ff[]=self::preparePathForFindModels(yii::$app->getModules()[$moduleName]::className());
            return $ff;
          // print_r(yii::$app->getModules()[$moduleName]::className());die();
                          }
        // }
         
        //PRINT_R(ARRAY_VALUES(yii::$app->getModules()));DIE();
        foreach($caminos as $calve=>$valor){
            
          if(is_array($valor)){
             
              
              $ff[]=self::preparePathForFindModels($valor['class']);
          }
        }
         return $ff;   
    
    }
    
    /*
     * Esta funcion se encarga de arreglar las rutas cortas
     * de los nombres de clases u otra rutas y los convierte
     * a rutas absolutas; pero le agrega ua subraiz 'models' , todo esto con el fin 
     * de que puedan verificarse los archivos con la funcion FIndFiles()
     * al momento de buscar modelos
     * ejemplo: 
     * 
     *     "frontend/sta\\midirectorio" => 
     *     "/home/wwwcase/public_html/frontend/sta/models"
     * 
     * 
     */
    private function preparePathForFindModels($path){
       $path=trim($path);
        $path=(StringHelper::startsWith($path,'\\'))?substr($path,1):$path;
        $path=(StringHelper::startsWith($path,'/'))?substr($path,1):$path;
          $path=(StringHelper::endsWith($path,'\\'))?substr($path,0,strlen($path)-1):$path;
        $path=(StringHelper::startsWith($path,'/'))?substr($path,strlen($path)-1):$path;
         $separator="/";
        $path=self::normalizePath($path,$separator);
         $position= strpos(strrev($path),$separator);
         $path=substr($path,0,strlen($path)-$position);
         return self::normalizePath(yii::getAlias('@'.$path).$separator.'models',DIRECTORY_SEPARATOR);
    }
      
    /*Devuelve el nombre un archivo de espeficicacion larga
     * vale para especificaciones de clases y rutas de archivos
     *  /Commin/aperded//demas.php  devuelve  demas
     *  /Commin/aperded//demas       devuelve demas  
     */
   public static function getShortName($fileName,$delimiter=DIRECTORY_SEPARATOR){
       $className = $fileName;
       if (preg_match('@\\\\([\w]+)$@', $fileName, $matches)) {
            $className = $matches[1];
        }
        return $className;
     /*  
       $fileName=self::normalizePath($fileName,$delimiter);
       RETURN strrev( substr(strrev($fileName),
                            4,
                            (strpos(strrev($fileName),$delimiter)===false)?strlen(strrev($fileName))-4:strpos(strrev($fileName),$delimiter)-4
                                )
                    );*/
   }
   
   public function getUrlImageUserGuest(){
       $directorio=yii::getAlias('@common/web/img').DIRECTORY_SEPARATOR;
       if(!is_dir($directorio))
         throw new \yii\base\Exception(Yii::t('base.errors', 'The  \''.$directorio.'\' Directory doesn\'t exists '));
        if(!is_file($directorio.'anonimus.png'))
       throw new \yii\base\Exception(Yii::t('base.errors', 'The  \''.$directorio.'anonimus.png\' Picture doesn\'t exists '));
        return \yii\helpers\Url::base().'/img/anonimus.png';
   }
   
   /*
    * Arroja la imagen anonima
    */
   public static function UrlEmptyImage(){
       $alias=yii::getAlias('@common/web/img/nophoto.png');
       if(!is_file($alias))
       throw new \yii\base\Exception(Yii::t('base.errors', 'The  file {archivo} doesn\'t exists ',['archivo'=>$alias])); 
       return self::normalizePath(\yii\helpers\Url::base().'/img/nophoto.png',DIRECTORY_SEPARATOR);
       
   }
   
    /*
    * Arroja la imagen loading
    */
   public static function UrlLoadingImage(){
       $alias=yii::getAlias('@frontend/web/img/loading.gif');       
       return self::normalizePath(\yii\helpers\Url::base().'/img/loading.gif',DIRECTORY_SEPARATOR);
       
   }
   
    public static function UrlEmptyFile(){
       $alias=yii::getAlias('@frontend/web/img/nofile.png');
       if(!is_file($alias))
       throw new \yii\base\Exception(Yii::t('base.errors', 'The  file {archivo} doesn\'t exists ',['archivo'=>$alias])); 
       return self::normalizePath(\yii\helpers\Url::base().'/img/nofile.png',DIRECTORY_SEPARATOR);
       
   }
   
   
   public static function UrlSomeFile(){
       $alias=yii::getAlias('@frontend/web/img/somefile.png');
       if(!is_file($alias))
       throw new \yii\base\Exception(Yii::t('base.errors', 'The  file {archivo} doesn\'t exists ',['archivo'=>$alias])); 
       return self::normalizePath(\yii\helpers\Url::base().'/img/somefile.png',DIRECTORY_SEPARATOR);
       
   }
   
   
   /*
    * Checka si una uirl a un archivo funciona o esta roto el link
    */
   public static function checkUrlFound($urlAbsolute){
       $file = $urlAbsolute;     
       
        $file_headers = @get_headers($file);
        
        //var_dump($file_headers );
            if(!$file_headers || strpos($file_headers[0],'200')===false/*$file_headers[0] == static::NOT_FOUND_MESSAGE*/) {
                $exists = false;
                }
                    else {
                $exists = true;
            }
         return true;
   }
   
   /*
    * FORMTEA BYTES EN OTRAS UNIDEDADES
    */
  public static function formatBytes($bytes, $decimals = 2) {
  $sz = 'BKMGTP';
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}
 
public static function extensionFile($filePath,$conpunto=false){
    
  if ((strpos($filePath, '\\')>0) or (strpos($filePath, '/')>0)){
      $path_parts = pathinfo($filePath);
       return  (($conpunto)?'.':'').$path_parts['extension'];
  }else{
     if(strpos($filePath,'.')>0){
         return (($conpunto)?'.':'').strrev(substr(strrev($filePath),0,strpos(strrev($filePath),'.'))); 
     }else{
         return '';
     }
    
  }
    
}


public static function extDocs(){
    return array('rar','ppt','pptx','doc','docx','xls','xlsx','pdf','jpg','jpeg','png'); 
}

public static function extIconsDocs(){
    return array('ppt'=>'fa-file-powerpoint','pptx'=>'fa-file-powerpoint',
        'doc'=>'fa-file-word','docx'=>'fa-file-word',
        'xls'=>'fa-file-excel','xlsx'=>'fa-file-excel','pdf'=>'fa-file-pdf','jpg'=>'fa-file-image',
        'jpeg'=>'fa-file-image','png'=>'fa-file-image'); 
}
public static function getIconDocs($extension){
   if(substr(trim($extension),0,1)=='.')
   $extension=substr(trim($extension),1);
   if(array_key_exists($extension, self::extIconsDocs())){
       return self::extIconsDocs()[$extension];
   }else{
       return 'fa-file';
   }
}

public static function randomNameFile($ext){
    if(!(substr($ext,0,1)=='.'))
      $ext='.'.$ext;    
    return uniqid().'_'.h::userId()/*.'_'.str_replace('.','_',h::request()->getUserIP())*/.$ext;
}

public function isImage($filePath){
   $ext=self::extensionFile($filePath);
   return in_array($ext,self::extImages());
}


public function UrlImage($path,$internal=true){
 if(is_file($path)){
    /* echo " path  : ".$path; echo "<br>";
     echo " path  alias root  : ".yii::getAlias('@root')."<br>";
     echo " URL BASE :   ".\yii\helpers\Url::base(true)."<br>";
     */
     if($internal){
        return str_replace(yii::getAlias('@root'),'',$path);
      }else{
       $ruta= str_replace(yii::getAlias('@root'), \yii\helpers\Url::base(true) ,$path);  
       $ruta=str_replace(\yii\helpers\Url::home(),'/',$ruta);
       return $ruta;
      }
 }else{
   return '';  
 }
  
}

/*Reemplaza una 
 * funci
 */
 public static function replaceSlashesPath($pathClass,$sinSlashes=true){
    $character='_';
    $slash='\\';    
    return ($sinSlashes)?str_replace($slash,$character,$pathClass):str_replace($character,$slash,$pathClass);
    
  }

/*
 * Deuelce deunnarray de rutas 
 * claevs: rutas de los archivos
 * valores: nombres de los archivos
 * 
 * si absolute =true 
 * claves viene con ruta absoluta
 * si false devuelve ruta relativa 
 * 
 * 
 * Si inverse es true
 *  * claves: nombres de los archivos
 * valores: rutas de los archivos
 */
  public static function mapFiles($files,$absolute=false,$inverse=false){
      $arreglo=[];
      foreach($files as $file){
          $extension=self::extensionFile($file, true);
          $file=($absolute)?file:self::toPathRelative($file);
          $arreglo[$file]= str_replace($extension,'',basename($file));
          
      }
      
      if($inverse){
          return array_flip($arreglo);
      }
      return $arreglo;
  }
  
  
  /*
 * Deuelce deunnarray de rutas 
 * claevs: rutas de los archivos
 * valores: nombres de los archivos
 * 
 *
 */
  public static function mapFilesView($files){
      $arreglo=[];
      foreach($files as $file){
          $extension=self::extensionFile($file, true);  
          $file=self::normalizePath(str_replace($extension,'',str_replace(yii::$app->viewPath,'',$file)),'/');
          $arreglo[$file]= str_replace($extension,'',basename($file));
          
      }
      
      
      return $arreglo;
  }
  
  /*
   * Devuelve la ruta de un archivo 
   * es decir reemplaza la ruta larga por 
   * una ruta corta 
   *  c:\xampp\htodocs\frontend\views\mivista.php
   * devuelve 
   *   \frontend\views\mivista.php
   * 
   * Reemplza el yii::getAlias('@root) por una cadena vacía ''
   */
  public static function toPathRelative($absolutePath){
      return str_replace(yii::getAlias('@root'), '', $absolutePath);
  }
  
  
}