<?php


use console\migrations\baseMigration;

/**
 * Class m200807_170611_create_fill_table_universidades
 */
class m200727_180851_create_fill_table_universidades extends baseMigration
{
    const NAME_TABLE='{{%universidades}}';
 //const NAME_TABLE_CENTROS='{{%centros}}';
    public function safeUp()
    {
            \Yii::$app->db->createCommand()->
             batchInsert(static::NAME_TABLE,
             ['codpais','nombre','acronimo','estado'], $this->getData())->execute();
    }

    public function safeDown()
    { 
        //static::deleteData();
    }

    
    
    
    private static function  fields(){
    return  ['codbanco','nombre'];
    }
    
    private static function  deleteData(){        
        
          (new \yii\db\Query)
    ->createCommand()
    ->delete(self::NAME_TABLE)
    ->execute();       
    }
    
     private static function  getData(){             
              return [
 ['PE','UNIVERISDAD SAN MARTIN DE PORRAS','PE-LIM','PE-USMP'],   
['ES','ESCUELA SUPERIOR DE RELACIONES PÚBLICAS','ES-ESRP','ES-B'],
['ES','UNIVERSIDAD DE MÁLAGA','ES-UMA','ES-B'],
['CO','UNIVERSIDAD DE MEDELLÍN','CO-UMED','CO-ANT'],
['CO','UNIVERSIDAD AUTÓNOMA DE BUCARAMANGA','CO-UAB','CO-SAN'],
['CO','UNIVERSIDAD DEL EXTERNADO','CO-UEX','CO-SAN'],
['CO','UNIVERSIDAD DE SAN BUENAVENTURA','CO-USBB','CO-ANT'], 
['AR','UNIVERSIDAD DE CIENCIAS EMPRESARIALES Y SOCIALES','AR-UCES','AR-B'],
['AR','UNIVERSIDAD ARGENTINA DE LA EMPRESA','AR-UADE','AR-B'],
['MX','UNIVERSIDAD ANÁHUAC','MX-UANH','MX-MEX'],
['MX','UNIVERSIDAD AUTÓNOMA DEL ESTADO DE MÉXICO','MX-UAEM','MX-MEX'],
['UY','UNIVERSIDAD CATÓLICA DEL URUGUAY','UY-UCUDAL','UY-MO'],
['FR','YSCHOOL','FR-YSCHOOL','FR-75'],
['DE','UNIVERSIDAD DE LEUPHANA','DE-ULE','DE-HH'],
           ];      
    }
}