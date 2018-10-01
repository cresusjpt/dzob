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
 * Export page asset bundle.
 *
 * @author Jeanpaul Tossou <tossoujenpaul641@gmail.com>
 * @version 1.0
 * @since 2.0
 */
class ExportAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'T_assets/plugins/tableExport/tableExport.js',
        'T_assets/plugins/tableExport/jquery.base64.js',
        'T_assets/plugins/tableExport/html2canvas.js',
        'T_assets/plugins/tableExport/jquery.base64.js',
        'T_assets/plugins/tableExport/jspdf/libs/sprintf.js',
        'T_assets/plugins/tableExport/jspdf/jspdf.js',
        'T_assets/plugins/tableExport/jspdf/libs/base64.js',
        'T_assets/js/table-export.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\AppAsset'
    ];
}