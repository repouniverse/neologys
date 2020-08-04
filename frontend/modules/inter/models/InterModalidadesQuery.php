<?php

namespace frontend\modules\inter\models;

/**
 * This is the ActiveQuery class for [[InterModalidades]].
 *
 * @see InterModalidades
 */
class InterModalidadesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InterModalidades[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InterModalidades|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
