<?php

namespace frontend\modules\acad\models;

/**
 * This is the ActiveQuery class for [[AcadTramiteSyllabus]].
 *
 * @see AcadTramiteSyllabus
 */
class AcadTramiteSyllabusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AcadTramiteSyllabus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AcadTramiteSyllabus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
