<?php

namespace common\models\masters;

/**
 * This is the ActiveQuery class for [[SettingsGen]].
 *
 * @see SettingsGen
 */
class SettingGenQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SettingsGen[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SettingsGen|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
