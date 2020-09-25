<?php
namespace frontend\modules\report;
//use kartik\mpdf\Pdf;
use yii;
use common\helpers\h;
/**
 * report module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\report\controllers';
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        // custom initialization code goes here
        static::putSettingsModule();
    }
     private static function putSettingsModule(){
        h::getIfNotPutSetting('report','sizePage',5, \yii2mod\settings\models\enumerables\SettingType::STRING_TYPE);
       //  h::getIfNotPutSetting('sigi','urlimagesalu','http:://www.orce.uni.edu.pe/alumnos/', SettingType::STRING_TYPE);
        // h::getIfNotPutSetting('sigi','prefiximagesalu','0060', SettingType::STRING_TYPE);
          return true;
    }
   
    
    public static function  getPdf(){
               $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
            $fontDirs = $defaultConfig['fontDir'];
            $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
            $fontData = $defaultFontConfig['fontdata'];
//$mpdf = new \common\components\MyMpdf([/*
$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs,[
       Yii::getAlias('@fonts')
    ]),
    'fontdata' => $fontData + [
        'cour' => [
            'R' => 'Courier.ttf',
            
        ],
        'helvetica' => [
            'R' => 'Helvetica.ttf',
            'I' => 'VerdanaBOLD.ttf',
        ],
        'verdana' => [
            'R' => 'Verdana.ttf',
            'B' => 'VerdanaBOLD.ttf',
        ],
        
    ],
    //'default_font' => 'cour'
]);
//print_r($mpdf->fontdata);die();
          
          //$mpdf=new \Mpdf\Mpdf();
          //echo get_class($mpdf);die();
          /* $pdf->methods=[ 
           'SetHeader'=>[($model->tienecabecera)?$header:''], 
            'SetFooter'=>[($model->tienepie)?'{PAGENO}':''],
        ];*/
           
                  
           $mpdf->simpleTables = false;
                $mpdf->packTableData = true;
           //$mpdf->showImageErrors = true;
           $mpdf->curlAllowUnsafeSslRequests = true; //Permite imagenes de url externas
         return $mpdf;
    }
    
    public static function urlReport($idReporte,$idFiltro,$campoFiltro=null){
        return \yii\helpers\Url::to(['/report/make/creareporte','id'=>$idReporte,'idfiltro'=>$idFiltro]);
    }
}