<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ayant_droit".
 *
 * @property int $ID_PERSONNE
 * @property int $ID_AYANTDROIT
 * @property string $NOM
 * @property string $PRENOM
 * @property string $SEXE
 * @property string $TELEPHONE
 * @property string $ADRESSE
 * @property string $DATE_NAISSANCE
 *
 * @property Avoir[] $avoirs
 * @property Immobilier[] $rEFERENCEPATRIMOINEs
 * @property Mobilier[] $rEFERENCEPATRIMOINEs0
 * @property Courrier[] $courriers
 * @property Immobilier[] $immobiliers
 * @property Mobilier[] $mobiliers
 */
class AyantDroit extends \yii\db\ActiveRecord
{
    public $_civilite;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ayant_droit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NOM','SEXE', 'PRENOM','DATE_NAISSANCE'], 'required'],
            [['ID_PERSONNE', 'ID_AYANTDROIT'], 'integer'],
            [['DATE_NAISSANCE'], 'safe'],
            [['NOM'], 'string', 'max' => 50],
            [['PRENOM'], 'string', 'max' => 100],
            [['SEXE'], 'string', 'max' => 1],
            [['TELEPHONE'], 'string', 'max' => 10],
            [['ADRESSE'], 'string', 'max' => 200],
            [['ID_PERSONNE', 'ID_AYANTDROIT'], 'unique', 'targetAttribute' => ['ID_PERSONNE', 'ID_AYANTDROIT']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_PERSONNE' => Yii::t('app', 'Id  Personne'),
            'ID_AYANTDROIT' => Yii::t('app', 'Id  Ayantdroit'),
            'NOM' => Yii::t('app', 'Nom'),
            'PRENOM' => Yii::t('app', 'Prenom'),
            'SEXE' => Yii::t('app', 'Sexe'),
            'TELEPHONE' => Yii::t('app', 'Telephone'),
            'ADRESSE' => Yii::t('app', 'Adresse'),
            'DATE_NAISSANCE' => Yii::t('app', 'Date de Naissance'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvoirs()
    {
        return $this->hasMany(Avoir::className(), ['ID_PERSONNE' => 'ID_PERSONNE', 'ID_AYANTDROIT' => 'ID_AYANTDROIT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getREFERENCEPATRIMOINEs()
    {
        return $this->hasMany(Immobilier::class, ['REFERENCE_PATRIMOINE' => 'REFERENCE_PATRIMOINE'])->viaTable('avoir', ['ID_PERSONNE' => 'ID_PERSONNE', 'ID_AYANTDROIT' => 'ID_AYANTDROIT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getREFERENCEPATRIMOINEs0()
    {
        return $this->hasMany(Mobilier::class, ['REFERENCE_PATRIMOINE' => 'REFERENCE_PATRIMOINE'])->viaTable('avoir', ['ID_PERSONNE' => 'ID_PERSONNE', 'ID_AYANTDROIT' => 'ID_AYANTDROIT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourriers()
    {
        return $this->hasMany(Courrier::class, ['ID_PERSONNE' => 'ID_PERSONNE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImmobiliers()
    {
        return $this->hasMany(Immobilier::class, ['ID_PERSONNE' => 'ID_PERSONNE', 'ID_AYANTDROIT' => 'ID_AYANTDROIT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMobiliers()
    {
        return $this->hasMany(Mobilier::class, ['ID_PERSONNE' => 'ID_PERSONNE', 'ID_AYANTDROIT' => 'ID_AYANTDROIT']);
    }

    /**
     * @return string
     */
    public function getSexe()
    {
        $sexe = '';
        if ($this->SEXE =='M'){
            $sexe = 'Masculin';
        }else if ($this->SEXE == 'F'){
            $sexe = 'Feminin';
        }
        return $sexe;
    }

    /**
     * @return mixed
     */
    public function getCivilite()
    {
        return $this->NOM.' '.$this->PRENOM;
    }


}
