<?php

namespace frontend\modules\acad\models;

/**
 * This is the ActiveQuery class for [[AcadSyllabusUnidades]].
 *
 * @see AcadSyllabusUnidades
 */
class AcadSyllabusUnidadesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AcadSyllabusUnidades[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AcadSyllabusUnidades|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
