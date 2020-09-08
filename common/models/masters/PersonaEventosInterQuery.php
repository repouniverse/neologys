<?php

namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[PersonaEventosInter]].
 *
 * @see PersonaEventosInter
 */
class PersonaEventosInterQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PersonaEventosInter[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PersonaEventosInter|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
