<?php

namespace frontend\modules\encuesta\models;

/**
 * This is the ActiveQuery class for [[EncuestaTipoPregunta]].
 *
 * @see EncuestaTipoPregunta
 */
class EncuestaTipoPreguntaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return EncuestaTipoPregunta[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return EncuestaTipoPregunta|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
