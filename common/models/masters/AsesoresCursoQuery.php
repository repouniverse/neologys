<?php

namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[Asesores]].
 *
 * @see Asesores
 */
class AsesoresCursoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Asesores[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Asesores|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
