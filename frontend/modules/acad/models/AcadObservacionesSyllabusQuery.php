<?php

namespace frontend\modules\acad\models;

/**
 * This is the ActiveQuery class for [[AcadObservacionesSyllabus]].
 *
 * @see AcadObservacionesSyllabus
 */
class AcadObservacionesSyllabusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AcadObservacionesSyllabus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AcadObservacionesSyllabus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
