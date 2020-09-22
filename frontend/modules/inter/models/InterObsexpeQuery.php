<?php

namespace frontend\modules\inter\models;

/**
 * This is the ActiveQuery class for [[InterObsexpe]].
 *
 * @see InterObsexpe
 */
class InterObsexpeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InterObsexpe[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InterObsexpe|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
