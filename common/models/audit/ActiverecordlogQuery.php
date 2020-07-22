<?php

namespace common\models\audit;

/**
 * This is the ActiveQuery class for [[Direcciones]].
 *
 * @see Direcciones
 */
class ActiverecordlogQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Direcciones[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Direcciones|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
