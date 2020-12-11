<?php

namespace frontend\modules\acad;
use common\helpers\h;
use yii;
USE yii2mod\settings\models\enumerables\SettingType;
/**
 * acad module definition class
 */
class Module extends \yii\base\Module
{
   
   private static $cicles=[
       1=>'PRIMERO',
       2=>'SEGUNDO',
        3=>'TERCERO',
       4=>'CUARTO',
        5=>'QUINTO',
       6=>'SEXTO',
        7=>'SÉPTIMO',
       8=>'OCTAVO',
       9=>'NOVENO',
        10=>'DÉCIMO',
       ];
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\acad\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        
       h::getIfNotPutSetting('general','MainUniversity',1, SettingType::INTEGER_TYPE);
       h::getIfNotPutSetting('general','MainFaculty',1, SettingType::INTEGER_TYPE);
         

        // custom initialization code goes here
    }
    
    
    public static function cicleInLetters($number){
        if(in_array($number, array_keys(static::$cicles)))
        return ucfirst(mb_strtolower(static::$cicles[$number],'UTF-8'));
        return '';
    }
    
    
}
