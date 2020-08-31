<?php
namespace backend\components;
use common\helpers\FileHelper;
use common\models\masters\Combovalores;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use console\config\baseTrait;
use console\components\Command;
use yii\helpers\Json;
use yii\web\session;
use common\helpers\h;
USE yii2mod\settings\models\enumerables\SettingType;

/**
 * Class Installer
 *
 * Contains all of the Business logic to install the app. Either through the CLI or the `/install` web UI.
 *
 * @package App\Utilities
 */
class Installer
{
    use \common\traits\baseTrait;
  /*Defdiniendo las constates para almacenar las 
    * rutas a los archivos config de cada aplicacion
    */
    const PATH_FILE_ENV=__dir__.'/../../.env';
    const PATH_FILE_ENV_EXAMPLE=__dir__.'/../../.env.example';
    const CONFIG_COMMON_LOCAL=__dir__.'/../../common/config/main-local.php';
    const CONFIG_COMMON_MAIN=__dir__.'/../../common/config/main.php';
    const CONFIG_BACKEND_MAIN=__dir__.'/../../backend/config/main_copy.php';
    const CONFIG_BACKEND_LOCAL=__dir__.'/../../backend/config/main-local_copy.php';
    const CONFIG_FRONTEND_MAIN=__dir__.'/../../frontend/config/main_copy.php';
    const CONFIG_FRONTEND_LOCAL=__dir__.'/../../frontend/config/main-local_copy.php';
    const CONFIG_CONSOLE_MAIN=__dir__.'/../../console/config/main_copy.php';
    const CONFIG_CONSOLE_LOCAL=__dir__.'/../../console/config/main-local_copy.php'; 
    const CONFIG_X=__dir__.'/../../common/config/main_copy.php'; 
    
    CONST USER_GUEST='invitado';
/*
 * Rutas definidas para los roles
 * que deben aprecer en el widget del menu
 * som funciones basicas que debe de tenr cualquier usuario
 */

    
     public static function getRutas() {
         return [
             'RBAC'=>[
        '/admin/permission/index'=>Yii::t('base_labels', 'Permissions'),
       // '/admin/permission/create'=>Yii::t('base.actions', 'Crear Permiso'),
         '/admin/role/index'=>Yii::t('base_labels', 'Roles'),
        '/admin'=>Yii::t('base_labels', 'Assignments'),
                 
         '/admin/rule/index'=>Yii::t('base_labels', 'Rules'),
       // '/admin/rule/create'=>Yii::t('base.actions', 'Crear Regla'),
           ],
             'User'=>[
                        //'/admin/user/logout'=>Yii::t('base.actions', 'Salir'),
                        '/admin/user/signup'=>Yii::t('base_labels', 'Check in'),
                        //'/admin/user/request-password-reset'=>Yii::t('base.actions', 'Solicitar'),
                        //'/admin/user/reset-password'=>Yii::t('base.actions', 'Reset Pwd'),
                        '/admin/user/change-password'=>Yii::t('base_labels', 'Change Password'),
                  ],
             
             'Menu'=>[
                        //'/admin/menu/create'=>Yii::t('base.actions', 'Crear Menu'),
                        '/admin/menu/index'=>Yii::t('base_labels', 'Menu'),
                        '/admin/route/index'=>Yii::t('base_labels', 'Routes'),
                       // '/admin/route/create'=>Yii::t('base.actions', 'Crear Ruta'),
                       
                  ],
             'Basic Settings'=>[
                        '/base/configuracion/index'=>Yii::t('base_labels', 'Parameters Group'),
                        '/base/configuracion/parametros-mail'=>Yii::t('base_labels', 'Settings Mail'),
                        '/base/configuracion/index-campos-valores'=>Yii::t('base_labels', 'Masters Fields'),
                        '/base/configuracion/index-combo-valores'=>Yii::t('base_labels', 'Masters Fields Values'),
                         '/base/configuracion/index-transacciones'=>Yii::t('base_labels', 'Transactions'),
                        
                  ],
                 'Masters Values'=>[
                        '/maestros/default/index-alumnos'=>Yii::t('base_labels', 'Students'),
                         '/maestros/default/index-departamentos'=>Yii::t('base_labels', 'Departaments'),
                         '/maestros/default/index-docu'=>Yii::t('base_labels', 'Documents'),
                         '/maestros/default/index-facul'=>Yii::t('base_labels', 'Faculties'),
                        '/maestros/default/index-grupo-personas'=>Yii::t('base_labels', 'People Group'),
                     '/maestros/default/index-periodo'=>Yii::t('base_labels', 'Periods'),
                      '/maestros/default/index-persona'=>Yii::t('base_labels', 'People'),
                  '/maestros/default/index-trabajadores'=>Yii::t('base_labels', 'Workers'),
                      '/maestros/default/index-univer'=>Yii::t('base_labels', 'Universities'),
             ],
             
             'Herramientas'=>[
                        '/import/importacion'=>Yii::t('base_labels', 'Import'),
                         //'/maestros/default/index-departamentos'=>Yii::t('base_labels', 'Departaments'),
                         ],
             
              'Internacional'=>[
                        '/inter/programa'=>Yii::t('base_labels', 'Programs'),
                         //'/maestros/default/index-departamentos'=>Yii::t('base_labels', 'Departaments'),
                         ],
             
             //'parameters'=>[
                        //'/parameteres/createmaster'=>Yii::t('base.actions', 'Crear Parametro'),
                        //'/parameters/createparamdocu'=>Yii::t('base.actions', 'Crear Paramaeters Documents'),
                        //'/parameters/index'=>Yii::t('base.names', 'Param Centros'),
                        //'/parameters/indexmaster'=>Yii::t('base.names', 'Parametros'),
                        //'/parameters/indexparamdocu'=>Yii::t('base.names', 'Param Docum'), 
                  //],
             
             ];
        }
        
     
        
        
        
    public static function  getPurerutas($rutasP=[]){
       if(count($rutasP)>0){
           $proc=$rutasP;
       }else{
          $proc=static::getRutas(); 
       }
        
        $rutas=[];
        foreach($proc as $clave=>$matriz){
            $rutas=array_merge($rutas,array_keys($matriz));
        }
        return $rutas;
    }  
    
    
    public static function  registerRuta(){
        
    }
        
        
    public static function isFileEnv(){
        return is_file(__DIR__ . '/../web/.env');
    }
    
    public static function isFileEnvExample(){
        return is_file(__DIR__ . '/../web/.env.example');
    }
    
    /*Verifica si la aplicacion esta en modo instalacion 
     * Inmportante 
     */
    public static function alreadyInstalled(){
        if(trim(Installer::readEnv('APP_INSTALLED'))=='false')
        return false;
        return true;  
    }
    
    public static function redirectInstall(){
      return  Yii::$app->controller->redirect(['install/requirements/show']);
    }
    
    
    public static function createFirstUser(){
        $model = new \mdm\admin\models\User();
            $model->username='admin';
             $model->email='micorreoxyz@hotmail.com';   
             $model->password='123456'; 
             //$model->retypePassword='123456'; 
               $model->status=\mdm\admin\models\User::STATUS_ACTIVE;
             $model->save(); 
             $model->refresh();
             return $model->id;
    }
    
    /*Se encarga de idrecionar a los controlladores de los instaladores 
     * si no se ha instalado la applicacion
     * 
     */
    public static function  ManageInstall(){
       if(static::isFileEnv()){            
            if(!static::alreadyInstalled()){
                return  Yii::$app->controller->redirect(['install/language'])->send();
             }
        }else{
           
            if(static::isFileEnvExample()){
                //copiar al archivio .env
                 Installer::createDefaultEnvFile();
                 //redirigr al instalador
                 static::redirectInstall();
            }else{
                //lanzar el error 
                throw new \yii\base\Exception(
                   yii::t('install.errors','The  \'.env.example\' file  don\'t exists, please check for it')
                   ); 
            }
            
        }
    }
    
    
    public static function checkServerRequirements()
    {
        $requirements = array();

        if (ini_get('safe_mode')) {
            $requirements[] = trans('install.requirements.disabled', ['feature' => 'Safe Mode']);
        }

        if (ini_get('register_globals')) {
            $requirements[] = trans('install.requirements.disabled', ['feature' => 'Register Globals']);
        }

        if (ini_get('magic_quotes_gpc')) {
            $requirements[] = trans('install.requirements.disabled', ['feature' => 'Magic Quotes']);
        }

        if (!ini_get('file_uploads')) {
            $requirements[] = trans('install.requirements.enabled', ['feature' => 'File Uploads']);
        }

        if (!function_exists('proc_open')) {
            $requirements[] = trans('install.requirements.enabled', ['feature' => 'proc_open']);
        }

        if (!function_exists('proc_close')) {
            $requirements[] = trans('install.requirements.enabled', ['feature' => 'proc_close']);
        }

        if (!class_exists('PDO')) {
            $requirements[] = trans('install.requirements.extension', ['extension' => 'MySQL PDO']);
        }

     /*   if (!extension_loaded('openssl')) {
            $requirements[] = trans('install.requirements.extension', ['extension' => 'OpenSSL']);
        }

        if (!extension_loaded('tokenizer')) {
            $requirements[] = trans('install.requirements.extension', ['extension' => 'Tokenizer']);
        }

        if (!extension_loaded('mbstring')) {
            $requirements[] = trans('install.requirements.extension', ['extension' => 'mbstring']);
        }

        if (!extension_loaded('curl')) {
            $requirements[] = trans('install.requirements.extension', ['extension' => 'cURL']);
        }

        if (!extension_loaded('xml')) {
            $requirements[] = trans('install.requirements.extension', ['extension' => 'XML']);
        }

        if (!extension_loaded('zip')) {
            $requirements[] = trans('install.requirements.extension', ['extension' => 'ZIP']);
        }

        if (!extension_loaded('fileinfo')) {
            $requirements[] = trans('install.requirements.extension', ['extension' => 'FileInfo']);
        }

        /*if (!is_writable(Yii::getAlias('@app').'/storage/app')) {
            $requirements[] = yii::t('install.requirements.directory', ['directory' => 'storage/app']);
        }

        if (!is_writable(Yii::getAlias('@app').'/storage/app/uploads')) {
            $requirements[] = yii::t('install.requirements.directory', ['directory' => 'storage/app/uploads']);
        }

        if (!is_writable(Yii::getAlias('@app').'/storage/framework')) {
            $requirements[] = yii::t('install.requirements.directory', ['directory' => 'storage/framework']);
        }

        if (!is_writable(Yii::getAlias('@app').'/storage/logs')) {
            $requirements[] = yii::t('install.requirements.directory', ['directory' => 'storage/logs']);
        }
*/
        return $requirements;
    }

    /**
     * Create a default .env file.
     *
     * @return void
     */
	public static function createDefaultEnvFile()
	{
        // Rename file
        
            rename(__DIR__.'/../web/.env.example', __DIR__.'/../web/.env');
       

        
	}

    public static function createDbTables($host, $port, $database, $username, $password)
    {
        if (!static::isDbValid($host, $port, $database, $username, $password)) {
            return false;
        }
        set_time_limit(300); // 5 minutes 
         Command::execute('migrate/up', ['interactive' => false]);
         Command::execute('migrate', ['migrationPath'=>'@yii/rbac/migrations', 'interactive' => false]);  
        Command::execute('migrate', ['migrationPath'=>'@yii2mod/settings/migrations', 'interactive' => false]);  
      Command::execute('migrate', ['migrationPath'=>'@mdm/admin/migrations', 'interactive' => false]);  
     Command::execute('migrate', ['migrationPath'=>'@nemmo/attachments/migrations', 'interactive' => false]);  
           
     
        // Set database details
        static::saveDbVariables($host, $port, $database, $username, $password);

        return true;
    }

    /**
     * Check if the database exists and is accessible.
     *
     * @param $host
     * @param $port
     * @param $database
     * @param $host
     * @param $database
     * @param $username
     * @param $password
     *
     * @return bool
     */
    public static function isDbValid($host, $port, $database, $username, $password)
    {
       
        $dsn=static::readEnv('DB_CONNECTION','mysql').':host='.$host.'; port='.$port.';dbname='.$database;
        $charset=trim(static::readEnv('DB_CHARSET', 'utf8mb4'));
        $filePathConfig=static::CONFIG_COMMON_LOCAL;
        $routeArray='components\db\\';        
        $db = new \yii\db\Connection([
                'dsn' => $dsn,
                'username' => $username,
                'password' => $password,
                'charset' => trim(static::readEnv('DB_CHARSET', 'utf8mb4')),
                ]); 
   try{       
      $db->open();  
   } catch (\yii\db\Exception $exception) {
       echo $exception->getMessage(); 
       return false;
   } finally{
       unset($db);
   }   
   //cadena dsn
   static::setConfigYii($routeArray.'dsn',$dsn,$filePathConfig);
     //username
   static::setConfigYii($routeArray.'username',$username,$filePathConfig);
   //pass
   static::setConfigYii($routeArray.'password',$password,$filePathConfig);
      //charset
   static::setConfigYii($routeArray.'charset',
               trim(static::readEnv('DB_CHARSET', 'utf8mb4')),
               $filePathConfig);   
  //takle prefix
    static::setConfigYii($routeArray.'tablePrefix',
           static::generateRandomString(5).'_', 
          $filePathConfig);
  return true; 
    }
    
    
    
    public static function saveDbVariables($host, $port, $database, $username, $password)
    {
        //$prefix = static::generateRandomString(3);

        // Update .env file
        static::updateEnv([
            'DB_HOST'       =>  $host,
            'DB_PORT'       =>  $port,
            'DB_DATABASE'   =>  $database,
            'DB_USERNAME'   =>  $username,
            'DB_PASSWORD'   =>  $password,
            //'DB_PREFIX'     =>  $prefix,
        ]);

    }




    public static function finalTouches()
    {
       
        Installer::createSettings();
       // $session=yii::$app->session;
        
        static::updateEnv([
            'APP_LOCALE'    =>  h::app()->language,
            'APP_INSTALLED' =>  'true',
            'APP_DEBUG'     =>  'false',
        ]);
        
        
        
        /*Como ya se stablecio la configuracion de la bd
         * podemos acceder a este componente como si nada
         * 
         */
       
        //Colocamos el tamaño del campo maximo del codigo de material 
        h::settings()->set('tables',
                'sizecodigomaterial',
                 h::db()->getSchema()->
                getTableSchema('{{%maestrocompo}}')->
                columns['codart']->size
                );
        
        
        /*cREAMOS UN USUARIO invitado*/
        $class = Yii::$app->getUser()->identityClass ? : 'mdm\admin\models\User';
            $user = new $class();
            $user->username = self::USER_GUEST;
            $user->email = 'xxx@xxx.com';
            $user->status = \mdm\admin\components\UserStatus::ACTIVE;
            $user->setPassword('123456');
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        
    }

    public static function updateEnv($data)
    {
      
        //echo yii::getAlias('@webroot').'.env';die();
        if (empty($data) || !is_array($data) || !is_file(yii::getAlias('@webroot').DIRECTORY_SEPARATOR .'.env')) {
            return false;
        }

        $env = file_get_contents(yii::getAlias('@webroot').DIRECTORY_SEPARATOR .'.env');

        $env = explode("\n", $env);

        foreach ($data as $data_key => $data_value) {
            $updated = false;

            foreach ($env as $env_key => $env_value) {
                $entry = explode('=', $env_value, 2);

                // Check if new or old key
                if ($entry[0] == $data_key) {
                    $env[$env_key] = $data_key . '=' . $data_value;
                    $updated = true;
                } else {
                    $env[$env_key] = $env_value;
                }
            }

            // Lets create if not available
            if (!$updated) {
                $env[] = $data_key . '=' . $data_value;
            }
        }

        $env = implode("\n", $env);

        file_put_contents(yii::getAlias('@webroot').DIRECTORY_SEPARATOR .'.env', $env);

        return true;
    }
    
    /*Lee un parametro del archivo .ENV*/
    public static function readEnv($key,$default=null)
    {
        $retorno=null;
        if(is_file(self::PATH_FILE_ENV)){
        
        $env = file_get_contents(self::PATH_FILE_ENV);
        
        $env = explode("\n", $env);
       
            foreach ($env as $env_key => $env_value) {
                $entry = explode('=', $env_value, 2);
                // Check if new or old key
                if ($entry[0] == $key) {
                    $retorno= $entry[1];
                    break;
                } 
            }
        } 
      return (is_null($retorno))?$default:trim($retorno);
       
    }
    
    
    public static function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
} 


public static function testMail($serverMail,$userMail,$passwordMail,$portMail){
 
    $transport = new \Swift_SmtpTransport();
    //echo get_class($transport);die();
          $transport->setHost($serverMail)
            ->setPort($portMail)
            ->setEncryption('tls')
            ->setStreamOptions(['ssl' =>['allow_self_signed' => true,'verify_peer_name' => false, 'verify_peer' => false]] )
            ->setUsername($userMail)
            ->setPassword($passwordMail);
        $mailer = new \Swift_Mailer($transport);
        $message =new  \Swift_Message();
            $message->setSubject('Test Message')
            ->setFrom(['hipogea@hotmail.com'=>'Jorge Paredes'])
            ->setTo('jramirez@neotegnia.com')
            ->setBody('Este es un test');

  
    try {
           set_time_limit(300); // 5 minutes    
        $result = $mailer->send($message);
        static::psetting('mail','servemail',$serverMail);//'mail.neotegnia.com'
          static::psetting('mail','userservermail',$userMail);//'jramirez@neotegnia.com',
          static::psetting('mail','passworduserservermail',$passwordMail);//'toxoplasma1',
           static::psetting('mail','portservermail',$portMail);// '25',
        
        
        
    } catch (\Swift_TransportException $Ste) {
      
        return $Ste->getMessage();
    }
    
    
    
}

private static function createRoutes($rutas=[]){
    
        $model = new \mdm\admin\models\Route();
        $model->addNew(static::getPureRutas());
        unset($model);
    
    
}

private static function revertCreateRoutes(){
        $model = new \mdm\admin\models\Route();
        $model->remove(static::getPureRutas());
        unset($model);
}

public static function revertCreateBasicRole(){
  \Yii::$app->db->createCommand("delete from {{%auth_assignment}}")->execute();
  \Yii::$app->db->createCommand("delete from {{%auth_item}}")->execute();    
   \Yii::$app->db->createCommand("delete from {{%auth_item_child}}")->execute(); 
    \Yii::$app->db->createCommand("delete from {{%menu}}")->execute();  
     \Yii::$app->db->createCommand("delete from {{%profile}}")->execute();
      \Yii::$app->db->createCommand("delete from {{%useraudit}}")->execute();
    \Yii::$app->db->createCommand("delete from {{%user}}")->execute(); 
}

public static function addMenu($rutas){
    /*Obteniendo el rol primero 
     * 
     */
    $clase=h::user()->identityClass;
    $user=$clase::find()->andWhere(['username'=>'admin'])->one();
    $rol=array_keys(Yii::$app->authManager->getRolesByUser($user->id))[0];
    yii::error($rol);
  $modelRol=\mdm\admin\models\AuthItem::find($rol);
    
  //yii::error($modelRol);die();
  yii::error('********iniciando el bucle de rutas***');
       foreach($rutas as $clave=>$arreglo){
           yii::error('********CLAVE ***'.$clave);
           $modelRol->addChildren(array_keys($arreglo));
           yii::error('********a colocar ***');
           yii::error($arreglo);
           yii::error('********creando el menu padre ***'.$clave);
            $modelMenu=new \mdm\admin\models\Menu();
        $modelMenu->setAttributes(['name'=>$clave,'route'=>'','parent'=>'','orden'=>'','data'=>'']);
        $modelMenu->save();$modelMenu->refresh();
        $idmMenu=$modelMenu->id;
        unset($modelMenu);
        yii::error('********INICIANDO  el bucle de  ***'.$clave);  
       foreach($arreglo as $ruta=>$nombre){
           yii::error('********NOMBRE RUTA ***'.$ruta.'***');
             $modelMenu=new \mdm\admin\models\Menu();
             $modelMenu->setAttributes([
                 'name'=> $nombre/*FileHelper::getShortName($accion) /*  str_replace('/admin/user/','',$accion)*/,
                 'route'=>$ruta,
                 'parent'=>$idmMenu,'orden'=>'',
                 'data'=>'']
                     );
            yii::error($modelMenu->attributes,__FUNCTION__);
            yii::error($modelMenu->save(),__FUNCTION__);
            yii::error($modelMenu->getErrors(),__FUNCTION__);
            //$idmMenu=$modelMenu->id;
             unset($modelMenu);
        
       }
        yii::error('********fINALIZANDO  el bucle de ***'.$clave);  
   }
    yii::error('********fINALIZANDO  el bucle de rutas***');  
}

public static function deleteMenu($ruta){
   $clase=h::user()->identityClass;
    $user=$clase::find()->andWhere(['username'=>'admin'])->one();
    if(!is_null($user)){
           $rol=array_keys(Yii::$app->authManager->getRolesByUser($user->id))[0];
    yii::error($rol);
  $modelRol=\mdm\admin\models\AuthItem::find($rol);
    
  //yii::error($modelRol);die();
  yii::error('********iniciando el bucle de rutas***');
       foreach($ruta as $clave=>$arreglo){
           yii::error('********CLAVE ***'.$clave);
           $modelRol->removeChildren(array_keys($arreglo));
          foreach($arreglo as $rutax=>$nombre){
              \mdm\admin\models\Menu::deleteAll(['route'=>$rutax]); 
               \mdm\admin\models\Menu::deleteAll(['name'=>$clave]); 
             }
                yii::error('********fINALIZANDO  el bucle de ***'.$clave);  
            }
            yii::error('********fINALIZANDO  el bucle de rutas***');  
    
    }
   
    
}
public static function createBasicRole($idUser){
    if(yii::$app->hasModule('admin')){
        static::createRoutes(); 
        
         //Recuerde que ya se almaceno el id del pirmer usuario 
        //en sesion , aqui solo se consulta la sesion
       // $idUser=yii::$app->session->get('newUser');
        //if(is_null($idUser))
         
        
        foreach(static::getRutas() as $clave=>$arreglo){
                $model = new \mdm\admin\models\AuthItem(null);
                $model->setAttributes(['name'=>'r_base'.$clave,
                                'type'=>1,
                                'description'=>'Rol base '.$clave,
                                ]);        
                    if($model->save()){ 
                                $model->addChildren(array_keys($arreglo));
                                
                            }
                $modelo = new \mdm\admin\models\Assignment($idUser);
                $success = $modelo->assign(['r_base'.$clave]);
                
                
                 /*
         * Creando el Menu Basico
         */
        
        $modelMenu=new \mdm\admin\models\Menu();
        $modelMenu->setAttributes(['name'=>$clave,'route'=>'','parent'=>'','orden'=>'','data'=>'']);
        $modelMenu->save();$modelMenu->refresh();
        $idmMenu=$modelMenu->id;
        unset($modelMenu);
        
        foreach($arreglo as $ruta=>$nombre){
             $modelMenu=new \mdm\admin\models\Menu();
             $modelMenu->setAttributes([
                 'name'=> $nombre/*FileHelper::getShortName($accion) /*  str_replace('/admin/user/','',$accion)*/,
                 'route'=>$ruta,
                 'parent'=>$idmMenu,'orden'=>'',
                 'data'=>'']
                     );
           $modelMenu->save();
            //$idmMenu=$modelMenu->id;
             unset($modelMenu);
        }               
       }
    }
  }

/*
 * Crea los parametros Settings BAsicos 
 * 
 */
public static function createSettings(){
   //echo "hola "; die();
     h::getIfNotPutSetting('mail','servermail',"smtp.googlemail.com", SettingType::STRING_TYPE);
        h::getIfNotPutSetting('mail','userservermail',"neotegnia@gmail.com", SettingType::STRING_TYPE);
        h::getIfNotPutSetting('mail','passworduserservermail',"mipass", SettingType::STRING_TYPE);
        h::getIfNotPutSetting('mail','portservermail',465, SettingType::STRING_TYPE);
       h::getIfNotPutSetting('timeUser','datetime','dd/mm/yyyy hh:ii:ss', SettingType::STRING_TYPE);
        h::getIfNotPutSetting('timeUser','date',"dd/mm/yyyy", SettingType::STRING_TYPE);
        h::getIfNotPutSetting('timeUser','datetime','dd/mm/yyyy hh:ii:ss', SettingType::STRING_TYPE);
         h::getIfNotPutSetting('timeBD','date',"Y-m-d", SettingType::STRING_TYPE);
        h::getIfNotPutSetting('timeBD','datetime','Y-m-d h:i:s', SettingType::STRING_TYPE);
    /* 
//Expresion regular para validar RUC
    h::settings()->set('general','formatoRUC','/[1-9]{1}[0-9]{10}/');    
    //Expresion regular para validar DNI
    h::settings()->set('general','formatoDNI','/[0-9]{8}/');    
    //IGV
    h::settings()->set('general','igv',0.18);    
    //Moneda por Default
    h::settings()->set('general','moneda', h::session()->get('codmon'));
    //longitud del campo de codigo de materiales     
    // h::settings()->set('general','sizecodigomaterial','/[1-9]{1}[0-9]{10}/');
    
     ////colocar si quiere direcciones o no 
     if(h::app()->hasModule('bigitems'))
     h::settings()->set('bigitems','WithPlaces', '0');
     
     ///formatos de tiempo
      h::settings()->set('timeUser','date', 'dd/mm/yyyy');
      h::settings()->set('timeUser','datetime', 'dd/mm/yyyy hh:ii:ss');
      h::settings()->set('timeUser','time', 'hh:ii:ss');
      h::settings()->set('timeUser','hour', 'hh:ii');
      h::settings()->set('timeBD','date', 'Y-m-d');
      h::settings()->set('timeBD','datetime', 'Y-m-d H:i:s');
      h::settings()->set('timeBD','time', 'H:i:s');
       h::settings()->set('timeBD','time', 'H:i:s');
        h::settings()->set('timeBD','hour', 'H:i');
      ///Valores para el modulo sta
      h::settings()->set('sta','regexcodalu','/[1-9]{1}[0-9]{3}[0-9]{1}[0-9]{3}[A-Z]{1}/');
     */
}



/*
 * Funcion que abre el archivo config main 
 * retorn un array cofig 
 */
public static  function getConfig($filePath){
    return require($filePath);
   // $config['mailer']['viewPath']='@\common\mail2';
   
  //echo(\yii\helpers\Json::encode($config)); die();
}

private static function ConfigToString($configuracion){
    $cad="<?php \n return [ ";
    //$configuracion=static::getConfig();
    $cad.=static::recursiveArrayToString($configuracion);
    $cad.="];  ?>";
    return $cad;
}


private static function recursiveArrayToString($arr){
    $cad="";
    foreach($arr as $key=>$value){
       if(is_array($value)){
           
             $cad.="'".$key."' =>[".static::recursiveArrayToString($value)."],\n";
         
                  }else{
                            if(is_bool($value)){
                             $cad.="'".$key."'=>".($value)?'true':'false'.",\n";       
                                   }else{
                                $cad.="'".$key."'=>'".$value."',\n";  
                                  }
                
       }
        
    }
    return $cad;
}


/*
 * FUNCION QUE EDITA EL ARCHIVO CONFIG DE YII
 *@key: Una cadena de la forma  clave\clave3\clave2
 * para indincar la profundidad de la clave del array
 *
 * @value: El valor 
 * @filePath: La ruta del archivo de configuracion
 * pejem: para escribir en la clave
 * $config['assetManager']['bundles'] =>'kartik\form\ActiveFormAsset'
 * @key debe de ser  'assetManager\bundles' y
 * @value 'kartik\form\ActiveFormAsset'
 */
 
public static function setConfigYii($key,$value,$filePath){ 
    $config= static::getConfig($filePath);
    $parts=$parts= explode('\\', $key);    
    if(count($parts)==1){
        $config[$parts[0]]=$value;
    }elseif (count($parts)==2) {
           $config[$parts[0]][$parts[1]]=$value; 
        }elseif (count($parts)==3) {
            $config[$parts[0]][$parts[1]][$parts[2]]=$value; 
        }elseif (count($parts)==4) {
            $config[$parts[0]][$parts[1]][$parts[2]][$parts[3]]=$value; 
        }elseif (count($parts)==5) {
           $config[$parts[0]][$parts[1]][$parts[2]][$parts[3]][$parts[4]]=$value;  
    }
    $archi=static::ConfigToString($config);
    file_put_contents($filePath, $archi);
   
   }
        





}
