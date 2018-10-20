<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gr_usager".
 *
 * @property int $ID_DROITS
 * @property int $ID_PERSONNE
 * @property int $IDENTIFIANT
 * @property int $ID_DOSSIER
 * @property string $GR_LIBELLE
 * @property string $GR_DESCRIPTION
 *
 * @property Dossier $dOSSIER
 * @property Droits $dROITS
 * @property Utilisateur $pERSONNE
 */
class GrUsager extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gr_usager';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_DROITS', 'ID_PERSONNE', 'IDENTIFIANT', 'ID_DOSSIER', 'GR_LIBELLE'], 'required'],
            [['ID_DROITS', 'ID_PERSONNE', 'IDENTIFIANT', 'ID_DOSSIER'], 'integer'],
            [['GR_LIBELLE'], 'string', 'max' => 50],
            [['GR_DESCRIPTION'], 'string', 'max' => 500],
            [['ID_DROITS', 'ID_PERSONNE', 'IDENTIFIANT', 'ID_DOSSIER'], 'unique', 'targetAttribute' => ['ID_DROITS', 'ID_PERSONNE', 'IDENTIFIANT', 'ID_DOSSIER']],
            [['ID_DOSSIER'], 'exist', 'skipOnError' => true, 'targetClass' => Dossier::class, 'targetAttribute' => ['ID_DOSSIER' => 'ID_DOSSIER']],
            [['ID_DROITS'], 'exist', 'skipOnError' => true, 'targetClass' => Droits::class, 'targetAttribute' => ['ID_DROITS' => 'ID_DROITS']],
            [['ID_PERSONNE', 'IDENTIFIANT'], 'exist', 'skipOnError' => true, 'targetClass' => Utilisateur::class, 'targetAttribute' => ['ID_PERSONNE' => 'ID_PERSONNE', 'IDENTIFIANT' => 'IDENTIFIANT']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_DROITS' => Yii::t('app', 'Droits'),
            'ID_PERSONNE' => Yii::t('app', 'Personne'),
            'IDENTIFIANT' => Yii::t('app', 'Identifiant'),
            'ID_DOSSIER' => Yii::t('app', 'Dossier'),
            'GR_LIBELLE' => Yii::t('app', 'Libelle Groupe'),
            'GR_DESCRIPTION' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOSSIER()
    {
        return $this->hasOne(Dossier::class, ['ID_DOSSIER' => 'ID_DOSSIER']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDROITS()
    {
        return $this->hasOne(Droits::class, ['ID_DROITS' => 'ID_DROITS']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPERSONNE()
    {
        return $this->hasOne(Utilisateur::class, ['ID_PERSONNE' => 'ID_PERSONNE', 'IDENTIFIANT' => 'IDENTIFIANT']);
    }

    /**
     * {@inheritdoc}
     * @return GrUsagerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GrUsagerQuery(get_called_class());
    }
}
