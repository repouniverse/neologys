<?php

namespace frontend\modules\tramdoc\models;

use common\models\masters\Documentos;
use common\behaviors\FileBehavior;
use common\helpers\timeHelper;
use common\helpers\h;
use \common\models\base\modelBase;
use common\models\User;
use Yii;

/**
 * This is the model class for table "{{%tramdoc_matricula_reacts}}".
 *
 * @property int $id
 * @property string|null $nro_matr Nro de matrícula SAP
 * @property string|null $codigo Código a nivel de facultad
 * @property int $carrera_id
 * @property string $dni
 * @property string $apellido_paterno
 * @property string|null $apellido_materno
 * @property string $nombres
 * @property string|null $email_usmp
 * @property string $email_personal
 * @property string|null $celular
 * @property string|null $telefono
 * @property string|null $mensaje
 * @property string|null $obs_alumno
 * @property string $fecha_solicitud
 * @property string|null $fecha_registro
 * @property string|null $cta_sin_deuda_pendiente_check SI->El alumno NO tiene deuda pendiente
 * @property string|null $cta_sin_deuda_pendiente_obs Observaciones de deuda pendiente llenado por Cuentas Corrientes
 * @property string|null $cta_pago_tramite_check SI->se confirma el pago de derecho de trámite
 * @property string|null $cta_pago_tramite_adjunto
 * @property string|null $cta_pago_tramite_obs Observaciones de pago de derecho de trámite llenado por Cuentas Corrientes
 * @property string|null $ora_record_notas_check SI->ORA presenta y adjunta record de notas
 * @property string|null $ora_record_notas_adjunto
 * @property string|null $ora_record_notas_obs Observaciones sobre el Record de Notas llenado por ORA->Oficina de Registros Académicos
 * @property string|null $aca_cursos_aptos_check SI->ACA presenta y adjunta DOC DE CURSOS APTOS
 * @property string|null $aca_cursos_aptos_adjunto
 * @property string|null $aca_cursos_aptos_observaciones Observaciones sobre los Cursos Aptos que el alumno puede llevar llenado por ACA->Coordinación Académica
 * @property string|null $ora_cursos_aptos_check SI->Ingresó información correctamente a los sistemas de SICAT/SAP
 * @property string|null $ora_cursos_aptos_obs Observaciones de ingreso de información a los sistemas de SICAT/SAP
 * @property string|null $oti_cursos_aptos_check SI->Ingresó información de consolidado correctamente a SAP
 * @property string|null $oti_cursos_aptos_obs Observaciones de ingreso de información a SAP
 * @property string|null $oti_notifica_email_check SI->Envía correctamente email al alumno y a ACA:departamento académico
 * @property string|null $oti_notifica_email_obs Observaciones de envío de emails
 */
class Matriculareact extends modelBase

{
    const DOCU_PAGO_TRAMITE_ADJUNTO='211';
    const DOCU_RECORD_NOTAS_ADJUNTO='213';
    const DOCU_CURSOS_APTO_ADJUNTO='215';

    private $_array_docs=[
        self::DOCU_PAGO_TRAMITE_ADJUNTO=>'1',
        self::DOCU_RECORD_NOTAS_ADJUNTO=>'1',//acticvar luego
        self::DOCU_CURSOS_APTO_ADJUNTO=>'1',
            ];

    // public $dateorTimeFields  = [
    //     'fecha_solicitud' =>self::_FDATETIME
    // ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tramdoc_matricula_reacts}}';
    }

    


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['carrera_id', 'apellido_paterno', 'nombres'], 'required'],
            [['carrera_id'], 'integer'],
            [['mensaje', 'cta_sin_deuda_pendiente_obs', 'cta_pago_tramite_obs', 'ora_record_notas_obs', 'aca_cursos_aptos_observaciones', 'ora_cursos_aptos_obs', 'oti_cursos_aptos_obs', 'oti_notifica_email_obs'], 'string'],
            [['fecha_solicitud', 'fecha_registro', 'obs_alumno'], 'safe'],
            [['nro_matr', 'codigo', 'apellido_paterno', 'apellido_materno', 'nombres'], 'string', 'max' => 40],
            [['dni'], 'string', 'max' => 20],
            [['email_usmp', 'email_personal', 'celular', 'telefono'], 'string', 'max' => 60],
            [['cta_sin_deuda_pendiente_check', 'cta_pago_tramite_check', 'ora_record_notas_check', 'aca_cursos_aptos_check', 'ora_cursos_aptos_check', 'oti_cursos_aptos_check', 'oti_notifica_email_check'], 'string', 'max' => 2],
            [['cta_pago_tramite_adjunto', 'ora_record_notas_adjunto', 'aca_cursos_aptos_adjunto'], 'string', 'max' => 160],
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
            'nro_matr' => Yii::t('base_labels', 'Nro Matricula'),
            'codigo' => Yii::t('base_labels', 'Código'),
            'carrera_id' => Yii::t('base_labels', 'Escuela'),
            'dni' => Yii::t('base_labels', 'DNI'),
            'apellido_paterno' => Yii::t('base_labels', 'Apellido Paterno'),
            'apellido_materno' => Yii::t('base_labels', 'Apellido Materno'),
            'nombres' => Yii::t('base_labels', 'Nombres'),
            'email_usmp' => Yii::t('base_labels', 'Email Usmp'),
            'email_personal' => Yii::t('base_labels', 'Email Personal'),
            'celular' => Yii::t('base_labels', 'Celular'),
            'telefono' => Yii::t('base_labels', 'Teléfono'),
            'mensaje' => Yii::t('base_labels', 'Mensaje'),
            'obs_alumno' => Yii::t('base_labels', 'Observaciones'),
            'fecha_solicitud' => Yii::t('base_labels', 'Fecha de Solicitud'),
            'fecha_registro' => Yii::t('base_labels', 'Fecha Registro'),
            'cta_sin_deuda_pendiente_check' => Yii::t('base_labels', 'Presenta Deuda Pendiente'),
            'cta_sin_deuda_pendiente_obs' => Yii::t('base_labels', 'Observaciones de Deuda Pendiente '),
            'cta_pago_tramite_check' => Yii::t('base_labels', 'Pago de Trámite Realizado'),
            'cta_pago_tramite_adjunto' => Yii::t('base_labels', 'Adjunto de Comprobante de Pago'),
            'cta_pago_tramite_obs' => Yii::t('base_labels', 'Observaciones Sobre de Pago Tramite Pendiente'),
            'ora_record_notas_check' => Yii::t('base_labels', 'Record de Notas Generado'),
            'ora_record_notas_adjunto' => Yii::t('base_labels', 'Adjunto de Record de Notas'),
            'ora_record_notas_obs' => Yii::t('base_labels', 'Observaciones de Record Notas'),
            
            'ora_soli_reg_check'=> Yii::t('base_labels', 'Solicitud resgitrada'),
            'aca_cursos_aptos_check' => Yii::t('base_labels', 'Cursos Aptos Generado'),
            'aca_cursos_aptos_adjunto' => Yii::t('base_labels', 'Adjunto de Cursos Aptos'),
            'aca_cursos_aptos_observaciones' => Yii::t('base_labels', 'Cursos Aptos Observaciones'),
            'ora_cursos_aptos_check' => Yii::t('base_labels', 'Cursos Aptos Registrado'),
            'ora_cursos_aptos_obs' => Yii::t('base_labels', 'Observaciones de Cursos Aptos'),
            'oti_cursos_aptos_check' => Yii::t('base_labels', 'Cursos Aptos Envío-SAP'),
            'oti_cursos_aptos_obs' => Yii::t('base_labels', 'Observaciones Cursos Aptos  Envío-SAP'),
            'oti_notifica_email_check' => Yii::t('base_labels', 'Notificación Email Alumno'),
            'oti_notifica_email_obs' => Yii::t('base_labels', 'Observaciones sobre Notificación Email '),
            'estado' => Yii::t('base_labels', 'Estado de los tramites '),
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
                            $var = new TramdocAuditoria([
                                'matr_id' => $this->id,
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
            TramdocFiles::firstOrCreateStatic(
                [
                    'matr_id' => $this->id,
                    'docu_id' => $codocu.'',
                ]
            );
        }
    }
}
