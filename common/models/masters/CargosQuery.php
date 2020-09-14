<?php

namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[Cargos]].
 *
 * @see Cargos
 */
class CargosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Cargos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Cargos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
