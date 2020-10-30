<?php

namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[Alumnos]].
 *
 * @see Alumnos
 */
class AlumnosQuery extends \common\components\ActiveQueryScopeUniv
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Alumnos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Alumnos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
