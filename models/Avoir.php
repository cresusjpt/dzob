<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "avoir".
 *
 * @property int $ID_PERSONNE
 * @property int $ID_AYANTDROIT
 * @property string $REFERENCE_PATRIMOINE
 *
 * @property Immobilier $rEFERENCEPATRIMOINE
 * @property AyantDroit $pERSONNE
 * @property Mobilier $rEFERENCEPATRIMOINE0
 */
class Avoir extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'avoir';
    }

    /**
     * {@inheritdoc}
     * @return AvoirQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AvoirQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID_PERSONNE', 'ID_AYANTDROIT', 'REFERENCE_PATRIMOINE'], 'required'],
            [['ID_PERSONNE', 'ID_AYANTDROIT'], 'integer'],
            [['REFERENCE_PATRIMOINE'], 'string', 'max' => 10],
            [['ID_PERSONNE', 'ID_AYANTDROIT', 'REFERENCE_PATRIMOINE'], 'unique', 'targetAttribute' => ['ID_PERSONNE', 'ID_AYANTDROIT', 'REFERENCE_PATRIMOINE']],
            [['ID_PERSONNE', 'ID_AYANTDROIT'], 'exist', 'skipOnError' => true, 'targetClass' => AyantDroit::class, 'targetAttribute' => ['ID_PERSONNE' => 'ID_PERSONNE', 'ID_AYANTDROIT' => 'ID_AYANTDROIT']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_PERSONNE' => Yii::t('app', 'Personne'),
            'ID_AYANTDROIT' => Yii::t('app', 'Ayantdroit'),
            'REFERENCE_PATRIMOINE' => Yii::t('app', 'Reference Patrimoine'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getREFERENCEPATRIMOINE()
    {
        return $this->hasOne(Immobilier::className(), ['REFERENCE_PATRIMOINE' => 'REFERENCE_PATRIMOINE']);
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
    public function getREFERENCEPATRIMOINE0()
    {
        return $this->hasOne(Mobilier::className(), ['REFERENCE_PATRIMOINE' => 'REFERENCE_PATRIMOINE']);
    }

    public function getNomEtPrenom()
    {
        $info = AyantDroit::findOne(['ID_AYANTDROIT' => $this->ID_AYANTDROIT]);
        return $info->PRENOM . ' ' . $info->NOM;
    }

    public function getNomPatrimoine()
    {
        $pat = Patrimoine::findOne(['REFERENCE_PATRIMOINE' => $this->REFERENCE_PATRIMOINE]);
        return $pat->NOM_PATRIMOINE;
    }
}
