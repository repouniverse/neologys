<?php

namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[Carreras]].
 *
 * @see Carreras
 */
class CarrerasQuery extends \common\components\ActiveQueryScopeUniv
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Carreras[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Carreras|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
