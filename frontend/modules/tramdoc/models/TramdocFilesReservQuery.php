<?php

namespace frontend\modules\tramdoc\models;

/**
 * This is the ActiveQuery class for [[TramdocFilesReserv]].
 *
 * @see TramdocFilesReserv
 */
class TramdocFilesReservQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TramdocFilesReserv[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TramdocFilesReserv|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
