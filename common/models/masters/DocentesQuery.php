<?php

namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[Docentes]].
 *
 * @see Docentes
 */
class DocentesQuery extends \common\components\ActiveQueryScopeUniv
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Docentes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Docentes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
