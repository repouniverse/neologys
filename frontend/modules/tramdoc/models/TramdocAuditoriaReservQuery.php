<?php

namespace frontend\modules\tramdoc\models;

/**
 * This is the ActiveQuery class for [[TramdocAuditoriaReserv]].
 *
 * @see TramdocAuditoriaReserv
 */
class TramdocAuditoriaReservQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TramdocAuditoriaReserv[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TramdocAuditoriaReserv|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
