<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property int $ID_PERSONNE
 * @property int $ID_CLIENT
 * @property string $NOM
 * @property string $PRENOM
 * @property string $SEXE
 * @property string $TELEPHONE
 * @property string $ADRESSE
 * @property string $DATE_NAISSANCE
 *
 * @property Courrier[] $courriers
 * @property Dossier[] $dossiers
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_PERSONNE', 'ID_CLIENT'], 'required'],
            [['ID_PERSONNE', 'ID_CLIENT'], 'integer'],
            [['DATE_NAISSANCE'], 'safe'],
            [['NOM'], 'string', 'max' => 50],
            [['PRENOM'], 'string', 'max' => 100],
            [['SEXE'], 'string', 'max' => 1],
            [['TELEPHONE'], 'string', 'max' => 10],
            [['ADRESSE'], 'string', 'max' => 200],
            [['ID_PERSONNE', 'ID_CLIENT'], 'unique', 'targetAttribute' => ['ID_PERSONNE', 'ID_CLIENT']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_PERSONNE' => Yii::t('app', 'Id  Personne'),
            'ID_CLIENT' => Yii::t('app', 'Id  Client'),
            'NOM' => Yii::t('app', 'Nom'),
            'PRENOM' => Yii::t('app', 'Prenom'),
            'SEXE' => Yii::t('app', 'Sexe'),
            'TELEPHONE' => Yii::t('app', 'Telephone'),
            'ADRESSE' => Yii::t('app', 'Adresse'),
            'DATE_NAISSANCE' => Yii::t('app', 'Date  Naissance'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourriers()
    {
        return $this->hasMany(Courrier::className(), ['ID_PERSONNE' => 'ID_PERSONNE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDossiers()
    {
        return $this->hasMany(Dossier::className(), ['ID_PERSONNE' => 'ID_PERSONNE', 'ID_CLIENT' => 'ID_CLIENT']);
    }
}
