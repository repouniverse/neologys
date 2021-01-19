<?php

namespace frontend\modules\buzon\models;

/**
 * This is the ActiveQuery class for [[BuzonMensajes]].
 *
 * @see BuzonMensajes
 */
class BuzonMensajesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BuzonMensajes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BuzonMensajes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
