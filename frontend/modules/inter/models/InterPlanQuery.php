<?php

namespace frontend\modules\inter\models;

/**
 * This is the ActiveQuery class for [[InterPlan]].
 *
 * @see InterPlan
 */
class InterPlanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InterPlan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InterPlan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
