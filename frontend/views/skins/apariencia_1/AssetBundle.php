<?php
/**
 * AssetBundle.php
 * @author Revin Roman
 * @link https://rmrevin.ru
 */

namespace frontend\views\skins\apariencia_1;

/**
 * Class AssetBundle
 * @package rmrevin\yii\fontawesome
 */
class AssetBundle extends \yii\web\AssetBundle
{

    /**
     * @inherit
     */
    public $sourcePath = '@backend/views/skins/apariencia_1/nuevo/prueba/dist' ;

    /**
     * @inherit
     */
    public $css = [
        'css/fontawesome-all.css',
    ];

    /**
     * @inherit
     */
    public $publishOptions = [
        'only' => [
            "css/*",
            "webfonts/*",
        ],
        'except' => [
            "less",
            "scss",
        ],
    ];
}


