<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CarrerasTest]].
 *
 * @see CarrerasTest
 */
class CarrerasTestQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CarrerasTest[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CarrerasTest|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
