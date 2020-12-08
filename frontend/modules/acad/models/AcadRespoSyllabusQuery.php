<?php

namespace frontend\modules\acad\models;

/**
 * This is the ActiveQuery class for [[AcadRespoSyllabus]].
 *
 * @see AcadRespoSyllabus
 */
class AcadRespoSyllabusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AcadRespoSyllabus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AcadRespoSyllabus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
