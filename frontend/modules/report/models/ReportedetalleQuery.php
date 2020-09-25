<?php

namespace frontend\modules\report\models;

/**
 * This is the ActiveQuery class for [[Reportedetalle]].
 *
 * @see Reportedetalle
 */
class ReportedetalleQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Reportedetalle[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Reportedetalle|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
