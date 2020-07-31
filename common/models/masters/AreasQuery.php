<?php

namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[Areas]].
 *
 * @see Areas
 */
class AreasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Areas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Areas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
