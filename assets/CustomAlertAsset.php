<?php
/**
 * Created by IntelliJ IDEA.
 * User: Jeanpaul Tossou
 * Date: 16/09/2018
 * Time: 15:02
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Custom alertasset bundle.
 *
 * @author Jeanpaul Tossou <tossoujenpaul641@gmail.com>
 * @version 1.0
 * @since 2.0
 */
class CustomAlertAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'T_assets/plugins/sweetalert/lib/sweet-alert.css',
    ];
    public $js = [
        'T_assets/plugins/sweetalert/lib/sweet-alert.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\AppAsset'
    ];
}
