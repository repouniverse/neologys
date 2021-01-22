<?php

namespace frontend\modules\buzon\models;

/**
 * This is the ActiveQuery class for [[UserNoReg]].
 *
 * @see UserNoReg
 */
class UserNoRegQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserNoReg[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserNoReg|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
