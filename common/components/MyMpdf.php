<?php
namespace common\components;
use yii;
class MyMpdf extends \Mpdf\Mpdf{
    
    //'default_font' => 'frutiger'
    public function __construct(array $config = []){
        
            $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
            $fontDirs = $defaultConfig['fontDir'];
            $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
            $fontData = $defaultFontConfig['fontdata'];
            //var_dump($fontDirs );die();
        $config=[
            'fontDir' => array_merge($fontDirs, [
                 Yii::getAlias('@fonts')
                                                ]),
                            'fontdata' => $fontData + [
                                'cour' => [
                                'R' => 'cour.ttf',
                                'I' => 'CourierITALIC.ttf',
                                        ]
                                                    ],
                    ];
        parent::__construct($config = []);
    }
    
    
    

    
}

