<?php

namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[Facultades]].
 *
 * @see Facultades
 */
class FacultadesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Facultades[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Facultades|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
