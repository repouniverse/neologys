<?php

namespace frontend\modules\inter\models;

/**
 * This is the ActiveQuery class for [[InterInvitaciones]].
 *
 * @see InterInvitaciones
 */
class InterInvitacionesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InterInvitaciones[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InterInvitaciones|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
