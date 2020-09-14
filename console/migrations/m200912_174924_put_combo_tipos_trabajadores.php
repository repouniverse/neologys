<?php
  use console\migrations\baseMigration;
class m200912_174924_put_combo_tipos_trabajadores extends baseMigration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        
        $table='{{%trabajadores}}';
         if($this->existsColumn($table,'codcargo')){
           $this->dropColumn($table, 'codcargo');
           $this->addColumn($table, 'codcargo', $this->string(3)->append($this->collateColumn()));
        
         }
          
         $this->putCombo
                   (
                        $table, 'codcargo',
                        [
                            'DIRECTOR DE ESCUELA',
                            'DECANO',
                            'PSICOLOGO TH',
                            'JEFE DE SOPORTE',
                            'JEFE DE REGISTROS ACADEMICOS',
                            'DECANO',
                            'PSICOLOGO',
                            'JEFE DE SOPORTE',
                        ]
                   ); 

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200912_174924_put_combo_tipos_trabajadores cannot be reverted.\n";

        return false;
    }
    */
}
