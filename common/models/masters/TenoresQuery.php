<?php

namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[Tenores]].
 *
 * @see Tenores
 */
class TenoresQuery extends \common\components\ActiveQueryScopeUniv
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Tenores[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Tenores|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
