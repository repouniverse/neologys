<?php

namespace frontend\modules\inter\models;

/**
 * This is the ActiveQuery class for [[InterOpuniv]].
 *
 * @see InterOpuniv
 */
class InterOpunivQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InterOpuniv[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InterOpuniv|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
