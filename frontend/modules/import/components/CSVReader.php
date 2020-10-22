<?php

/**
 * Extendemos esta clase como un Helper para leer archivos CSV
 */
namespace frontend\modules\import\components;
USE ruskid\csvimporter\CSVReader AS MyReader;
use yii;
use yii\base\Exception;
use common\helpers\h;

/**
 * CSV Reader
 * @author Julian Ramírez  
 */
class CSVReader  extends MyReader{

    /**
     * @var string the path of the uploaded CSV file on the server.
     */
    public $filename;

    /**
     * FGETCSV() options: length, delimiter, enclosure, escape.
     * @var array 
     */
    public $fgetcsvOptions = ['length' => 0, 
        'delimiter' => ',',
        'enclosure' => '"', 
        'escape' => "\\"];

    /**
     * Start insert from line number. Set 1 if CSV file has header.
     * @var integer
     */
    //public $startFromLine = 1;

    /**
     * @throws Exception
     */
 
    public function __construct() {
        $arguments = func_get_args();
       
        if (!empty($arguments)) {
            foreach ($arguments[0] as $key => $property) {
                if (property_exists($this, $key)) {
                    $this->{$key} = $property;
                }
            }
        }

        if ($this->filename === null) {
            throw new Exception(__CLASS__ . ' filename is required.');
        }
    }
    

    /**
     * Will read CSV file into array
     * @throws Exception
     * @return $array csv filtered data 
     */
    public function readFile() {
       // yii::error('veriicando archivo csv',__METHOD__);
        $this->verifiyFile();
       //yii::error('Ya Verifico.. ',__METHOD__);

        $lines = []; //Clear and set rows
        $contador=1;
        if (($fp = fopen($this->filename, 'r')) !== FALSE) {
            while (($line =$this->ReadLineCsv($fp) ) !== FALSE) {
                
                // yii::error('Esta es la  linea del archivo csv '.$contador,__METHOD__);
                //yii::error($line,__METHOD__);
                array_push($lines, $line);
                $contador++;
            }
        }
        //Remove unused lines from all lines
        for ($i = 0; $i < $this->startFromLine-1; $i++) {
            unset($lines[$i]);
        }
        return $lines;
    }
    
    
   public function getFirstRow(){
       $this->verifiyFile();
       //$inicial=$this->startFromLine;        
      // $linea=null;
       $contador=1;
       if (($fp = fopen($this->filename, 'r')) !== FALSE) {  
                  // yii::error('incinaod bucle');             
            while (($line =$this->ReadLineCsv($fp) ) !== FALSE) {  
                //yii::error($line);  
                 yii::error('esta es contador -> '.$contador/*,__METHOD__*/);  
                 //yii::error('esta es la start -> '.$this->startFromLine,__METHOD__);  
                  if($contador==$this->startFromLine){
                     // yii::error('coincidio');
                    break;  
                  }
                  $contador++;
                }
        }
         //yii::error('esto retorna');  
   //yii::error('Esta es el primer registroa verificar',__METHOD__);
  // yii::error($line,__METHOD__);        
      return $line;       
   } 
   
   private function verifiyFile(){
       if (!file_exists($this->filename)) {
            throw new Exception(__CLASS__ . ' couldn\'t find the CSV file.');
        }
   }
     
   private function ReadLineCsv($fp){
        //Prepare fgetcsv parameters
        $length = isset($this->fgetcsvOptions['length']) ? $this->fgetcsvOptions['length'] : 0;
        $delimiter = isset($this->fgetcsvOptions['delimiter']) ? $this->fgetcsvOptions['delimiter'] : ',';
        $enclosure = isset($this->fgetcsvOptions['enclosure']) ? $this->fgetcsvOptions['enclosure'] : '"';
        $escape = isset($this->fgetcsvOptions['escape']) ? $this->fgetcsvOptions['escape'] : "\\";
        return fgetcsv($fp, $length, $delimiter, $enclosure, $escape);
   }
   /*
    * Devuelve el numero de lineas para 
    * importar del archivo csv 
    */
  public function numberLinesToImport(){      
       $contador=1;
        if (($fp = fopen($this->filename, 'r')) !== FALSE) {
            while (($this->ReadLineCsv($fp) ) !== FALSE) {
                $contador++;
            }
        }
      return $contador;
  } 
}
