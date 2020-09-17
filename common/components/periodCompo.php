<?php
namespace common\components;

use Yii;

use yii\caching\Cache;
use yii\base\Component;
use yii\di\Instance;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;

/**
 * Creada por Jramirez  10/08/2020
 * `para trener a la mano los periodos
 * ya que todo está enb fucnón de ellos y debe de 
 * estar a la mano, evie vrtear compoentes
 * pues sobrecargab la aplicaicon 
 */
class periodCompo extends Component
{
    /**
     * @var string modelo al que apunta
     */
    public $modelClass = 'common\models\masters\Periodos';

    /**
     * cacheando
     */
    public $cache = 'cache';

    /**
     * @var string pallbra clave para almacenar datos en cache
     */
    public $cacheKey = 'micompo-periodo';

    /*c¡varab modelo*/
   protected $model;

    protected $items;
    /**
     * Initializar el componente y hacerle CACHING
     */
    public function init()
    {
        parent::init();

        if ($this->cache !== null) {
            $this->cache = Instance::ensure($this->cache, Cache::class);
        }
/*Crea el modelo*/
        $this->model = Yii::createObject($this->modelClass);
    }

    /*Devuelve la tabla periodos como un array
pero antes loa lancena en cache     */
    protected function getPeriodos(): array
    {
        if (!$this->cache instanceof Cache) {
            $this->items = $this->model->arrayPeriodos();
        } else {
            $cacheItems = $this->cache->get($this->cacheKey);
            if (!empty($cacheItems)) {
                $this->items = $cacheItems;
            } else {
                $this->items = $this->model->arrayPeriodos();
                $this->cache->set($this->cacheKey, $this->items);
            }
        }

        return $this->items;
    }
    
    
  public function getCurrentPeriod(){
      $actual=null;
      $this->getPeriodos();
      FOREACH($this->items as $item){
          if($item['activa']=='1'){
              $actual=$item['codperiodo']; 
              break;
          }
      }
     if(is_null($actual)){
       throw new ServerErrorHttpException(Yii::t('base_errors', 'There is no active academic period'));
    	   
     }else{
         return $actual;
     }
  }
    
   public function clearCache(): bool
    {
        if ($this->cache !== null) {
            $this->cache->delete($this->cacheKey);
            $this->items = null;
        }

        return true;
    }
}


