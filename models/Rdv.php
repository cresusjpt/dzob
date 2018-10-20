<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rdv".
 *
 * @property int $ID_RDV
 * @property string $NOM
 * @property string $TEL
 * @property string $OBJET
 * @property string $NOTAIRE
 * @property string $DATE_PRISE
 * @property string $DATE_RDV
 */
class Rdv extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rdv';
    }

    /**
     * {@inheritdoc}
     * @return RdvQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RdvQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NOM', 'TEL', 'OBJET', 'NOTAIRE', 'DATE_PRISE', 'DATE_RDV'], 'required'],
            [['OBJET'], 'string'],
            [['DATE_RDV'], 'unique'],
            [['DATE_PRISE', 'DATE_RDV'], 'safe'],
            [['NOM', 'NOTAIRE'], 'string', 'max' => 255],
            [['TEL'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_RDV' => Yii::t('app', 'Id  Rdv'),
            'NOM' => Yii::t('app', 'Nom et prénom'),
            'TEL' => Yii::t('app', 'Téléphone'),
            'OBJET' => Yii::t('app', 'Objet'),
            'NOTAIRE' => Yii::t('app', 'Notaire'),
            'DATE_PRISE' => Yii::t('app', 'Date Prise'),
            'DATE_RDV' => Yii::t('app', 'Date Rendez-vous'),
        ];
    }
}
