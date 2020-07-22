<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Userfavoritos]].
 *
 * @see Userfavoritos
 */
class UserfavoritosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Userfavoritos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Userfavoritos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
