<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mobilier".
 *
 * @property string $REFERENCE_PATRIMOINE
 * @property int $ID_MOBILIER
 * @property int $ID_PERSONNE
 * @property int $ID_AYANTDROIT
 * @property string $DESCRIPTION_MO
 *
 * @property Avoir[] $avoirs
 * @property AyantDroit[] $pERSONNEs
 * @property Evenement[] $evenements
 * @property Finance[] $finances
 * @property AyantDroit $pERSONNE
 * @property Valeur[] $valeurs
 */
class Mobilier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mobilier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['REFERENCE_PATRIMOINE','ID_PERSONNE','ID_AYANTDROIT'], 'required'],
            [['ID_MOBILIER', 'ID_PERSONNE', 'ID_AYANTDROIT'], 'integer'],
            [['REFERENCE_PATRIMOINE'], 'string', 'max' => 10],
            [['DESCRIPTION_MO'], 'string', 'max' => 150],
            [['REFERENCE_PATRIMOINE', 'ID_MOBILIER'], 'unique', 'targetAttribute' => ['REFERENCE_PATRIMOINE', 'ID_MOBILIER']],
            [['ID_PERSONNE', 'ID_AYANTDROIT'], 'exist', 'skipOnError' => true, 'targetClass' => AyantDroit::className(), 'targetAttribute' => ['ID_PERSONNE' => 'ID_PERSONNE', 'ID_AYANTDROIT' => 'ID_AYANTDROIT']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'REFERENCE_PATRIMOINE' => Yii::t('app', 'Reference  Patrimoine'),
            'ID_MOBILIER' => Yii::t('app', 'Id  Mobilier'),
            'ID_PERSONNE' => Yii::t('app', 'Id  Personne'),
            'ID_AYANTDROIT' => Yii::t('app', 'Responsable'),
            'DESCRIPTION_MO' => Yii::t('app', 'Description  Mo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvoirs()
    {
        return $this->hasMany(Avoir::className(), ['REFERENCE_PATRIMOINE' => 'REFERENCE_PATRIMOINE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPERSONNEs()
    {
        return $this->hasMany(AyantDroit::className(), ['ID_PERSONNE' => 'ID_PERSONNE', 'ID_AYANTDROIT' => 'ID_AYANTDROIT'])->viaTable('avoir', ['REFERENCE_PATRIMOINE' => 'REFERENCE_PATRIMOINE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvenements()
    {
        return $this->hasMany(Evenement::className(), ['REFERENCE_PATRIMOINE' => 'REFERENCE_PATRIMOINE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinances()
    {
        return $this->hasMany(Finance::className(), ['REFERENCE_PATRIMOINE' => 'REFERENCE_PATRIMOINE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPERSONNE()
    {
        return $this->hasOne(AyantDroit::className(), ['ID_PERSONNE' => 'ID_PERSONNE', 'ID_AYANTDROIT' => 'ID_AYANTDROIT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValeurs()
    {
        return $this->hasMany(Valeur::className(), ['REFERENCE_PATRIMOINE' => 'REFERENCE_PATRIMOINE']);
    }
}
