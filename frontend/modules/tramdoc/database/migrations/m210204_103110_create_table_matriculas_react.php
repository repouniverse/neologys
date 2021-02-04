<?php
namespace frontend\modules\tramdoc\database\migrations;
use console\migrations\baseMigration;


/**
 * Class m210204_103110_create_table_matriculas_react
 */
class m210204_103110_create_table_matriculas_react extends baseMigration
{
    const NAME_TABLE='{{%tramdoc_matricula_reacts}}';

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
                'dni'=>$this->string(20)->notNull(),
                'apellido_paterno'=>$this->string(40)->append($this->collateColumn())->notNull(),
                'apellido_materno'=>$this->string(40)->append($this->collateColumn()),
                'nombres'=>$this->string(40)->append($this->collateColumn())->notNull(),
                'email_usmp'=>$this->string(60),
                'email_personal'=>$this->string(60)->notNull(),
                'celular'=>$this->string(60),
                'telefono'=>$this->string(60),
                'mensaje' => $this->text()->append($this->collateColumn()),
                'fecha_solicitud'=>$this->dateTime()->notNull(),
                'fecha_registro'=>$this->dateTime(),
                //
                'cta_sin_deuda_pendiente_check'=>$this->char(2)->defaultValue('NO')->comment('SI->El alumno NO tiene deuda pendiente'),
                'cta_sin_deuda_pendiente_obs' => $this->text()->append($this->collateColumn())->comment('Observaciones de deuda pendiente llenado por Cuentas Corrientes'),
                'cta_pago_tramite_check'=>$this->char(2)->defaultValue('NO')->comment('SI->se confirma el pago de derecho de trámite'),
                'cta_pago_tramite_adjunto'=>$this->string(160),
                'cta_pago_tramite_obs' => $this->text()->append($this->collateColumn())->comment('Observaciones de pago de derecho de trámite llenado por Cuentas Corrientes'),
                //
                'ora_record_notas_check'=>$this->char(2)->defaultValue('NO')->comment('SI->ORA presenta y adjunta record de notas'),
                'ora_record_notas_adjunto'=>$this->string(160),
                'ora_record_notas_obs' => $this->text()->append($this->collateColumn())->comment('Observaciones sobre el Record de Notas llenado por ORA->Oficina de Registros Académicos'),
                //
                'aca_cursos_aptos_check'=>$this->char(2)->defaultValue('NO')->comment('SI->ACA presenta y adjunta DOC DE CURSOS APTOS'),
                'aca_cursos_aptos_adjunto'=>$this->string(160),
                'aca_cursos_aptos_observaciones' => $this->text()->append($this->collateColumn())->comment('Observaciones sobre los Cursos Aptos que el alumno puede llevar llenado por ACA->Coordinación Académica'),
                //
                'ora_cursos_aptos_check'=>$this->char(2)->defaultValue('NO')->comment('SI->Ingresó información correctamente a los sistemas de SICAT/SAP'),
                'ora_cursos_aptos_obs' => $this->text()->append($this->collateColumn())->comment('Observaciones de ingreso de información a los sistemas de SICAT/SAP'),
                //
                'oti_cursos_aptos_check'=>$this->char(2)->defaultValue('NO')->comment('SI->Ingresó información de consolidado correctamente a SAP'),
                'oti_cursos_aptos_obs' => $this->text()->append($this->collateColumn())->comment('Observaciones de ingreso de información a SAP'),
                //
                'oti_notifica_email_check'=>$this->char(2)->defaultValue('NO')->comment('SI->Envía correctamente email al alumno y a ACA:departamento académico'),
                'oti_notifica_email_obs' => $this->text()->append($this->collateColumn())->comment('Observaciones de envío de emails'),

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
