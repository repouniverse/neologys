<?php

namespace frontend\modules\inter\models;

/**
 * This is the ActiveQuery class for [[InterEntrevistas]].
 *
 * @see InterEntrevistas
 */
class InterEntrevistasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InterEntrevistas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InterEntrevistas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
