<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

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
        //'css/site.css',
        'T_assets/plugins/bootstrap/css/bootstrap.min.css',
        'T_assets/plugins/font-awesome/css/font-awesome.min.css',
        'T_assets/plugins/iCheck/skins/all.css',
        'T_assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css',
        'T_assets/plugins/animate.css/animate.min.css',
        'http://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,200,100,800',

        /*CSS REQUIRED FOR SUBVIEW CONTENTS*/
        'T_assets/plugins/owl-carousel/owl-carousel/owl.carousel.css',
        'T_assets/plugins/owl-carousel/owl-carousel/owl.theme.css',
        'T_assets/plugins/owl-carousel/owl-carousel/owl.transitions.css',
        'T_assets/plugins/summernote/dist/summernote.css',
        'T_assets/plugins/fullcalendar/fullcalendar/fullcalendar.css',
        'T_assets/plugins/toastr/toastr.min.css',
        'T_assets/plugins/bootstrap-select/bootstrap-select.min.css',
        'T_assets/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
        'T_assets/plugins/DataTables/media/css/DT_bootstrap.css',
        'T_assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css',
        'T_assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css',

        /*CSS REQUIRED FOR THIS PAGE ONLY*/
        'T_assets/plugins/weather-icons/css/weather-icons.min.css',
        'T_assets/plugins/nvd3/nv.d3.min.css',
        'T_assets/plugins/jQuery-File-Upload/css/jquery.fileupload-ui.css',

        /*Tree view style*/
        'T_assets/plugins/jstree/dist/themes/default/style.css',

        /*CORE CSS*/
        'T_assets/css/styles.css',
        'T_assets/css/styles-responsive.css',
        'T_assets/css/plugins.css',
        ['T_assets/css/themes/theme-style5.css','type'=>'text/css','id'=>'skin_color'],
        ['T_assets/css/print.css','type'=>'text/css','media'=>'print'],
        ['T_assets/favicon.ico', 'rel' => 'shortcut icon'],
    ];
    public $js = [
        /*MAIN JAVASCRIPTS*/
        'T_assets/plugins/respond.min.js',
        'T_assets/plugins/excanvas.min.js',
        /*<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>*/
        'T_assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js',
        'T_assets/plugins/bootstrap/js/bootstrap.min.js',
        'T_assets/plugins/blockUI/jquery.blockUI.js',
        'T_assets/plugins/iCheck/jquery.icheck.min.js',
        'T_assets/plugins/moment/min/moment.min.js',
        'T_assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js',
        'T_assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js',
        'T_assets/plugins/bootbox/bootbox.min.js',
        'T_assets/plugins/jquery.scrollTo/jquery.scrollTo.min.js',
        'T_assets/plugins/ScrollToFixed/jquery-scrolltofixed-min.js',
        'T_assets/plugins/jquery.appear/jquery.appear.js',
        'T_assets/plugins/jquery-cookie/jquery.cookie.js',
        'T_assets/plugins/velocity/jquery.velocity.min.js',

        /*JAVASCRIPTS REQUIRED FOR SUBVIEW CONTENTS*/
        'T_assets/plugins/owl-carousel/owl-carousel/owl.carousel.js',
        'T_assets/plugins/jquery-mockjax/jquery.mockjax.js',
        'T_assets/plugins/toastr/toastr.js',
        'T_assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js',
        'T_assets/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js',
        'T_assets/plugins/bootstrap-select/bootstrap-select.min.js',
        'T_assets/plugins/jquery-validation/dist/jquery.validate.min.js',
        'T_assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js',
        'T_assets/plugins/DataTables/media/js/jquery.dataTables.min.js',
        'T_assets/plugins/DataTables/media/js/DT_bootstrap.js',
        'T_assets/plugins/truncate/jquery.truncate.js',
        'T_assets/plugins/summernote/dist/summernote.min.js',
        'T_assets/plugins/bootstrap-daterangepicker/daterangepicker.js',
        'T_assets/js/subview.js',
        'T_assets/js/subview-examples.js',

        /*JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY*/
        'T_assets/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js',
        'T_assets/plugins/nvd3/lib/d3.v3.js',
        'T_assets/plugins/nvd3/nv.d3.min.js',
        'T_assets/plugins/nvd3/src/models/historicalBar.js',
        'T_assets/plugins/nvd3/src/models/historicalBarChart.js',
        'T_assets/plugins/nvd3/src/models/stackedArea.js',
        'T_assets/plugins/nvd3/src/models/stackedAreaChart.js',
        'T_assets/plugins/jquery.sparkline/jquery.sparkline.js',
        'T_assets/plugins/easy-pie-chart/dist/jquery.easypiechart.min.js',
        'T_assets/js/index.js',
        'T_assets/plugins/jquery.pulsate/jquery.pulsate.min.js',
		'T_assets/js/pages-user-profile.js',

        //dfdfdfdf
        'T_assets/plugins/jstree/dist/jstree.min.js',
        'T_assets/js/ui-treeview.js',

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

        /*CORE JAVASCRIPTS*/
        'T_assets/js/main.js',

        /*ckeditor */
        'ckeditor/ckeditor/ckeditor.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
