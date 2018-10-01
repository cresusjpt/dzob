<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 16/09/2018
 * Time: 15:02
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Tree view page asset bundle.
 *
 * @author Jeanpaul Tossou <tossoujenpaul641@gmail.com>
 * @version 1.0
 * @since 2.0
 */
class TreeViewAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'T_assets/plugins/jstree/dist/themes/default/style.css',
    ];
    public $js = [
        'T_assets/plugins/jstree/dist/jstree.min.js',
        'T_assets/js/ui-treeview.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\AppAsset'
    ];
}
