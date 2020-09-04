<?php

namespace frontend\modules\inter\models;

/**
 * This is the ActiveQuery class for [[InterHorarios]].
 *
 * @see InterHorarios
 */
class InterHorariosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InterHorarios[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InterHorarios|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
