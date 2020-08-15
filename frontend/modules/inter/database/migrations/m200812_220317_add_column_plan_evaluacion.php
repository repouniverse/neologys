<?php
namespace frontend\modules\inter\database\migrations;
use yii\db\Migration;
use backend\components\Installer;
use console\migrations\baseMigration;
/**
 * Class m200812_220317_add_column_plan_evaluacion
 */
class m200812_220317_add_column_plan_evaluacion extends baseMigration
{
    const NAME_TABLE='{{%inter_plan}}';
    const RUTA=[
        'Import'=>['/import/importacion'=>'Importaciones']
    ];
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$table=static::NAME_TABLE;
if(!$this->existsColumn($table,'orden'))
     $this->addColumn($table, 'orden', $this->integer(2));
if(!$this->existsColumn($table,'requisito_id'))
     $this->addColumn($table, 'requisito_id', $this->integer(11));
     
  
  
  //Installer::addMenu(self::RUTA); 
    
    
    }
	

    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $table=static::NAME_TABLE; 
      if($this->existsColumn($table,'orden'))
           $this->dropColumn($table,'orden');
      if($this->existsColumn($table,'requisito_id'))
            $this->dropColumn($table,'requisito_id');
        
        Installer::deleteMenu(static::RUTA);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190106_063220_create_table_centros cannot be reverted.\n";

        return false;
    }
    */
}
