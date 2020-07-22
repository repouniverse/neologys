<?php
/**
 *¡Es una clase que se hereda del componente
 * Mailer de yii\swiftmailer;
 * La ventaja es que lso parametros de configuracion 
 * los lee de una tabla en lugar del archivo config.php
 * Para esto se le asigna las propiedades al moemtno de 
 * inicializar
 */

namespace common\components;
use yii\swiftmailer\Mailer as Correo;
use common\helpers\h;
use yii;
class Mailer extends Correo
{
   use \common\traits\baseTrait;
   
   private $_opcionesTransport=null; //CREADA PARA ALMAECNAR LOS SETTINGS 
   /**
     * @var string message default class name.
     */
    public $messageClass = 'yii\swiftmailer\Message';
    /**
     * @var bool whether to enable writing of the SwiftMailer internal logs using Yii log mechanism.
     * If enabled [[Logger]] plugin will be attached to the [[transport]] for this purpose.
     * @see Logger
     * @since 2.0.4
     */
    public $enableSwiftMailerLogging = false;

    /**
     * @var \Swift_Mailer Swift mailer instance.
     */
    private $_swiftMailer;
    /**
     * @var \Swift_Transport|array Swift transport instance or its array configuration.
     */
    private $_transport = [];

    const MAIL_PORT_DEFAULT='25';
    const MAIL_SERVER_DEFAULT='mail.neotegnia.com';
    const MAIL_USER_SERVER_DEFAULT='25';
    public function init(){
       // yii::$app->settings->set('section', 'key', 1258.5);
        //yii::error(static::arrayConfig());
        //var_dump(static::arrayConfig());die();
        $this->_transport=$this->optionsTransport[0];
        
        return parent::init();
    }

    /**
     * @return array|\Swift_Mailer Swift mailer instance or array configuration.
     */
    public function getSwiftMailer()
    {
        if (!is_object($this->_swiftMailer)) {
            $this->_swiftMailer = $this->createSwiftMailer();
        }

        if (!$this->_transport->ping()) {
            $this->_transport->stop();
            $this->_transport->start();
        }

        return $this->_swiftMailer;
    }

    /**
     * @param array|\Swift_Transport $transport
     * @throws InvalidConfigException on invalid argument.
     */
    public function setTransport($transport)
    {
        if (!is_array($transport) && !is_object($transport)) {
            throw new InvalidConfigException('"' . get_class($this) . '::transport" should be either object or array, "' . gettype($transport) . '" given.');
        }
        $this->_transport = $transport;
        $this->_swiftMailer = null;
    }

    /**
     * @return array|\Swift_Transport
     */
    public function getTransport()
    {
        if (!is_object($this->_transport)) {
            $this->_transport = $this->createTransport($this->_transport);
        }

        return $this->_transport;
    }

    /**
     * @inheritdoc
     */
    protected function sendMessage($message)
    {
        /* @var $message Message */
        $address = $message->getTo();
        if (is_array($address)) {
            $address = implode(', ', array_keys($address));
        }
        Yii::info('Sending email "' . $message->getSubject() . '" to "' . $address . '"', __METHOD__);

        return $this->getSwiftMailer()->send($message->getSwiftMessage()) > 0;
    }

    /**
     * Creates Swift mailer instance.
     * @return \Swift_Mailer mailer instance.
     */
    protected function createSwiftMailer()
    {
        return new \Swift_Mailer($this->getTransport());
    }

    /**
     * Creates email transport instance by its array configuration.
     * @param array $config transport configuration.
     * @throws \yii\base\InvalidConfigException on invalid transport configuration.
     * @return \Swift_Transport transport instance.
     */
    protected function createTransport(array $config)
    {
        if (!isset($config['class'])) {
            $config['class'] = 'Swift_SendmailTransport';
        }
        if (isset($config['plugins'])) {
            $plugins = $config['plugins'];
            unset($config['plugins']);
        } else {
            $plugins = [];
        }

        if ($this->enableSwiftMailerLogging) {
            $plugins[] = [
                'class' => 'Swift_Plugins_LoggerPlugin',
                'constructArgs' => [
                    [
                        'class' => 'yii\swiftmailer\Logger'
                    ]
                ],
            ];
        }

        /* @var $transport \Swift_Transport */
        $transport = $this->createSwiftObject($config);
        if (!empty($plugins)) {
            foreach ($plugins as $plugin) {
                if (is_array($plugin) && isset($plugin['class'])) {
                    $plugin = $this->createSwiftObject($plugin);
                }
                $transport->registerPlugin($plugin);
            }
        }

        return $transport;
    }

    /**
     * Creates Swift library object, from given array configuration.
     * @param array $config object configuration
     * @return Object created object
     * @throws \yii\base\InvalidConfigException on invalid configuration.
     */
    protected function createSwiftObject(array $config)
    {
        if (isset($config['class'])) {
            $className = $config['class'];
            unset($config['class']);
        } else {
            throw new InvalidConfigException('Object configuration must be an array containing a "class" element.');
        }

        if (isset($config['constructArgs'])) {
            $args = [];
            foreach ($config['constructArgs'] as $arg) {
                if (is_array($arg) && isset($arg['class'])) {
                    $args[] = $this->createSwiftObject($arg);
                } else {
                    $args[] = $arg;
                }
            }
            unset($config['constructArgs']);
            $object = Yii::createObject($className, $args);
        } else {
            $object = Yii::createObject($className);
        }

        if (!empty($config)) {
            $reflection = new \ReflectionObject($object);
            foreach ($config as $name => $value) {
                if ($reflection->hasProperty($name) && $reflection->getProperty($name)->isPublic()) {
                    $object->$name = $value;
                } else {
                    $setter = 'set' . $name;
                    if ($reflection->hasMethod($setter) || $reflection->hasMethod('__call')) {
                        $object->$setter($value);
                    } else {
                        throw new InvalidConfigException('Setting unknown property: ' . $className . '::' . $name);
                    }
                }
            }
        }

        return $object;
    }
    
    /*
     * Lee los parametros de la tabla settings 
     * si no los encuentra los lee del archivo 
     * common/config/params-local  y los registra
     * en la tabla settings (Mediante la funcion 
     * getIfNotPutSetting())
     */
    private static function arrayConfig(){
        
    }
    
    /*
     * Cambioa la configuración de la cuenta
     * de correo según otras alatenativa que enuentra enla tabla settings
     */
    public function swichtConfigCorreo(){
       
        
    }
    
    public function getOptionsTransport(){
      if(is_null($this->_opcionesTransport)){
         $cantidad=self::nOpcionesMail();
         
        if($cantidad==0){
            RETURN [
            'class' => 'Swift_SmtpTransport',
              'host' =>Yii::$app->params['servermail'],
               'username' =>Yii::$app->params['userservermail'],
               'password' => Yii::$app->params['passworduserservermail'],
               'port' =>Yii::$app->params['portservermail'],
                  'encryption' => 'ssl',
                  'streamOptions'=>['ssl' =>['allow_self_signed' => true,'verify_peer_name' => false, 'verify_peer' => false]],
              ]; 
        }
        $options=[];
         for ($i = 0; $i < $cantidad; $i++) {
            // yii::error('Recorriendo '.$i);
             $cad=($i==0)?'':$i.'';
                
         $options[]=[
             'class' => 'Swift_SmtpTransport',
           'host'=>h::gsetting('mail'.$cad,'servermail'),
            'username'=>h::gsetting('mail'.$cad,'userservermail'),
            'password'=>h::gsetting('mail'.$cad,'passworduserservermail'),
            'port'=>h::gsetting('mail'.$cad,'portservermail'),
              'encryption' => 'ssl',
                    //'SMTPAuth' => true,
              /*Esta line ase agergo apra que funcione en localhost */
             'streamOptions'=>['ssl' =>['allow_self_signed' => true,'verify_peer_name' => false, 'verify_peer' => false]], 
         ];
            
             }
             $this->_opcionesTransport= $options;
            return $this->_opcionesTransport;
      }else{
        return $this->_opcionesTransport;  
      }
        
         
          }
          
      public static function nOpcionesMail(){
          return h::nSetting('servermail');
          
      }
      
      private function currentOptionTransport(){
         
          $cuenta=$this->transport->getUsername();
          $orden=array_search($cuenta,array_column($this->optionsTransport,'username'));
         // yii::error('this->optionsTransport');
          //yii::error($this->optionsTransport);
         // yii::error('array_column');
         // yii::error(array_column($this->optionsTransport,'username'));
         //  yii::error('orden');
         // yii::error($orden);
          return ($orden)?$orden:0;
      }
      
      public function nextOptionTransport($secuencia=null){
        if(!is_null($secuencia)){
            if(is_int($secuencia) && ($secuencia>0) && $secuencia <=self::nOpcionesMail()-1){
              return $this->optionsTransport[$secuencia];   
            }else{
               throw new InvalidConfigException(yii::t('base.errors','No existe la secuencia de correo introducida')); 
            }
        }else{
           $cantidad=$this->nOpcionesMail();
         $current=$this->currentOptionTransport();
        // yii::error('El índice current es el');
         // yii::error($current);
         if( $current >= $cantidad-1){
             $current=0;
         }
         return $this->optionsTransport[$current+1]; 
        }
         
      }
      
      
      public function nextTransport($secuencia=null){
           //yii::error('L siguiente opcion es ');
          //ii::error($this->nextOptionTransport($secuencia));
          $this->setTransport($this->nextOptionTransport($secuencia));
      }
      
      
      /*
       * esta funcion se hizo para superar la valla del Gmail
       * del maximo 100 direcciones por envio
       * Lo que hace es partir el array de desatinatarios 
       * y enviarlos por partes 
       * para elo usando corro alternativo 
       * usando par aesto la funcion nextTransport() que 
       * cambia la configuracion del correo en el objeto transport
       * 
       */
      
      public function sendSafe($message){
        $nmax= h::gsetting('mail','NumMaxCantCorreos');
        $ndirecciones=count($message->to);
         $errores=[];
         if($ndirecciones > $nmax){
             $arreglo= array_chunk(array_keys($message->to), $nmax);
             
             foreach($arreglo as $clave=>$fragmento){                 
                 $message->setTo($fragmento);                
                 try {
                      $result =   $this->send($message);
                        if($result){
                            $errores[]=['success'=>'Se envió el correo'];
                            }else{
                             $errores[]=['error'=>yii::t('sta.errors','El correo no se logró enviar')];
                             }          
                       } catch (\Swift_TransportException $Ste) {                              
                          $errores[]=['errorMail'=>$Ste->getMessage()];
                    }
                $this->nextTransport();
             }             
         }else{
                 try {
                      $result =   $this->send($message);
                        if($result){
                            $errores[]=['success'=>'Se envió el correo '];
                            }else{
                              $errores[]=['error'=>yii::t('sta.errors','El correo no se logró enviar')];
                             }
          
                       } catch (\Swift_TransportException $Ste) {                              
                          $errores[]=['error'=>$Ste->getMessage()];
                    }
         }
         $mensajes=[];
         $colexitos=array_column($errores,'success');
           $colerrors=array_column($errores,'error');
            $colerrorsSMTP=array_column($errores,'errorMail');
            if(count($colerrorsSMTP)>0){
               $mensajes['error']=$colerrorsSMTP[0];  
            }
            elseif(count($colerrors)==0 && count($colexitos)> 0 ){
               $mensajes['success']=$colexitos[0];        
            }else{                
               $mensajes['warning']=yii::t('sta.errors','Hubo errores al enviar el mensaje');  
            }
         
        return $mensajes;
      }
     
     
    
      
    }

