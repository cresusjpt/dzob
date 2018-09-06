<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_profil".
 *
 * @property string $CODE_PROFIL
 * @property int $ID_PERSONNE
 * @property int $IDENTIFIANT
 *
 * @property Utilisateur $pERSONNE
 * @property Profil $cODEPROFIL
 */
class UserProfil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_profil';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CODE_PROFIL', 'ID_PERSONNE', 'IDENTIFIANT'], 'required'],
            [['ID_PERSONNE', 'IDENTIFIANT'], 'integer'],
            [['CODE_PROFIL'], 'string', 'max' => 100],
            [['CODE_PROFIL', 'ID_PERSONNE', 'IDENTIFIANT'], 'unique', 'targetAttribute' => ['CODE_PROFIL', 'ID_PERSONNE', 'IDENTIFIANT']],
            [['ID_PERSONNE', 'IDENTIFIANT'], 'exist', 'skipOnError' => true, 'targetClass' => Utilisateur::class, 'targetAttribute' => ['ID_PERSONNE' => 'ID_PERSONNE', 'IDENTIFIANT' => 'IDENTIFIANT']],
            [['CODE_PROFIL'], 'exist', 'skipOnError' => true, 'targetClass' => Profil::class, 'targetAttribute' => ['CODE_PROFIL' => 'CODE_PROFIL']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CODE_PROFIL' => Yii::t('app', 'Code  Profil'),
            'ID_PERSONNE' => Yii::t('app', 'Personne'),
            'IDENTIFIANT' => Yii::t('app', 'Identifiant'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPERSONNE()
    {
        return $this->hasOne(Utilisateur::className(), ['ID_PERSONNE' => 'ID_PERSONNE', 'IDENTIFIANT' => 'IDENTIFIANT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCODEPROFIL()
    {
        return $this->hasOne(Profil::className(), ['CODE_PROFIL' => 'CODE_PROFIL']);
    }

    /**
     * {@inheritdoc}
     * @return UserProfilQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserProfilQuery(get_called_class());
    }
}
