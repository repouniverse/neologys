<?php

namespace frontend\modules\import\models;

use Yii;

/**
 * This is the model class for table "{{%import_logcargamasiva}}".
 *
 * @property int $id
 * @property int $cargamasiva_id
 * @property string $nombrecampo
 * @property string $mensaje
 * @property string $level
 * @property string $fecha
 * @property int $user_id
 * @property int $numerolinea
 *
 * @property ImportCargamasiva $cargamasiva
 */
class ImportLogcargamasiva extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%import_logcargamasiva}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'cargamasiva_id', 'nombrecampo', 'mensaje', 'user_id', 'numerolinea'], 'required'],
            [['id', 'cargamasiva_id', 'user_id', 'numerolinea'], 'integer'],
            [['nombrecampo'], 'string', 'max' => 60],
            [['mensaje'], 'string', 'max' =>180],
            [['level'], 'string', 'max' => 1],
            [['fecha'], 'safe'],
            [['cargamasiva_id'], 'exist', 'skipOnError' => true, 'targetClass' => ImportCargamasivaUser::className(), 'targetAttribute' => ['cargamasiva_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('import.labels', 'ID'),
            'cargamasiva_id' => Yii::t('import.labels', 'Cargamasiva ID'),
            'nombrecampo' => Yii::t('import.labels', 'Campo'),
            'mensaje' => Yii::t('import.labels', 'Mensaje del error'),
            'level' => Yii::t('import.labels', 'Nivel'),
            'fecha' => Yii::t('import.labels', 'Fecha'),
            'user_id' => Yii::t('import.labels', 'User ID'),
            'numerolinea' => Yii::t('import.labels', 'Número de fila'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCargamasivaUser()
    {
        return $this->hasOne(ImportCargamasivaUser::className(), ['id' => 'cargamasiva_id']);
    }

    /**
     * {@inheritdoc}
     * @return ImportLogcargamasivaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImportLogcargamasivaQuery(get_called_class());
    }
}
