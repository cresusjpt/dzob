<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 26/09/2018
 * Time: 01:09
 */

namespace app\models;


class Tree extends \kartik\tree\models\Tree
{
    public static function tableName()
    {
        return 'tbl_tree';
    }
}