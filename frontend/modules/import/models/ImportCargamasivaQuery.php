<?php

namespace frontend\modules\import\models;

/**
 * This is the ActiveQuery class for [[ImportCargamasiva]].
 *
 * @see ImportCargamasiva
 */
class ImportCargamasivaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ImportCargamasiva[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ImportCargamasiva|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
