<?php

namespace frontend\modules\inter\models;

/**
 * This is the ActiveQuery class for [[InterEventos]].
 *
 * @see InterEventos
 */
class InterEventosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InterEventos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InterEventos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
