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
class DossierAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

    ];
    public $js = [
        'T_assets/plugins/jQuery-Smart-Wizard/js/jquery.smartWizard.js',
        'T_assets/js/form-wizard.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\AppAsset'
    ];
}
