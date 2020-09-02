<?php
    use console\migrations\baseMigration;

class m200819_215806_alter_table_personas extends baseMigration
{
    const NAME_TABLE='{{%personas}}';
    
    public function safeUp()
    {
        $table=static::NAME_TABLE;
        if(!$this->existsColumn($table,'sexo'))
            $this->addColumn($table, 'sexo', $this->string(2)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'pais'))
            $this->addColumn($table, 'pais', $this->string(3)->append($this->collateColumn()));
        //if(!$this->existsColumn($table,'pasaporte'))
        //    $this->addColumn($table, 'pasaporte', $this->string(12)->append($this->collateColumn()));
        //if(!$this->existsColumn($table,'dni'))
        //    $this->addColumn($table, 'dni', $this->string(10)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'estcivil'))
            $this->addColumn($table, 'estcivil', $this->char(1)->append($this->collateColumn()));            
        if(!$this->existsColumn($table,'depnac'))
            $this->addColumn($table, 'depnac', $this->string(4)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'provnac'))
            $this->addColumn($table, 'provnac', $this->string(8)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'distnac'))
            $this->addColumn($table, 'distnac', $this->string(12)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'depdir'))
            $this->addColumn($table, 'depdir', $this->string(4)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'provdir'))
            $this->addColumn($table, 'provdir', $this->string(8)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'distdir'))
            $this->addColumn($table, 'distdir', $this->string(12)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'alergias'))
            $this->addColumn($table, 'alergias', $this->string(100)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'gruposangu'))
            $this->addColumn($table, 'gruposangu', $this->string(10)->append($this->collateColumn()));
        if(!$this->existsColumn($table,'usoregulmedic'))
            $this->addColumn($table, 'usoregulmedic', $this->string(30)->append($this->collateColumn()));
    }
    
    public function safeDown()
    {
        $table=static::NAME_TABLE; 
        if($this->existsColumn($table,'sexo'))
            $this->dropColumn($table, 'sexo');
        if($this->existsColumn($table,'pais'))
            $this->dropColumn($table, 'pais');
        //if($this->existsColumn($table,'pasaporte'))
        //    $this->dropColumn($table, 'pasaporte');
        //if($this->existsColumn($table,'dni'))
        //    $this->dropColumn($table, 'dni');
        if($this->existsColumn($table,'estcivil'))
            $this->dropColumn($table, 'estcivil');            
        if($this->existsColumn($table,'depnac'))
            $this->dropColumn($table, 'depnac');
        if($this->existsColumn($table,'provnac'))
            $this->dropColumn($table, 'provnac');
        if($this->existsColumn($table,'distnac'))
            $this->dropColumn($table, 'distnac');           
        if($this->existsColumn($table,'depdir'))
            $this->dropColumn($table, 'depdir');
        if($this->existsColumn($table,'provdir'))
            $this->dropColumn($table, 'provdir');
        if($this->existsColumn($table,'distdir'))
            $this->dropColumn($table, 'distdir');
        if($this->existsColumn($table,'alergias'))
            $this->dropColumn($table, 'alergias');
        if($this->existsColumn($table,'gruposangu'))
            $this->dropColumn($table, 'gruposangu');
        if($this->existsColumn($table,'usoregulmedic'))
            $this->dropColumn($table, 'usoregulmedic');
    }

}
