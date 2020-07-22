<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%useraudit}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $when
 * @property string $ip
 * @property string $action
 */
class Useraudit extends \common\models\base\modelBase
{
    const ACTION_LOGIN='login';
    const ACTION_LOGOUT='logout';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%useraudit}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['when', 'ip'], 'string', 'max' => 19],
            [['action'], 'string', 'max' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base.names', 'ID'),
            'user_id' => Yii::t('base.names', 'User ID'),
            'when' => Yii::t('base.names', 'Cuando'),
            'ip' => Yii::t('base.names', 'Dirección de red IP'),
            'action' => Yii::t('base.names', 'Acción'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return userQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new userQuery(get_called_class());
    }
    
    public static function  lastLogin($iduser){
        return static::find()->where(['user_id'=>$iduser,'action'=>static::ACTION_LOGIN])->max('[[when]]');
    }
    
    
    public static function UsersInLine(){
        $carbon= \Carbon\Carbon::now();
        $carbon->subMinutes(40);
        $inLine=self::find()->select(['username'])->distinct()->join('inner join', '{{%user}} b', 'user_id=b.id')->                
                where(['>=','when',$carbon->subMinutes(40)->format('Y-m-d H:i:s')])->orderBy('when desc')->limit(20)->asArray()->all();
        return $inLine;
    }
    
    
}
