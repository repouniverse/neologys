<?php
namespace common\components;

/**
 * Interface for victor78/yii2-zipper compliant archiveMaker 
 */
interface ZipperInterface
{
    
    public function create(string $path, array $files = null, bool $recursive = true, string $type = null, string $password = null);
    
    public function setType(string $type);
    
    public function setExt(string $ext);
    
    public function setPassword(string $password);  
    
}