<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 13/08/2018
 * Time: 02:13
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Login page asset bundle.
 *
 * @author Jeanpaul Tossou <tossoujeanpaul641@gmail.com>
 * @since 2.0
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'T_assets/plugins/bootstrap/css/bootstrap.min.css',
        'T_assets/css/styles.css',
        'T_assets/plugins/animate.css/animate.min.css',
        'T_assets/plugins/font-awesome/css/font-awesome.min.css',
        'T_assets/plugins/iCheck/skins/all.css',
        'T_assets/css/styles-responsive.css',
        'T_assets/plugins/font-awesome/css/font-awesome-ie7.min.css',
        ['T_assets/favicon.ico', 'rel' => 'shortcut icon'],
    ];

    public $js = [

        'T_assets/plugins/jquery-validation/dist/jquery.validate.min.js',
        'T_assets/plugins/iCheck/jquery.icheck.min.js',
        'T_assets/js/main.js',
        'T_assets/js/login.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
