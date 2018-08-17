<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fonction_user".
 *
 * @property int $IDPERSONNE
 * @property int $IDENTIFIANT
 * @property int $ID_FONCT
 *
 * @property Fonctionnalite $fONCT
 * @property Utilisateur $pERSONNE
 */
class FonctionUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fonction_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IDPERSONNE', 'IDENTIFIANT', 'ID_FONCT'], 'required'],
            [['IDPERSONNE', 'IDENTIFIANT', 'ID_FONCT'], 'integer'],
            [['IDPERSONNE', 'IDENTIFIANT', 'ID_FONCT'], 'unique', 'targetAttribute' => ['IDPERSONNE', 'IDENTIFIANT', 'ID_FONCT']],
            [['ID_FONCT'], 'exist', 'skipOnError' => true, 'targetClass' => Fonctionnalite::className(), 'targetAttribute' => ['ID_FONCT' => 'ID_FONCT']],
            [['IDPERSONNE', 'IDENTIFIANT'], 'exist', 'skipOnError' => true, 'targetClass' => Utilisateur::className(), 'targetAttribute' => ['IDPERSONNE' => 'ID_PERSONNE', 'IDENTIFIANT' => 'IDENTIFIANT']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IDPERSONNE' => Yii::t('app', 'Identifiant Personne'),
            'IDENTIFIANT' => Yii::t('app', 'Identifiant Utilisateur'),
            'ID_FONCT' => Yii::t('app', 'Nom Fonctionnalité'),
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
    public function getPERSONNE()
    {
        return $this->hasOne(Utilisateur::className(), ['ID_PERSONNE' => 'IDPERSONNE', 'IDENTIFIANT' => 'IDENTIFIANT']);
    }
}
