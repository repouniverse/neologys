<?php

namespace frontend\modules\encuesta\models;

/**
 * This is the ActiveQuery class for [[EncuestaRespuestaEncuesta]].
 *
 * @see EncuestaRespuestaEncuesta
 */
class EncuestaRespuestaEncuestaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return EncuestaRespuestaEncuesta[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return EncuestaRespuestaEncuesta|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
