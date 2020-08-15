<?php
namespace common\interfaces;
interface postulantesInterface {    
    public function pushAttributeInterModo($attributesModo);
    public function esConvocable();
    /*Esdta funcion  dee dar la lista de registros*/
    public function providerPersonsToConvocar();
    
    /*Contienen las preguntaspara autenticar*/
    public function questionsForAutenticate();
    public function modelByCode($code);
}
