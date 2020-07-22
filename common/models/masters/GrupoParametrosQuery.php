<?php

namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[GrupoParametros]].
 *
 * @see GrupoParametros
 */
class GrupoParametrosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GrupoParametros[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GrupoParametros|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
