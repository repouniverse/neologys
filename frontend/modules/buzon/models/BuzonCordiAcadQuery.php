<?php

namespace frontend\modules\buzon\models;

/**
 * This is the ActiveQuery class for [[BuzonCordiAcad]].
 *
 * @see BuzonCordiAcad
 */
class BuzonCordiAcadQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BuzonCordiAcad[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BuzonCordiAcad|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
