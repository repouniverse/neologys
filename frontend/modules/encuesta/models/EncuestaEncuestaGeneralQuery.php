<?php

namespace frontend\modules\encuesta\models;

/**
 * This is the ActiveQuery class for [[EncuestaEncuestaGeneral]].
 *
 * @see EncuestaEncuestaGeneral
 */
class EncuestaEncuestaGeneralQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return EncuestaEncuestaGeneral[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return EncuestaEncuestaGeneral|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
