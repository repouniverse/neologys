<?php

namespace frontend\modules\encuesta\models;

/**
 * This is the ActiveQuery class for [[EncuestaOpcionesPregunta]].
 *
 * @see EncuestaOpcionesPregunta
 */
class EncuestaOpcionesPreguntaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return EncuestaOpcionesPregunta[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return EncuestaOpcionesPregunta|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
