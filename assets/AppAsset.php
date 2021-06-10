<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use app\models\Rbac;
use Yii;
use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/uikit.min.css',
        'css/theme2.css',
        'css/pace.theme.css',
        'css/toastr.min.css'
    ];
    public $js = [
        'js/uikit.min.js',
        'js/uikit-icons.min.js',
        'js/sweetalert2@10.js',
        'js/pace.min.js',
        'js/chat.js',
        'js/toastr.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
    public function init()
    {
        # Лучше конечно для админа создать свой Asset
        if (Yii::$app->user->can(Rbac::ROLE_ADMIN))
            array_push($this->js, 'js/admin.js');

        parent::init();
    }
}
