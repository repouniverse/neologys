<?php

namespace frontend\modules\buzon\models;

/**
 * This is the ActiveQuery class for [[BuzonAdministradores]].
 *
 * @see BuzonAdministradores
 */
class BuzonAdministradoresQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BuzonAdministradores[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BuzonAdministradores|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
