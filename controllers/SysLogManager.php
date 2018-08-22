<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 22/08/2018
 * Time: 01:12
 */

namespace app\controllers;


use app\models\SysLog;
use Yii;


/**
 * Class SysLogManager
 * @package app\controllers
 */
class SysLogManager
{
    private $_user = null;

    /**
     * SysLogManager constructor.
     */
    public function __construct()
    {
        $this->_user = Yii::$app->user->identity;
    }

    public function inputLog($action, $table, $model)
    {
        $mo = get_object_vars($model);
        print_r($mo);
        $lib = $this->writeLibLog($mo);
        $syslog = new SysLog();
        $syslog->CODE_ACTION = $action;
        $syslog->IDENTIFIANT = $this->_user->IDENTIFIANT;
        $syslog->DATE_LOG = date('yyyy-mm-dd hh-mm-ss');
        $syslog->TABLE_LOG = $table;
        $syslog->LIB_LOG = $lib;
        $syslog->save(false);
        //var_dump($model);
        //var_dump($this->_user);
        //die();
    }

    private function writeLibLog($model)
    {
        var_dump($model);
        $lib = '';
        if (!is_null($model)){
            foreach ($model as $item => $value) {
                $lib = '::' . strtoupper($item) . ' = ' .$value.' ';
            }
        }
        var_dump($lib);
        die();
        return $lib;
    }
}