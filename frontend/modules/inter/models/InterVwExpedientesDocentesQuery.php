<?php

namespace frontend\modules\inter\models;

/**
 * This is the ActiveQuery class for [[InterVwExpedientesDocentes]].
 *
 * @see InterVwExpedientesDocentes
 */
class InterVwExpedientesDocentesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InterVwExpedientesDocentes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InterVwExpedientesDocentes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
