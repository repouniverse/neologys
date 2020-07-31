<?php

namespace frontend\modules\import\models;

/**
 * This is the ActiveQuery class for [[ImportCargaUser]].
 *
 * @see ImportCargaUser
 */
class ImportCargamasivaUserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ImportCargaUser[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ImportCargaUser|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
