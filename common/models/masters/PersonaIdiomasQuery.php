<?php

namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[PersonaIdiomas]].
 *
 * @see PersonaIdiomas
 */
class PersonaIdiomasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PersonaIdiomas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PersonaIdiomas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
