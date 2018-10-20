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
 * Main application asset bundle.
 *
 * @author Jeanpaul Tossou <tossoujenpaul641@gmail.com>
 * @version 1.0
 * @since 2.0
 */
class FileAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

    ];
    public $js = [
        //file upload

        'T_assets/plugins/jQuery-File-Upload/js/vendor/jquery.ui.widget.js',
        'http://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js',
        'T_assets/plugins/javascript-Load-Image/js/load-image.all.min.js',
        'http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js',
        'http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js',
        'T_assets/plugins/jQuery-File-Upload/js/jquery.iframe-transport.js',
        'T_assets/plugins/jQuery-File-Upload/js/jquery.fileupload.js',
        'T_assets/plugins/jQuery-File-Upload/js/jquery.fileupload-process.js',
        'T_assets/plugins/jQuery-File-Upload/js/jquery.fileupload-image.js',
        'T_assets/plugins/jQuery-File-Upload/js/jquery.fileupload-audio.js',
        'T_assets/plugins/jQuery-File-Upload/js/jquery.fileupload-video.js',
        'T_assets/plugins/jQuery-File-Upload/js/jquery.fileupload-validate.js',
        'T_assets/plugins/jQuery-File-Upload/js/jquery.fileupload-ui.js',
        'T_assets/plugins/jQuery-File-Upload/js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\AppAsset'
    ];
}
