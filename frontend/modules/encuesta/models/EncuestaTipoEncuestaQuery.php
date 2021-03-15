<?php

namespace frontend\modules\encuesta\models;

/**
 * This is the ActiveQuery class for [[EncuestaTipoEncuesta]].
 *
 * @see EncuestaTipoEncuesta
 */
class EncuestaTipoEncuestaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return EncuestaTipoEncuesta[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return EncuestaTipoEncuesta|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
