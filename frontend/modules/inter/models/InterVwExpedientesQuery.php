<?php

namespace frontend\modules\inter\models;

/**
 * This is the ActiveQuery class for [[InterVwExpedientes]].
 *
 * @see InterVwExpedientes
 */
class InterVwExpedientesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InterVwExpedientes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InterVwExpedientes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
