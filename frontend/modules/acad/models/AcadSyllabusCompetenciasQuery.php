<?php

namespace frontend\modules\acad\models;

/**
 * This is the ActiveQuery class for [[AcadSyllabusCompetencias]].
 *
 * @see AcadSyllabusCompetencias
 */
class AcadSyllabusCompetenciasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AcadSyllabusCompetencias[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AcadSyllabusCompetencias|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
