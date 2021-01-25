<?php

namespace frontend\modules\buzon\models;

/**
 * This is the ActiveQuery class for [[BuzonUserNoreg]].
 *
 * @see BuzonUserNoreg
 */
class BuzonUserNoregQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BuzonUserNoreg[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BuzonUserNoreg|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
