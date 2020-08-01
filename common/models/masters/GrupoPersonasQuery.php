<?php

namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[GrupoPersonas]].
 *
 * @see GrupoPersonas
 */
class GrupoPersonasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GrupoPersonas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GrupoPersonas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
