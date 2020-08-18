<?php
namespace frontend\modules\inter\database\migrations;
use console\migrations\baseMigration;

/**
 * Class m200814_210242_add_column_inter_modos
 */
class m200814_210242_add_column_inter_modos extends baseMigration
{
    const NAME_TABLE='{{%inter_modos}}';
   
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'modelofuente'))
     $this->addColumn($table, 'modelofuente', $this->string(120));  
   $this->fillData();
    
    }
	

    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'modelofuente'))
           $this->dropColumn($table,'modelofuente');
      
    }

    public function fillData(){
       \Yii::$app->db->createCommand()->
             batchInsert(static::NAME_TABLE,
             ['universidad_id','facultad_id',
                 'depa_id','programa_id','descripcion','modelofuente'
                 ], $this->getData())->execute();
   
 }  
    
    
  
 
 
 private function getData(){
       $comando=\Yii::$app->db->createCommand();
     //$universidad= $comando->setSql("select id from {{%universidades}} where nombre like '%PORR%'")->queryOne();
     $programa=$comando->setSql("select *from {{%inter_programa}}")->queryOne();
     return [
            [$programa['universidad_id'],$programa['facultad_id'],$programa['depa_id'],$programa['id'],'OUTOGOING ALUMNOS','\common\models\masters\Alumnos'],
         [$programa['universidad_id'],$programa['facultad_id'],$programa['depa_id'],$programa['id'],'INCOMING ALUMNOS',''],
         [$programa['universidad_id'],$programa['facultad_id'],$programa['depa_id'],$programa['id'],'OUTOGOING DOCENTES','\common\models\masters\Docentes'],
         [$programa['universidad_id'],$programa['facultad_id'],$programa['depa_id'],$programa['id'],'INCOMING DOCENTES',''],
  ];
 }  
}
