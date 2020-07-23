<?php
namespace common\models\masters;
use yii\rbac\Item;
/**
 * This is the ActiveQuery class for [[GrupoParametros]].
 *
 * @see GrupoParametros
 */
class TransaccionesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/
const CHARACTER_SLASH='/';
    public function init()
    {
      //var_dump(UserFacultades::filterFacultades());die();
       //$this->andWhere([ 'in', 'codfac',['FIM','FIP'] ]);
      $this->alias('t')->andWhere(['t.type'=>Item::TYPE_PERMISSION])->
        andWhere(['like','t.name',self::CHARACTER_SLASH]);
        parent::init();
    }
    /**
     * {@inheritdoc}
     * @return GrupoParametros[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GrupoParametros|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

?>