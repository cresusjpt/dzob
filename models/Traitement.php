<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "traitement".
 *
 * @property int $ID_DOSSIER
 * @property int $ID_LT
 * @property int $ID_TRAITEMENT
 * @property int $ETAT_TRAITEMENT
 * @property string $COMMENTAIRE_TRAITEMENT
 * @property string $DATE_DEBUT
 * @property string $DATE_FIN
 * @property string $DATE_PREVUE
 *
 * @property Dossier $dOSSIER
 * @property LivreTraitement $lT
 */
class Traitement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'traitement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           [['ID_LT', 'ETAT_TRAITEMENT', 'DATE_DEBUT', 'DATE_PREVUE'], 'required'],
           [['ID_DOSSIER', 'ID_LT', 'ETAT_TRAITEMENT'], 'integer'],
           [['COMMENTAIRE_TRAITEMENT'], 'string'],
           [['DATE_DEBUT', 'DATE_FIN', 'DATE_PREVUE'], 'safe'],
           [['ID_DOSSIER'], 'exist', 'skipOnError' => true, 'targetClass' => Dossier::class, 'targetAttribute' => ['ID_DOSSIER' => 'ID_DOSSIER']],
           [['ID_LT'], 'exist', 'skipOnError' => true, 'targetClass' => LivreTraitement::class, 'targetAttribute' => ['ID_LT' => 'ID_LT']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_DOSSIER' => Yii::t('app', 'Dossier'),
            'ID_LT' => Yii::t('app', 'Livre Traitements'),
            'ID_TRAITEMENT' => Yii::t('app', 'Traitement'),
            'ETAT_TRAITEMENT' => Yii::t('app', 'Etat du Traitement'),
            'COMMENTAIRE_TRAITEMENT' => Yii::t('app', 'Commentaire du Traitement'),
            'DATE_DEBUT' => Yii::t('app', 'Date de Debut'),
            'DATE_FIN' => Yii::t('app', 'Date de Fin'),
            'DATE_PREVUE' => Yii::t('app', 'Date Prevue de fin'),
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
    public function getLT()
    {
        return $this->hasOne(LivreTraitement::class, ['ID_LT' => 'ID_LT']);
    }

    /**
     * {@inheritdoc}
     * @return TraitementQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TraitementQuery(get_called_class());
    }
}
