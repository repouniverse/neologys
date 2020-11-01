<?php
namespace common\interfaces;
use frontend\modules\inter\models\InterModos;
interface postulantesInterface {    
    public function pushAttributeInterModo($attributesModo);
    public function esConvocable();
    /*Esdta funcion  dee dar la lista de registros*/
    public function providerPersonsToConvocar(InterModos $modo);
    
    /*Contienen las preguntaspara autenticar*/
    public function questionsForAutenticate();
    public function modelByCode($code);
    public function code();
    public function nameFieldCode();
    public function createUser();
    public function isExternal();
     public function registerConvocado($idModo);
    public function resolveModo();
     public function isConvocado();
      public function mailAddress();
     public function campoCarrera();
      public function campoLink();
    public function canCreateOrEdit();//Verifica los privilegios de casa usuarios 
}
