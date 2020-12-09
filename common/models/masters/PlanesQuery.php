<?php
namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[Planes]].
 *
 * @see Planes
 */
class PlanesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Planes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Planes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
