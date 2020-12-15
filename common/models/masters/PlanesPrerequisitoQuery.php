<?php

namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[PlanesPrerequisito]].
 *
 * @see PlanesPrerequisito
 */
class PlanesPrerequisitoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PlanesPrerequisito[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PlanesPrerequisito|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
