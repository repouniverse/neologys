<?php

namespace frontend\modules\inter\models;

/**
 * This is the ActiveQuery class for [[InterModos]].
 *
 * @see InterModos
 */
class InterModosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InterModos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InterModos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
