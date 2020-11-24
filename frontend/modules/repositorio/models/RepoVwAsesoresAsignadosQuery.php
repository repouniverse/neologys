<?php

namespace frontend\modules\repositorio\models;

/**
 * This is the ActiveQuery class for [[RepoVwAsesoresAsignados]].
 *
 * @see RepoVwAsesoresAsignados
 */
class RepoVwAsesoresAsignadosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RepoVwAsesoresAsignados[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RepoVwAsesoresAsignados|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
