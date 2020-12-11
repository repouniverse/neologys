<?php

namespace frontend\modules\repositorio\models;

/**
 * This is the ActiveQuery class for [[RepositorioAsesoresCursoDocs]].
 *
 * @see RepositorioAsesoresCursoDocs
 */
class RepositorioAsesoresCursoDocsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RepositorioAsesoresCursoDocs[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RepositorioAsesoresCursoDocs|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
