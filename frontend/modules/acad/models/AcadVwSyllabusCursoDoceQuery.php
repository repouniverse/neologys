<?php

namespace frontend\modules\acad\models;

/**
 * This is the ActiveQuery class for [[AcadVwSyllabusCursoDoce]].
 *
 * @see AcadVwSyllabusCursoDoce
 */
class AcadVwSyllabusCursoDoceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AcadVwSyllabusCursoDoce[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AcadVwSyllabusCursoDoce|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
