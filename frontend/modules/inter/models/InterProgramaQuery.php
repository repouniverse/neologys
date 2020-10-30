<?php

namespace frontend\modules\inter\models;

/**
 * This is the ActiveQuery class for [[InterPrograma]].
 *
 * @see InterPrograma
 */
class InterProgramaQuery extends \common\components\ActiveQueryScopeUniv
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InterPrograma[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InterPrograma|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
