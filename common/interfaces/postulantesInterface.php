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
    public function createUser();
    public function isExternal();
}
