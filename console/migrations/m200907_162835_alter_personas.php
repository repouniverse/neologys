<?php

use console\migrations\baseMigration;

/**
 * Class m200907_162835_alter_personas
 */
class m200907_162835_alter_personas extends baseMigration
{
    const NAME_TABLE='{{%personas}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table=static::NAME_TABLE;
        if(!$this->existsColumn($table,'lugarnacimiento'))
            $this->addColumn($table, 'lugarnacimiento', $this->string(100)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'telpaisorigen'))
            $this->addColumn($table, 'telpaisorigen', $this->string(50)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'codcontpaisorigen'))
            $this->addColumn($table, 'codcontpaisorigen', $this->string(8)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'parentcontpaisorigen'))
            $this->addColumn($table, 'parentcontpaisorigen', $this->string(3)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'polizaseguroint'))
            $this->addColumn($table, 'polizaseguroint', $this->string(50)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'telefasistencia'))
            $this->addColumn($table, 'telefasistencia', $this->string(50)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'paisresidencia'))
            $this->addColumn($table, 'paisresidencia', $this->string(3)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'lugarresidencia'))
            $this->addColumn($table, 'lugarresidencia', $this->string(100)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'codcontpaisresid'))
            $this->addColumn($table, 'codcontpaisresid', $this->string(8)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'parentcontpaisresid'))
            $this->addColumn($table, 'parentcontpaisresid', $this->string(3)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'tipogrado'))
            $this->addColumn($table, 'tipogrado', $this->string(3)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'idiomanativo'))
            $this->addColumn($table, 'idiomanativo', $this->string(3)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'codresponsable'))
            $this->addColumn($table, 'codresponsable', $this->string(8)->append($this->collateColumn()));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $table=static::NAME_TABLE;
        if($this->existsColumn($table,'lugarnacimiento'))
            $this->dropColumn($table, 'lugarnacimiento');
        if($this->existsColumn($table,'telpaisorigen'))
            $this->dropColumn($table, 'telpaisorigen');
        if($this->existsColumn($table,'codcontpaisorigen'))
            $this->dropColumn($table, 'codcontpaisorigen');
        if($this->existsColumn($table,'parentcontpaisorigen'))
            $this->dropColumn($table, 'parentcontpaisorigen');
        if($this->existsColumn($table,'polizaseguroint'))
            $this->dropColumn($table, 'polizaseguroint');
        if($this->existsColumn($table,'telefasistencia'))
            $this->dropColumn($table, 'telefasistencia');
        if($this->existsColumn($table,'paisresidencia'))
            $this->dropColumn($table, 'paisresidencia');
        if($this->existsColumn($table,'lugarresidencia'))
            $this->dropColumn($table, 'lugarresidencia');
        if($this->existsColumn($table,'codcontpaisresid'))
            $this->dropColumn($table, 'codcontpaisresid');
        if($this->existsColumn($table,'parentcontpaisresid'))
            $this->dropColumn($table, 'parentcontpaisresid');
        if($this->existsColumn($table,'tipogrado'))
            $this->dropColumn($table, 'tipogrado');
        if($this->existsColumn($table,'idiomanativo'))
            $this->dropColumn($table, 'idiomanativo');
        if($this->existsColumn($table,'codresponsable'))
            $this->dropColumn($table, 'codresponsable');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200907_162835_alter_personas cannot be reverted.\n";

        return false;
    }
    */
}
