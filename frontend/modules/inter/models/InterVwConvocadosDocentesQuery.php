<?php

namespace frontend\modules\inter\models;

/**
 * This is the ActiveQuery class for [[InterVwConvocadosDocentes]].
 *
 * @see InterVwConvocadosDocentes
 */
class InterVwConvocadosDocentesQuery extends \common\components\ActiveQueryScopeUniv
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InterVwConvocadosDocentes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InterVwConvocadosDocentes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
