<?php

namespace frontend\modules\encuesta\models;

use common\models\masters\Departamentos;
use common\models\masters\GrupoPersonas;
use Yii;

/**
 * This is the model class for table "{{%encuesta_encuesta_general}}".
 *
 * @property int $id
 * @property string $titulo_encuesta
 * @property string $id_tipo_usuario
 * @property int $id_tipo_encuesta
 * @property string $descripcion
 * @property string $numero_preguntas
 * @property int $id_dep_encargado
 *
 * @property EncuestaTipoEncuesta $tipoEncuesta
 * @property Departamentos $depEncargado
 * @property GrupoPersonas $tipoUsuario
 * @property EncuestaPersonaEncuesta[] $encuestaPersonaEncuestas
 * @property EncuestaPreguntaEncuesta[] $encuestaPreguntaEncuestas
 */
class EncuestaEncuestaGeneral extends \common\models\base\modelBase 
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%encuesta_encuesta_general}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo_encuesta', 'id_tipo_usuario', 'id_tipo_encuesta', 'descripcion', 'numero_preguntas', 'id_dep_encargado'], 'required'],
            [['id_tipo_encuesta', 'id_dep_encargado'], 'integer'],
            [['titulo_encuesta', 'descripcion', 'numero_preguntas'], 'string', 'max' => 30],
            [['id_tipo_usuario'], 'string', 'max' => 3],
            [['id_tipo_encuesta'], 'exist', 'skipOnError' => true, 'targetClass' => EncuestaTipoEncuesta::className(), 'targetAttribute' => ['id_tipo_encuesta' => 'id']],
            [['id_dep_encargado'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['id_dep_encargado' => 'id']],
            [['id_tipo_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => GrupoPersonas::className(), 'targetAttribute' => ['id_tipo_usuario' => 'codgrupo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'titulo_encuesta' => Yii::t('base_labels', 'Titulo Encuesta'),
            'id_tipo_usuario' => Yii::t('base_labels', 'Id Tipo Usuario'),
            'id_tipo_encuesta' => Yii::t('base_labels', 'Id Tipo Encuesta'),
            'descripcion' => Yii::t('base_labels', 'Descripcion'),
            'numero_preguntas' => Yii::t('base_labels', 'Numero Preguntas'),
            'id_dep_encargado' => Yii::t('base_labels', 'Id Dep Encargado'),
        ];
    }

    /**
     * Gets query for [[TipoEncuesta]].
     *
     * @return \yii\db\ActiveQuery|EncuestaTipoEncuestaQuery
     */
    public function getTipoEncuesta()
    {
        return $this->hasOne(EncuestaTipoEncuesta::className(), ['id' => 'id_tipo_encuesta']);
    }

    /**
     * Gets query for [[DepEncargado]].
     *
     * @return \yii\db\ActiveQuery|DepartamentosQuery
     */
    public function getDepEncargado()
    {
        return $this->hasOne(Departamentos::className(), ['id' => 'id_dep_encargado']);
    }

    /**
     * Gets query for [[TipoUsuario]].
     *
     * @return \yii\db\ActiveQuery|GrupoPersonasQuery
     */
    public function getTipoUsuario()
    {
        return $this->hasOne(GrupoPersonas::className(), ['codgrupo' => 'id_tipo_usuario']);
    }

    /**
     * Gets query for [[EncuestaPersonaEncuestas]].
     *
     * @return \yii\db\ActiveQuery|EncuestaPersonaEncuestaQuery
     */
    public function getEncuestaPersonaEncuestas()
    {
        return $this->hasMany(EncuestaPersonaEncuesta::className(), ['id_encuesta' => 'id']);
    }

    /**
     * Gets query for [[EncuestaPreguntaEncuestas]].
     *
     * @return \yii\db\ActiveQuery|EncuestaPreguntaEncuestaQuery
     */
    public function getEncuestaPreguntaEncuestas()
    {
        return $this->hasMany(EncuestaPreguntaEncuesta::className(), ['id_encuesta' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return EncuestaEncuestaGeneralQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EncuestaEncuestaGeneralQuery(get_called_class());
    }
}
