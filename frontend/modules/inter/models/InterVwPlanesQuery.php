<?php

namespace frontend\modules\inter\models;

/**
 * This is the ActiveQuery class for [[InterVwPlanes]].
 *
 * @see InterVwPlanes
 */
class InterVwPlanesQuery extends  \common\components\ActiveQueryScopeUniv
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InterVwPlanes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InterVwPlanes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
