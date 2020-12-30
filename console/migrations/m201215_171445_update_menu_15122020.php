<?php


use \mdm\admin\models\Menu as m;

/**
 * Class m201215_171445_update_menu_15122020
 */
class m201215_171445_update_menu_15122020 extends console\migrations\baseMigration
{
    /**
     * {@inheritdoc}
     */
    
    CONST NOMBRE_PADRE = "Syllabus"; // DEFINE EL NOMBRE DEL PADRE DEL MENU POR AGREGAR, ES LITERAL DE LA BD
    private function getIdMenu($nombreMenu){
        $varId = \mdm\admin\models\Menu::find()->where(['name'=>$nombreMenu])->one();
        
        if($varId !=null){
              return $varId->id;
        }else{
            return null;
        }
    }
    
    public function safeUp()
    {
        //CREA EL NOMBRE DEL MENU PADRE
        $this->createMenuPadre(self::NOMBRE_PADRE);
        foreach ($this->routes() as $nombre=>$ruta){
             $modelMenu=new \mdm\admin\models\Menu(([
                 'name'=> $nombre/*FileHelper::getShortName($accion) /*  str_replace('/admin/user/','',$accion)*/,
                 'route'=>$ruta,
                 'parent'=>$this->getIdMenu(self::NOMBRE_PADRE),
                 'data'=>'']
                     ));
             if(!$modelMenu->save()){
                 yii::error($modelMenu->getErrors());
             }
             
        }
        
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201215_171445_update_menu_15122020 cannot be reverted.\n";

        return false;
    }
    */
    
    private function routes(){
        return [
            'Create Syllabus' => '/acad/syllabus/index-docentes',
            'Manage Teachers' => '/acad/syllabus/manage-docente'
        ];
    }
    
    //CREA EL MENU PADRE
    private function createMenuPadre($menuPadre){
        if(!m::find()->where(['name'=>$menuPadre])->exists()){
            $model = new m([
                 'name'=> $menuPadre/*FileHelper::getShortName($accion) /*  str_replace('/admin/user/','',$accion)*/,
                 'route'=>null,
                 'parent'=>null,
                 'data'=>'']
                     );
            $model->save();
            return true;
        }else{
            yii::error("YA EXISTE UN MENU PADRE CON ESTE NOMBRE ".$menuPadre);
            return false;
        }   
    }
}
