<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[InterVwConvocados]].
 *
 * @see InterVwConvocados
 */
class InterVwConvocadosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InterVwConvocados[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InterVwConvocados|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
