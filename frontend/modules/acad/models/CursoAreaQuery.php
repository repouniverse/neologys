<?php

namespace frontend\modules\acad\models;

/**
 * This is the ActiveQuery class for [[CursoArea]].
 *
 * @see CursoArea
 */
class CursoAreaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CursoArea[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CursoArea|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
