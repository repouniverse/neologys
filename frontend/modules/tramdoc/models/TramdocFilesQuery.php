<?php

namespace frontend\modules\tramdoc\models;

/**
 * This is the ActiveQuery class for [[TramdocFiles]].
 *
 * @see TramdocFiles
 */
class TramdocFilesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TramdocFiles[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TramdocFiles|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
