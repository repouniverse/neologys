<?php

namespace frontend\modules\inter\models;

/**
 * This is the ActiveQuery class for [[InterEvaluadores]].
 *
 * @see InterEvaluadores
 */
class InterEvaluadoresQuery extends  \common\components\ActiveQueryScopeUniv/*\yii\db\ActiveQuery*/
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InterEvaluadores[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InterEvaluadores|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
