<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sys_log".
 *
 * @property int $ID_LOG
 * @property string $CODE_ACTION
 * @property int $ID_PERSONNE
 * @property int $IDENTIFIANT
 * @property string $DATE_LOG
 * @property string $TABLE_LOG
 * @property string $LIB_LOG
 *
 * @property Action $cODEACTION
 * @property Utilisateur $pERSONNE
 */
class SysLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CODE_ACTION', 'IDENTIFIANT', 'DATE_LOG', 'TABLE_LOG', 'LIB_LOG'], 'required'],
            [['ID_LOG', 'IDENTIFIANT'], 'integer'],
            [['DATE_LOG'], 'safe'],
            [['CODE_ACTION'], 'string', 'max' => 25],
            [['TABLE_LOG'], 'string', 'max' => 50],
            [['LIB_LOG'], 'string', 'max' => 5000],
            [['ID_LOG'], 'unique'],
            [['CODE_ACTION'], 'exist', 'skipOnError' => true, 'targetClass' => Action::className(), 'targetAttribute' => ['CODE_ACTION' => 'CODE_ACTION']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_LOG' => Yii::t('app', 'Id  Log'),
            'CODE_ACTION' => Yii::t('app', 'Action'),
            'ID_PERSONNE' => Yii::t('app', 'Identifiant Personne'),
            'IDENTIFIANT' => Yii::t('app', 'Nom de l\'Utilisateur'),
            'DATE_LOG' => Yii::t('app', 'Date Journal'),
            'TABLE_LOG' => Yii::t('app', 'Table Concernée'),
            'LIB_LOG' => Yii::t('app', 'Libelle Journal'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCODEACTION()
    {
        return $this->hasOne(Action::class, ['CODE_ACTION' => 'CODE_ACTION']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPERSONNE()
    {
        return $this->hasOne(Utilisateur::class, ['ID_PERSONNE' => 'ID_PERSONNE', 'IDENTIFIANT' => 'IDENTIFIANT']);
    }
}
