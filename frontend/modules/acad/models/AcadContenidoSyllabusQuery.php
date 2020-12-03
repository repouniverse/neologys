<?php

namespace frontend\modules\acad\models;

/**
 * This is the ActiveQuery class for [[AcadContenidoSyllabus]].
 *
 * @see AcadContenidoSyllabus
 */
class AcadContenidoSyllabusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AcadContenidoSyllabus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AcadContenidoSyllabus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
