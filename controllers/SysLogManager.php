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
        $lib = $this->writeLibLog($model);
        $syslog = new SysLog();
        $syslog->CODE_ACTION = $action;
        $syslog->IDENTIFIANT = $this->_user->IDENTIFIANT;
        $syslog->DATE_LOG = date('Y-m-d H:i:s');
        $syslog->TABLE_LOG = $table;
        $syslog->LIB_LOG = $lib;
        $syslog->save();
    }

    private function writeLibLog($model)
    {
        $lib = '';
        if (!is_null($model)){
            foreach ($model as $item => $value) {
                $lib .= '::' . strtoupper($item) . ' = ' .$value.' ';
            }
        }
        //var_dump($lib);
        return $lib;
    }
}