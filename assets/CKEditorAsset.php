<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 14/10/2018
 * Time: 15:50
 */

namespace app\assets;


use yii\web\AssetBundle;

class CKEditorAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

    ];
    public $js = [
        /*ckeditor Asset */
        'ckeditor/ckeditor/ckeditor.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\AppAsset'
    ];
}