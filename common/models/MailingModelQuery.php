<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[MailingModel]].
 *
 * @see MailingModel
 */
class MailingModelQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MailingModel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MailingModel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
