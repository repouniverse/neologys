<?php

namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[Trabajadores]].
 *
 * @see Trabajadores
 */
class TrabajadoresQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Trabajadores[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Trabajadores|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
