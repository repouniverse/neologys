<?php
namespace common\interfaces;
interface PersonInterface {
  public function name(); 
  /* Si
   * asc: true Rregresa el nombre-apellidos; false : regresa  apellidos nombre
   */
    public function fullName($asc=TRUE,$ucase=true);
    public function lastName();
    public function age();
    public function docsIdentity();  
    public function address();
    public function fenac();
    public function IsBirthDay();
    
    
}