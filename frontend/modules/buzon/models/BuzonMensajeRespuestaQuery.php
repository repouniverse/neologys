<?php

namespace frontend\modules\buzon\models;

/**
 * This is the ActiveQuery class for [[BuzonMensajeRespuesta]].
 *
 * @see BuzonMensajeRespuesta
 */
class BuzonMensajeRespuestaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BuzonMensajeRespuesta[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BuzonMensajeRespuesta|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
