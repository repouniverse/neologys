<?php

namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[AlumnosInter]].
 *
 * @see AlumnosInter
 */
class AlumnosInterQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AlumnosInter[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AlumnosInter|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
