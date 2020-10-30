<?php

namespace common\models\masters;
use yii\data\ActiveDataProvider;
USE common\models\User;
use common\helpers\h;
use Yii;

/**
 * This is the model class for table "7pxv4v_users_universities".
 *
 * @property int $id
 * @property int $universidad_id
 * @property int $user_id
 * @property string $activo
 *
 * @property Universidades $universidad
 * @property User $user
 */
class UsersUniversities extends \common\models\base\modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users_universities}}';
    }

    
       public $booleanFields=['activo'];
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['universidad_id', 'user_id', 'activo'], 'required'],
            [['universidad_id', 'user_id'], 'integer'],
            [['activo'], 'safe'],
            [['universidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Universidades::className(), 'targetAttribute' => ['universidad_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'universidad_id' => Yii::t('base_labels', 'University'),
            'user_id' => Yii::t('base_labels', 'User ID'),
            'activo' => Yii::t('base_labels', 'Active'),
        ];
    }

    /**
     * Gets query for [[Universidad]].
     *
     * @return \yii\db\ActiveQuery|UniversidadesQuery
     */
    public function getUniversidad()
    {
        return $this->hasOne(Universidades::className(), ['id' => 'universidad_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return UsersUniversitiesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersUniversitiesQuery(get_called_class());
    }
    
     /*Refresca los valores de la tabla 
     * segun se hayan agregado faultades 
     * o falte algun registro 
     */
    public static function refreshTableByUser($iduser=null){
        if(is_null($iduser))
        $iduser=h::userId();
       $universidadesId=static::idUniversidades();
       //var_dump($facultades);die();
     foreach($universidadesId as $universidadId){
          static::firstOrCreateStatic([
                    'user_id'=>$iduser,
                     'universidad_id'=>$universidadId,
                     //rr'activa'=>'0',
                    ]);
      }
      
      return $universidadesId;
    }
    
    
    /*
    private static function tableUser(){
        return h::user()->identity->tableName();
    }*/
    private static function idUniversidades(){
        return Universidades::find()->select(['id'])->column();
    }
    /* private static function idUsers(){
        return static::query()->select('id')->
            from(static::tableUser())
              ->where(
                      ['status'=>
                        \common\models\User::STATUS_ACTIVE
                      ])->all();
    }*/
    
    
   /*Devuelve un data provider de lso facultades user por usuario 
    * Observe que hace reerencia a la clase Parametroscentrosdocu tabla
    *   'parametrosdocucentros'
    */
   public static function providerUniversidades($iduser=null){
            return new ActiveDataProvider([
                'query' =>static::find()->where(['user_id'=>is_null($iduser)?h::userId():$iduser]),
                'pagination' => [
                    'pageSize' => 120,
                            ],
                                    ]);
        } 
    
        
        public static function providerUniversidadesAll($iduser=null){
          
            return new ActiveDataProvider([
                'query' =>static::find(false)->where(['user_id'=>is_null($iduser)?h::userId():$iduser]),
                'pagination' => [
                    'pageSize' => 120,
                            ],
                                    ]);
        } 
        
   public static function filterUniversidades($iduser=null){
      return static::find()->
               select('universidad_id')->
               andWhere(['user_id'=>is_null($iduser)?h::userId():$iduser,'activo'=>'1'])->column();
   }     
        
    public static function revokeAccess($iduser=null){
        return static::updateAll(['activo'=>'0'],['user_id'=>is_null($iduser)?h::userId():$iduser]);
    }
    
    public static function habilitaUniversity($iduser,$universidad_id){
        yii::error('invocando');
        static::firstOrCreateStatic([
                    'user_id'=>$iduser,
                     'universidad_id'=>$universidad_id,
                     'activo'=>true,
                    ],null,[
                    'user_id'=>$iduser,
                     'universidad_id'=>$universidad_id,
                     //'activo'=>'1',
                    ]);
        $registros=static::updateAll(['activo'=>'1'], ['user_id'=>$iduser,'universidad_id'=>$universidad_id]);
       // var_dump($registros);
        return true;
    }
    
}
