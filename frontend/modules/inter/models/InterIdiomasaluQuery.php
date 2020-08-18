<?php

namespace frontend\modules\inter\models;

/**
 * This is the ActiveQuery class for [[InterIdiomasalu]].
 *
 * @see InterIdiomasalu
 */
class InterIdiomasaluQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InterIdiomasalu[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InterIdiomasalu|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
