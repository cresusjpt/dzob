<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "courrier".
 *
 * @property string $REFERNCE
 * @property int $ID_PERSONNE
 * @property int $ID_PRIORITE
 * @property int $ID_TYPECOURRIER
 * @property string $DATE
 * @property string $OBJET_COURRIER
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
            [['REFERNCE', 'ID_PERSONNE', 'ID_PRIORITE', 'ID_TYPECOURRIER', 'DATE', 'OBJET_COURRIER'], 'required'],
            [['ID_PERSONNE', 'ID_PRIORITE', 'ID_TYPECOURRIER'], 'integer'],
            [['DATE'], 'safe'],
            [['REFERNCE'], 'string', 'max' => 11],
            [['OBJET_COURRIER'], 'string', 'max' => 200],
            [['REFERNCE'], 'unique'],
            [['ID_PRIORITE'], 'exist', 'skipOnError' => true, 'targetClass' => PrioriteCourrier::className(), 'targetAttribute' => ['ID_PRIORITE' => 'ID_PRIORITE']],
            [['ID_PERSONNE'], 'exist', 'skipOnError' => true, 'targetClass' => Utilisateur::className(), 'targetAttribute' => ['ID_PERSONNE' => 'ID_PERSONNE']],
            [['ID_PERSONNE'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['ID_PERSONNE' => 'ID_PERSONNE']],
            [['ID_PERSONNE'], 'exist', 'skipOnError' => true, 'targetClass' => AyantDroit::className(), 'targetAttribute' => ['ID_PERSONNE' => 'ID_PERSONNE']],
            [['ID_TYPECOURRIER'], 'exist', 'skipOnError' => true, 'targetClass' => TypeCourrier::className(), 'targetAttribute' => ['ID_TYPECOURRIER' => 'ID_TYPECOURRIER']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'REFERNCE' => Yii::t('app', 'Refernce'),
            'ID_PERSONNE' => Yii::t('app', 'Id  Personne'),
            'ID_PRIORITE' => Yii::t('app', 'Id  Priorite'),
            'ID_TYPECOURRIER' => Yii::t('app', 'Id  Typecourrier'),
            'DATE' => Yii::t('app', 'Date'),
            'OBJET_COURRIER' => Yii::t('app', 'Objet  Courrier'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPRIORITE()
    {
        return $this->hasOne(PrioriteCourrier::className(), ['ID_PRIORITE' => 'ID_PRIORITE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPERSONNE()
    {
        return $this->hasOne(Utilisateur::className(), ['ID_PERSONNE' => 'ID_PERSONNE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPERSONNE0()
    {
        return $this->hasOne(Client::className(), ['ID_PERSONNE' => 'ID_PERSONNE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPERSONNE1()
    {
        return $this->hasOne(AyantDroit::className(), ['ID_PERSONNE' => 'ID_PERSONNE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTYPECOURRIER()
    {
        return $this->hasOne(TypeCourrier::className(), ['ID_TYPECOURRIER' => 'ID_TYPECOURRIER']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFichiers()
    {
        return $this->hasMany(Fichier::className(), ['REFERNCE' => 'REFERNCE']);
    }
}
