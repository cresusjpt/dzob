<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fonction_profil".
 *
 * @property string $CODE_PROFIL
 * @property int $ID_FONCT
 *
 * @property Fonctionnalite $fONCT
 * @property Profil $cODEPROFIL
 */
class FonctionProfil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fonction_profil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CODE_PROFIL', 'ID_FONCT'], 'required'],
            [['ID_FONCT'], 'integer'],
            [['CODE_PROFIL'], 'string', 'max' => 100],
            [['CODE_PROFIL', 'ID_FONCT'], 'unique', 'targetAttribute' => ['CODE_PROFIL', 'ID_FONCT']],
            [['ID_FONCT'], 'exist', 'skipOnError' => true, 'targetClass' => Fonctionnalite::className(), 'targetAttribute' => ['ID_FONCT' => 'ID_FONCT']],
            [['CODE_PROFIL'], 'exist', 'skipOnError' => true, 'targetClass' => Profil::className(), 'targetAttribute' => ['CODE_PROFIL' => 'CODE_PROFIL']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CODE_PROFIL' => Yii::t('app', 'Code  Profil'),
            'ID_FONCT' => Yii::t('app', 'Identifiant Fonctionnalité'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFONCT()
    {
        return $this->hasOne(Fonctionnalite::className(), ['ID_FONCT' => 'ID_FONCT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCODEPROFIL()
    {
        return $this->hasOne(Profil::className(), ['CODE_PROFIL' => 'CODE_PROFIL']);
    }
}
