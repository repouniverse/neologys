<?php

namespace frontend\modules\tramdoc\models;
use \common\models\base\modelBase;
use common\models\masters\Documentos;
use common\behaviors\FileBehavior;
use Yii;

/**
 * This is the model class for table "{{%tramdoc_files}}".
 *
 * @property int $id
 * @property int $matr_id
 * @property int $docu_id
 * @property string|null $is_subido
 *
 * @property TramdocMatriculaReacts $matr
 */
class TramdocFiles extends modelBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tramdoc_files}}';
    }

    public function behaviors()
    {
        return [

            'fileBehavior' => [
                'class' => FileBehavior::className()
            ],

        ];
    }

    public function init()
    {
        $this->on(FileBehavior::EVENT_AFTER_ATTACH_FILES, function ($event) {
            /** @var $files \nemmo\attachments\models\File[] */
            $files = $event->files;
            $this->save();
        });
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['matr_id', 'docu_id'], 'required'],
            [['matr_id', 'docu_id'], 'integer'],
            [['is_subido'], 'string', 'max' => 1],
            [['matr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Matriculareact::className(), 'targetAttribute' => ['matr_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('base_labels', 'ID'),
            'matr_id' => Yii::t('base_labels', 'Matr ID'),
            'docu_id' => Yii::t('base_labels', 'Docu ID'),
            'is_subido' => Yii::t('base_labels', 'Is Subido'),
        ];
    }

    /**
     * Gets query for [[Matr]].
     *
     * @return \yii\db\ActiveQuery|TramdocMatriculaReactsQuery
     */
    public function getMatr()
    {
        return $this->hasOne(Matriculareact::className(), ['id' => 'matr_id']);
    }

    /**
     * {@inheritdoc}
     * @return TramdocFilesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TramdocFilesQuery(get_called_class());
    }
}
