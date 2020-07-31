<?php

namespace frontend\modules\import\models;

/**
 * This is the ActiveQuery class for [[ImportLogcargamasiva]].
 *
 * @see ImportLogcargamasiva
 */
class ImportLogcargamasivaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ImportLogcargamasiva[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ImportLogcargamasiva|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
