<?php
namespace common\widgets\spinnerWidget;

use yii;
use yii\web\View;

class spinnerWidget extends yii\base\Widget
{
    
   public $id;
   public $idDiv ;
    
   public function run()
    {
       
       $this->makeJs(); 
            return $this->render('controls',['nombreDiv'=>$this->idDiv]);
        }


 private function makeJs(){
     $unico= uniqid();$this->idDiv=$unico;
            $this->getView()->registerJs("$(document).ready(
                 function(){
            $(document).ajaxStart(function(){
                                        $('#". $unico."').css('display','contents');                                        
                                            }
                                  );
            $(document).ajaxComplete(function(){
                                        $('#".$unico."').css('display', 'none'); 
                                                }
                                 );

                });", \yii\web\View::POS_READY);
        }

 
}

?>
