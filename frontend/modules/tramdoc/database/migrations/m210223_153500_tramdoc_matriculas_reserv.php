    <?php
    namespace frontend\modules\tramdoc\database\migrations;
    use console\migrations\baseMigration;
    /**
     * Class m210223_153500_tramdoc_matriculas_reserv
     */
    class m210223_153500_tramdoc_matriculas_reserv extends baseMigration
    {
        const NAME_TABLE='{{%tramdoc_matricula_reserv}}';

        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
            $table = static::NAME_TABLE;
            if (!$this->existsTable($table)) {
                $this->createTable($table, [
                    'id' => $this->primaryKey(),
                    'nro_matr'=>$this->string(40)->comment('Nro de matrícula SAP'),
                    'codigo'=>$this->string(40)->comment('Código a nivel de facultad'),
                    'carrera_id' => $this->integer(11)->notNull(),
                    'dni'=>$this->string(20),
                    'apellido_paterno'=>$this->string(40)->append($this->collateColumn())->notNull(),
                    'apellido_materno'=>$this->string(40)->append($this->collateColumn()),
                    'nombres'=>$this->string(40)->append($this->collateColumn())->notNull(),
                    'email_usmp'=>$this->string(60),
                    'email_personal'=>$this->string(60),
                    'celular'=>$this->string(60),
                    'telefono'=>$this->string(60),
                    'mensaje' => $this->text()->append($this->collateColumn()),
                    'obs_alumno' => $this->text()->append($this->collateColumn()),
                    'fecha_solicitud'=>$this->dateTime(),
                    'fecha_registro'=>$this->dateTime(),
                    //CUENTAS CORRIENTES
                    'cta_sin_deuda_pendiente_check'=>$this->char(2)->defaultValue(null)->comment('SI->El alumno NO tiene deuda pendiente'),
                    'cta_sin_deuda_pendiente_obs' => $this->text()->append($this->collateColumn())->comment('Observaciones de deuda pendiente llenado por Cuentas Corrientes')->defaultValue(null),
                    'cta_pago_tramite_check'=>$this->char(2)->defaultValue(null)->comment('SI->se confirma el pago de derecho de trámite'),
                    'cta_pago_tramite_adjunto'=>$this->string(160),
                    'cta_pago_tramite_obs' => $this->text()->append($this->collateColumn())->comment('Observaciones de pago de derecho de trámite llenado por Cuentas Corrientes')->defaultValue(null),
                    //REGISTROS ACADEMICOS  
                    'ora_soli_reg_check'=>$this->char(2)->defaultValue(null)->comment('SI->ORA presenta y adjunta record de notas'),
                    'ora_soli_reg_adjunto'=>$this->string(160),
                    'ora_soli_reg_obs' => $this->text()->append($this->collateColumn())->comment('Observaciones sobre el Record de Notas llenado por ORA->Oficina de Registros Académicos')->defaultValue(null),
                    'estado' => $this->char(3)->append($this->collateColumn())->comment('Estado del tramite->Oficina de Registros Académicos ')->defaultValue('1'),
                    'estado_obs' => $this->text()->append($this->collateColumn())->comment('Observaciones del estado del tramite->Oficina de Registros Académicos ')->defaultValue(null),

                ], $this->collateTable());
            }
        }

        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            if ($this->existsTable(static::NAME_TABLE)) {
                $this->dropTable(static::NAME_TABLE);
            }
        }

        /*
        // Use up()/down() to run migration code without a transaction.
        public function up()
        {

        }

        public function down()
        {
            echo "m210204_103110_create_table_matriculas_react cannot be reverted.\n";

            return false;
        }
        */
    }
