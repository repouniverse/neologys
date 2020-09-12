<?php

namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[UsersUniversities]].
 *
 * @see UsersUniversities
 */
class UsersUniversitiesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UsersUniversities[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UsersUniversities|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
