<?php

namespace common\components;

use yii\base\Component;

use Alchemy\Zippy\Zippy;

class Zipper extends Component implements ZipperInterface
{
    protected $zippy;
    public $type = 'zip';
    public $ext;
    public $password;
    
    
    public function init() 
    {
        $this->zippy = Zippy::load();
        if (!$this->ext){
            $this->ext = $this->type;
            if ($this->ext == '7zip'){
                $this->ext = 'zip';
            }
        }
    }
    
    public function setType(string $type)
    {
        $this->type = $type;
    }
    
    public function setExt(string $ext)
    {
        $this->ext = $ext;
    }
    
    public function setPassword(string $password)
    {
        $this->password = $password;
    }
    
    public function create(string $path, array $files = null, bool $recursive = true, string $type = null, string $password = null)
    {
        return $this->zippy->create($path, $files, $recursive, 
            $type ? $type : $this->type, 
            $password ? $password : $this->password);
    }
    
    public function open($path, $type = null, $password = null)
    {
        return $this->zippy->open($path, 
            $type ? $type : $this->type, 
            $password ? $password : $this->password);
    }
    
    public function getInflatorVersion($type = null)
    {
        if (!$type){
            $type = $this->type;
        }
        $adapter = $this->zippy->getAdapterFor($type);
        $version = $adapter->getInflatorVersion();
        return $version;
    }
    
    public function getDeflatorVersion($type = null)
    {
        if (!$type){
            $type = $this->type;
        }
        $adapter = $this->zippy->getAdapterFor($type);
        $version = $adapter->getDeflatorVersion();
        return $version;
    }
}