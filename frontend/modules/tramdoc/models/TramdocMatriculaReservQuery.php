<?php

namespace frontend\modules\tramdoc\models;

/**
 * This is the ActiveQuery class for [[TramdocMatriculaReserv]].
 *
 * @see TramdocMatriculaReserv
 */
class TramdocMatriculaReservQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TramdocMatriculaReserv[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TramdocMatriculaReserv|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
