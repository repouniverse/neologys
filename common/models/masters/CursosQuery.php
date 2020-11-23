<?php

namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[Cursos]].
 *
 * @see Cursos
 */
class CursosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Cursos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Cursos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
