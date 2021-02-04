<?php

namespace frontend\modules\tramdoc\models;

/**
 * This is the ActiveQuery class for [[TramdocAuditoria]].
 *
 * @see TramdocAuditoria
 */
class TramdocAuditoriaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TramdocAuditoria[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TramdocAuditoria|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
