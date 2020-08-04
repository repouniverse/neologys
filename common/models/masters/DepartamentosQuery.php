<?php


namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[Departamentos]].
 *
 * @see Departamentos
 */
class DepartamentosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Departamentos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Departamentos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
