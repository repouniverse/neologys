<?php

namespace frontend\modules\acad\models;

/**
 * This is the ActiveQuery class for [[AcadVwPlanesEstudio]].
 *
 * @see AcadVwPlanesEstudio
 */
class AcadVwPlanesEstudioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AcadVwPlanesEstudio[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AcadVwPlanesEstudio|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
