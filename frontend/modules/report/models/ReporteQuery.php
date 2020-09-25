<?php

namespace frontend\modules\report\models;

/**
 * This is the ActiveQuery class for [[Reporte]].
 *
 * @see Reporte
 */
class ReporteQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Reporte[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Reporte|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
