<?php

namespace frontend\modules\inter\models;

/**
 * This is the ActiveQuery class for [[InterExpedientes]].
 *
 * @see InterExpedientes
 */
class InterExpedientesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InterExpedientes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InterExpedientes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
