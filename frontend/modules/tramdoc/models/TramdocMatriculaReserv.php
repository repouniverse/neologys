<?php

namespace frontend\modules\tramdoc\models;
use \common\models\base\modelBase;
use common\models\User;
use common\helpers\h;
use Yii;

/**
 * This is the model class for table "{{%tramdoc_matricula_reserv}}".
 *
 * @property int $id
 * @property string|null $nro_matr Nro de matrícula SAP
 * @property string|null $codigo Código a nivel de facultad
 * @property int $carrera_id
 * @property string|null $dni
 * @property string $apellido_paterno
 * @property string|null $apellido_materno
 * @property string $nombres
 * @property string|null $email_usmp
 * @property string|null $email_personal
 * @property string|null $celular
 * @property string|null $telefono
 * @property string|null $mensaje
 * @property string|null $obs_alumno
 * @property string|null $fecha_solicitud
 * @property string|null $fecha_registro
 * @property string|null $cta_sin_deuda_pendiente_check SI->El alumno NO tiene deuda pendiente
 * @property string|null $cta_sin_deuda_pendiente_obs Observaciones de deuda pendiente llenado por Cuentas Corrientes
 * @property string|null $cta_pago_tramite_check SI->se confirma el pago de derecho de trámite
 * @property string|null $cta_pago_tramite_adjunto
 * @property string|null $cta_pago_tramite_obs Observaciones de pago de derecho de trámite llenado por Cuentas Corrientes
 * @property string|null $ora_soli_reg_check SI->ORA presenta y adjunta record de notas
 * @property string|null $ora_soli_reg_adjunto
 * @property string|null $ora_soli_reg_obs Observaciones sobre el Record de Notas llenado por ORA->Oficina de Registros Académicos
 * @property string|null $estado Estado del tramite->Oficina de Registros Académicos 
 * @property string|null $estado_obs Observaciones del estado del tramite->Oficina de Registros Académicos 
 */
class TramdocMatriculaReserv extends \yii\db\ActiveRecord
{
    const DOCU_COMPROBANTE_PAGO_ADJUNTO='211';
    const DOCU_SOLICITUD_REGISTRADA_ADJUNTO='235';


    private $_array_docs=[
        self::DOCU_COMPROBANTE_PAGO_ADJUNTO=>'1',
        self::DOCU_SOLICITUD_REGISTRADA_ADJUNTO=>'1',//acticvar luego
            ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tramdoc_matricula_reserv}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['carrera_id', 'apellido_paterno', 'nombres'], 'required'],
            [['carrera_id'], 'integer'],
            [['mensaje', 'obs_alumno', 'cta_sin_deuda_pendiente_obs', 'cta_pago_tramite_obs', 'ora_soli_reg_obs', 'estado_obs'], 'string'],
            [['fecha_solicitud', 'fecha_registro'], 'safe'],
            [['nro_matr', 'codigo', 'apellido_paterno', 'apellido_materno', 'nombres'], 'string', 'max' => 40],
            [['dni'], 'string', 'max' => 20],
            [['email_usmp', 'email_personal', 'celular', 'telefono'], 'string', 'max' => 60],
            [['cta_sin_deuda_pendiente_check', 'cta_pago_tramite_check', 'ora_soli_reg_check'], 'string', 'max' => 2],
            [['cta_pago_tramite_adjunto', 'ora_soli_reg_adjunto'], 'string', 'max' => 160],
            [['estado'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'nro_matr' => Yii::t('base_labels', 'Nro Matr'),
            'codigo' => Yii::t('base_labels', 'Codigo'),
            'carrera_id' => Yii::t('base_labels', 'Carrera ID'),
            'dni' => Yii::t('base_labels', 'Dni'),
            'apellido_paterno' => Yii::t('base_labels', 'Apellido Paterno'),
            'apellido_materno' => Yii::t('base_labels', 'Apellido Materno'),
            'nombres' => Yii::t('base_labels', 'Nombres'),
            'email_usmp' => Yii::t('base_labels', 'Email Usmp'),
            'email_personal' => Yii::t('base_labels', 'Email Personal'),
            'celular' => Yii::t('base_labels', 'Celular'),
            'telefono' => Yii::t('base_labels', 'Telefono'),
            'mensaje' => Yii::t('base_labels', 'Mensaje'),
            'obs_alumno' => Yii::t('base_labels', 'Obs Alumno'),
            'fecha_solicitud' => Yii::t('base_labels', 'Fecha Solicitud'),
            'fecha_registro' => Yii::t('base_labels', 'Fecha Registro'),
            //CTA
            'cta_sin_deuda_pendiente_check' => Yii::t('base_labels', 'Cta Sin Deuda Pendiente Check'),
            'cta_sin_deuda_pendiente_obs' => Yii::t('base_labels', 'Cta Sin Deuda Pendiente Obs'),
            'cta_pago_tramite_check' => Yii::t('base_labels', 'Pago de Trámite Realizado'),
            'cta_pago_tramite_adjunto' => Yii::t('base_labels', 'Cta Pago Tramite Adjunto'),
            'cta_pago_tramite_obs' => Yii::t('base_labels', 'Cta Pago Tramite Obs'),
            //REG ACA
            'ora_soli_reg_check' => Yii::t('base_labels', 'Solicitud registrada'),
            'ora_soli_reg_adjunto' => Yii::t('base_labels', 'Ora Soli Reg Adjunto'),
            'ora_soli_reg_obs' => Yii::t('base_labels', 'Ora Soli Reg Obs'),
            'estado' => Yii::t('base_labels', 'Estado'),
            'estado_obs' => Yii::t('base_labels', 'Estado Obs'),
        ];
    }
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            yii::error("ATRIBUTOS CAMBIADOS o actualizasdos");
            $this->crearDocsReactMat();
        } else if ($changedAttributes) {
            yii::error("ATRIBUTOS CAMBIADOS");
            yii::error($changedAttributes);
            $this->crearAuditoria($changedAttributes);
        }
        return parent::afterSave($insert, $changedAttributes);
    }

    private function crearAuditoria($atributos)
    {

        foreach ($this as $key => $val) {

            foreach ($atributos as $key2 => $val2) {

                if ($key == $key2) {
                    if ($val != $val2) {
                        yii::error("EL VALOR CAMBIADO SERÁ");
                        yii::error($val);
                        if ($key != 'fecha_registro') {

                            yii::error("EL DATO A CAMBIAR");
                            yii::error($key);
                            $userActual = User::findOne(h::userId());
                            $var = new TramdocAuditoriaReserv([
                                'matr_reserv_id' => $this->id,
                                'persona_id' => $userActual->profile->persona->id,
                                'campo_modificado' => $key2,
                                'valor_modificado' => $val,
                                'fecha_modif' => modelBase::CarbonNow()->format(\common\helpers\timeHelper::formatMysqlDateTime()),
                            ]);
                            $var->save();
                        }
                    }
                }
            }
        }
    }

    public function crearDocsReactMat()
    {
        foreach($this->_array_docs as $codocu=>$activo){
            yii::error($codocu);
            yii::error($activo);
            TramdocFilesReserv::firstOrCreateStatic(
                [
                    'matr_reserv_id' => $this->id,
                    'docu_id' => $codocu.'',
                ]
            );
        }
    }

    /**
     * {@inheritdoc}
     * @return TramdocMatriculaReservQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TramdocMatriculaReservQuery(get_called_class());
    }
}
