<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sys_param".
 *
 * @property string $PARAM_CODE
 * @property string $PARAM_VALUE
 * @property string $PARAM_DESC
 */
class SysParam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_param';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PARAM_CODE', 'PARAM_VALUE', 'PARAM_DESC'], 'required'],
            [['PARAM_CODE'], 'string', 'max' => 50],
            [['PARAM_VALUE'], 'string', 'max' => 600],
            [['PARAM_DESC'], 'string', 'max' => 1500],
            [['PARAM_CODE'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PARAM_CODE' => Yii::t('app', 'Param  Code'),
            'PARAM_VALUE' => Yii::t('app', 'Valeur paramètre'),
            'PARAM_DESC' => Yii::t('app', 'Description Paramètre'),
        ];
    }
}
