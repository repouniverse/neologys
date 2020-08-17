<?php

namespace common\components\token\algorithms;

use yii\base\BaseObject;
use yii\base\Security;
use yii\di\Instance;


/**
 * Class RandomString
 */
class RandomString extends BaseObject implements AlgorithmInterface
{
    public $length = 32;
    /**
     * @var string|Security
     */
    public $security = 'security';

    /**
     * Generates token with given length
     * @return string
     */
    public function generate()
    {
        $this->security = Instance::ensure($this->security, Security::className());
        return $this->security->generateRandomString($this->length);
    }
}