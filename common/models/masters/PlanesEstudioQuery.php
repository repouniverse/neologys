<?php

namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[PlanesEstudio]].
 *
 * @see PlanesEstudio
 */
class PlanesEstudioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PlanesEstudio[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PlanesEstudio|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
