<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "immobilier".
 *
 * @property string $REFERENCE_PATRIMOINE
 * @property int $ID_IMMOBILIER
 * @property int $ID_PERSONNE
 * @property int $ID_AYANTDROIT
 * @property string $DESCRIPTION_IMMO
 * @property string $ADRESSE
 * @property string $LATITUDE
 * @property string $LONGITUDE
 *
 * @property Avoir[] $avoirs
 * @property AyantDroit[] $pERSONNEs
 * @property Evenement[] $evenements
 * @property Finance[] $finances
 * @property AyantDroit $pERSONNE
 * @property Valeur[] $valeurs
 */
class Immobilier extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'immobilier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['REFERENCE_PATRIMOINE', 'DESCRIPTION_IMMO', 'ADRESSE'], 'required'],
            [['ID_IMMOBILIER', 'ID_PERSONNE', 'ID_AYANTDROIT'], 'integer'],
            [['LATITUDE', 'LONGITUDE'], 'number'],
            [['file'], 'file'],
            [['REFERENCE_PATRIMOINE'], 'string', 'max' => 10],
            [['DESCRIPTION_IMMO'], 'string', 'max' => 250],
            [['RESSOURCE'], 'string', 'max' => 250],
            [['ADRESSE'], 'string', 'max' => 200],
            [['REFERENCE_PATRIMOINE', 'ID_IMMOBILIER'], 'unique', 'targetAttribute' => ['REFERENCE_PATRIMOINE', 'ID_IMMOBILIER']],
            [['ID_PERSONNE', 'ID_AYANTDROIT'], 'exist', 'skipOnError' => true, 'targetClass' => AyantDroit::class, 'targetAttribute' => ['ID_PERSONNE' => 'ID_PERSONNE', 'ID_AYANTDROIT' => 'ID_AYANTDROIT']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'REFERENCE_PATRIMOINE' => Yii::t('app', 'Reference Patrimoine'),
            'ID_IMMOBILIER' => Yii::t('app', 'Immobilier'),
            'ID_PERSONNE' => Yii::t('app', 'Personne'),
            'ID_AYANTDROIT' => Yii::t('app', 'Responsable Immobilier'),
            'DESCRIPTION_IMMO' => Yii::t('app', 'Description Immobiler'),
            'ADRESSE' => Yii::t('app', 'Adresse'),
            'LATITUDE' => Yii::t('app', 'Latitude'),
            'LONGITUDE' => Yii::t('app', 'Longitude'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvoirs()
    {
        return $this->hasMany(Avoir::class, ['REFERENCE_PATRIMOINE' => 'REFERENCE_PATRIMOINE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPERSONNEs()
    {
        return $this->hasMany(AyantDroit::class, ['ID_PERSONNE' => 'ID_PERSONNE', 'ID_AYANTDROIT' => 'ID_AYANTDROIT'])->viaTable('avoir', ['REFERENCE_PATRIMOINE' => 'REFERENCE_PATRIMOINE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvenements()
    {
        return $this->hasMany(Evenement::class, ['REFERENCE_PATRIMOINE' => 'REFERENCE_PATRIMOINE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinances()
    {
        return $this->hasMany(Finance::class, ['REFERENCE_PATRIMOINE' => 'REFERENCE_PATRIMOINE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPERSONNE()
    {
        return $this->hasOne(AyantDroit::class, ['ID_PERSONNE' => 'ID_PERSONNE', 'ID_AYANTDROIT' => 'ID_AYANTDROIT']);
    }

    public function getImage()
    {
        if (!empty($this->RESSOURCE) && $this->RESSOURCE != 'NON') {
            return 'OUI';
        }
        return 'NON';
    }

    public function getResponsable()
    {

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValeurs()
    {
        return $this->hasMany(Valeur::class, ['REFERENCE_PATRIMOINE' => 'REFERENCE_PATRIMOINE']);
    }
}
