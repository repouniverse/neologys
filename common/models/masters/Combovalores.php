<?php

namespace common\models\masters;

use Yii;

/**
 * This is the model class for table "{{%combovalores}}".
 *
 * @property int $id
 * @property string $nombretabla
 * @property string $codcen
 * @property string $codigo
 * @property string $valor
 * @property string $valor1
 * @property string $valor2
 *
 * @property Centros $codcen0
 */
class Combovalores extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%combovalores}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombretabla','codigo','valor'], 'required'],
            [['codigo'], 'match', 'pattern' => '/[1-9A-Z]{1}[0-9A-Z]{0,2}/'],
            [['codcen'], 'string', 'max' => 5],
            [['nombretabla', 'codigo'], 'unique', 'targetAttribute' => ['nombretabla', 'codigo']],
            [['codigo'], 'string', 'max' => 6],
            [[ 'valor1', 'valor2'], 'string', 'max' => 3],
            [['valor'], 'string', 'max' => 60],
            //[['codcen'], 'exist', 'skipOnError' => true, 'targetClass' => Centros::className(), 'targetAttribute' => ['codcen' => 'codcen']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombretabla' => Yii::t('app', 'Nombretabla'),
            'codcen' => Yii::t('app', 'Codcen'),
            'codigo' => Yii::t('app', 'Codigo'),
            'valor' => Yii::t('app', 'Valor'),
            'valor1' => Yii::t('app', 'Valor1'),
            'valor2' => Yii::t('app', 'Valor2'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodcen0()
    {
        return $this->hasOne(Centros::className(), ['codcen' => 'codcen']);
    }

    /**
     * {@inheritdoc}
     * @return CombovaloresQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CombovaloresQuery(get_called_class());
    }
    
    /*Dvuel ve un valor dado una calve */
    public static function getValue($key,$valor,$codcentro=null){
       if(!is_null($codcentro))
      $reg= static::find()->where(['nombretabla'=>$key,'codigo'=>$valor,'codcen'=>$codcentro])->one();
       $reg= static::find()->where(['nombretabla'=>$key,'codigo'=>$valor])->one();
       //var_dump(static::find()->where(['nombretabla'=>$key,'codigo'=>$valor])->createCommand()->getRawSql());
       //var_dump($reg);die();
      // yii::error($reg->attributes);
      if(is_null($reg))
          return '';
       return $reg->valor;
       
        
    }
}
