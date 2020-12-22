<?php

namespace frontend\modules\acad\models;

/**
 * This is the ActiveQuery class for [[AcadVwSyllabus]].
 *
 * @see AcadVwSyllabus
 */
class AcadVwSyllabusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AcadVwSyllabus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AcadVwSyllabus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
