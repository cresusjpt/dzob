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
            [['ID_LOG', 'CODE_ACTION', 'ID_PERSONNE', 'IDENTIFIANT', 'DATE_LOG', 'TABLE_LOG', 'LIB_LOG'], 'required'],
            [['ID_LOG', 'ID_PERSONNE', 'IDENTIFIANT'], 'integer'],
            [['DATE_LOG'], 'safe'],
            [['CODE_ACTION'], 'string', 'max' => 25],
            [['TABLE_LOG', 'LIB_LOG'], 'string', 'max' => 50],
            [['ID_LOG'], 'unique'],
            [['CODE_ACTION'], 'exist', 'skipOnError' => true, 'targetClass' => Action::className(), 'targetAttribute' => ['CODE_ACTION' => 'CODE_ACTION']],
            [['ID_PERSONNE', 'IDENTIFIANT'], 'exist', 'skipOnError' => true, 'targetClass' => Utilisateur::className(), 'targetAttribute' => ['ID_PERSONNE' => 'ID_PERSONNE', 'IDENTIFIANT' => 'IDENTIFIANT']],
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
            'ID_PERSONNE' => Yii::t('app', 'Id  Personne'),
            'IDENTIFIANT' => Yii::t('app', 'Nom de l\'Utilisateur'),
            'DATE_LOG' => Yii::t('app', 'Date Journal'),
            'TABLE_LOG' => Yii::t('app', 'Table Concerné'),
            'LIB_LOG' => Yii::t('app', 'Libelle Journal'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCODEACTION()
    {
        return $this->hasOne(Action::className(), ['CODE_ACTION' => 'CODE_ACTION']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPERSONNE()
    {
        return $this->hasOne(Utilisateur::className(), ['ID_PERSONNE' => 'ID_PERSONNE', 'IDENTIFIANT' => 'IDENTIFIANT']);
    }
}
