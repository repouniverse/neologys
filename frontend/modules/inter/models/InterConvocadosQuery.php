<?php

namespace frontend\modules\inter\models;

/**
 * This is the ActiveQuery class for [[InterConvocados]].
 *
 * @see InterConvocados
 */
class InterConvocadosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InterConvocados[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InterConvocados|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
