<?php

namespace frontend\modules\import\models;

/**
 * This is the ActiveQuery class for [[ImportCargamasivadet]].
 *
 * @see ImportCargamasivadet
 */
class ImportCargamasivadetQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ImportCargamasivadet[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ImportCargamasivadet|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
