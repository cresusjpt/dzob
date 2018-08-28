<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "courrier".
 *
 * @property string $REFERENCE
 * @property int $ID_PERSONNE
 * @property int $ID_PRIORITE
 * @property int $ID_TYPECOURRIER
 * @property string $DATE
 * @property string $OBJET_COURRIER
 * @property string $CONTENU_COURRIER
 * @property string $ACTEUR_COURRIER
 *
 * @property PrioriteCourrier $pRIORITE
 * @property Utilisateur $pERSONNE
 * @property Client $pERSONNE0
 * @property AyantDroit $pERSONNE1
 * @property TypeCourrier $tYPECOURRIER
 * @property Fichier[] $fichiers
 */
class Courrier extends \yii\db\ActiveRecord
{
    private $_displayName;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'courrier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['REFERENCE', 'ACTEUR_COURRIER', 'ID_PRIORITE', 'ID_TYPECOURRIER', 'DATE', 'OBJET_COURRIER'], 'required'],
            [['ID_PERSONNE', 'ID_PRIORITE', 'ID_TYPECOURRIER'], 'integer'],
            [['DATE'], 'safe'],
            [['REFERENCE'], 'string', 'max' => 11],
            [['ACTEUR_COURRIER'], 'string', 'max' => 250],
            [['OBJET_COURRIER'], 'string', 'max' => 200],
            [['CONTENU_COURRIER'], 'string'],
            [['REFERENCE'], 'unique'],
            [['ID_PRIORITE'], 'exist', 'skipOnError' => true, 'targetClass' => PrioriteCourrier::class, 'targetAttribute' => ['ID_PRIORITE' => 'ID_PRIORITE']],
            [['ID_PERSONNE'], 'exist', 'skipOnError' => true, 'targetClass' => Utilisateur::class, 'targetAttribute' => ['ID_PERSONNE' => 'ID_PERSONNE']],
            [['ID_PERSONNE'], 'exist', 'skipOnError' => true, 'targetClass' => Client::class, 'targetAttribute' => ['ID_PERSONNE' => 'ID_PERSONNE']],
            [['ID_PERSONNE'], 'exist', 'skipOnError' => true, 'targetClass' => AyantDroit::class, 'targetAttribute' => ['ID_PERSONNE' => 'ID_PERSONNE']],
            [['ID_TYPECOURRIER'], 'exist', 'skipOnError' => true, 'targetClass' => TypeCourrier::class, 'targetAttribute' => ['ID_TYPECOURRIER' => 'ID_TYPECOURRIER']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'REFERENCE' => Yii::t('app', 'Reference'),
            'ACTEUR_COURRIER' => Yii::t('app', 'Acteur'),
            'CONTENU_COURRIER' => Yii::t('app', 'Contenu du courrier'),
            'ID_PERSONNE' => Yii::t('app', 'Personne'),
            'ID_PRIORITE' => Yii::t('app', 'Priorite'),
            'ID_TYPECOURRIER' => Yii::t('app', 'Type courrier'),
            'DATE' => Yii::t('app', 'Date'),
            'OBJET_COURRIER' => Yii::t('app', 'Objet  Courrier'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPRIORITE()
    {
        return $this->hasOne(PrioriteCourrier::class, ['ID_PRIORITE' => 'ID_PRIORITE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPERSONNE()
    {
        return $this->hasOne(Utilisateur::class, ['ID_PERSONNE' => 'ID_PERSONNE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPERSONNE0()
    {
        return $this->hasOne(Client::class, ['ID_PERSONNE' => 'ID_PERSONNE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPERSONNE1()
    {
        return $this->hasOne(AyantDroit::class, ['ID_PERSONNE' => 'ID_PERSONNE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTYPECOURRIER()
    {
        return $this->hasOne(TypeCourrier::class, ['ID_TYPECOURRIER' => 'ID_TYPECOURRIER']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFichiers()
    {
        return $this->hasMany(Fichier::class, ['REFERENCE' => 'REFERENCE']);
    }

    public function getDisplayName()
    {
        return $this->REFERENCE.'/'.$this->ACTEUR_COURRIER.'/'.$this->DATE;
    }
}
