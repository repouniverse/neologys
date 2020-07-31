<?php

namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[Universidades]].
 *
 * @see Universidades
 */
class UniversidadesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Universidades[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Universidades|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
