<?php

namespace frontend\modules\acad\models;

/**
 * This is the ActiveQuery class for [[AcadSyllabus]].
 *
 * @see AcadSyllabus
 */
class AcadSyllabusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AcadSyllabus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AcadSyllabus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
