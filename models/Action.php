<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "action".
 *
 * @property string $CODE_ACTION
 * @property string $LIB_ACTION
 *
 * @property SysLog[] $sysLogs
 */
class Action extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'action';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CODE_ACTION', 'LIB_ACTION'], 'required'],
            [['CODE_ACTION'], 'string', 'max' => 25],
            [['LIB_ACTION'], 'string', 'max' => 100],
            [['CODE_ACTION'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CODE_ACTION' => Yii::t('app', 'Code  Action'),
            'LIB_ACTION' => Yii::t('app', 'Libelle  Action'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysLogs()
    {
        return $this->hasMany(SysLog::className(), ['CODE_ACTION' => 'CODE_ACTION']);
    }
}
